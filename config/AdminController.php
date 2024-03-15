
<?php
ob_start();
include '../config/function.php';
include '../config/constants.php';
include '../config/AdminModel.php';

class AdminController
{
    private $adminModel;


    public function __construct()
    {
        // Create an instance of AdminModel
    
        $this->adminModel = new AdminModel();
    }

    public function Adminlogin()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];


            try {
                $loginResult = $this->adminModel->Adminlogin($email, $password);

                if ($loginResult) {
                    showToast('Login successful');
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user'] = $loginResult;
                    header("refresh:1;url=dashboard.php");
                } else {
                    showToast('Login failed. Please check your credentials.', 'error');
                }
            } catch (Exception $e) {
                // Handle exceptions or log errors
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function displayAdminDetails()
    {
        try {
            $profileData =  $this->adminModel->GetAdminDetails();
            $_SESSION['user'] = $profileData;
            return $profileData;
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateAdminInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['full_name'];
            $email = $_POST['email'];
            $contact_no = $_POST['phone'];
            $imageFILE = $_FILES['profile_image'];
            $imageFILEDestination = "";
    
            try {
                $uploadDirectory = '../uploads/owners/';
    
                // Check if a new image is uploaded
                if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                    // If there's an existing image, delete it
                    $oldImagePath = $this->adminModel->getAdminimage();
                    if ($oldImagePath && file_exists($oldImagePath['image'])) {
                        unlink($oldImagePath['image']);
                    }
    
                    $uploadedFile = $imageFILE['tmp_name'];
                    $originalFileName = $imageFILE['name'];
                    $destination = $uploadDirectory . $originalFileName;
    
                    if (move_uploaded_file($uploadedFile, $destination)) {
                        $imageFILEDestination = $destination;
                    }
                }
    
                $this->adminModel->updateAdminInfo($email, $contact_no, $name, $originalFileName);
                showToast('Admin Information updated successfully!');
                // Reload the page to display the updated image
                header("Refresh:0");
                // After a delay, refresh the page again
                echo '<script>setTimeout(function(){ window.location.reload(); }, 1000);</script>';
                exit();
    
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }
    

    public function updateAdminPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            try {
                $this->adminModel->update_password($current_password, $new_password, $confirm_password);
                showToast('Admin password updated successfully!');
                header("refresh:1;url=profile.php");
                exit();
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }


    public function add_hostel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $phone = $_POST['phone'];
            $name = $_POST['name'];
            $hostelname = $_POST['hostelName'];
            $location = $_POST['location'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $imageFILE = $_FILES['image'];
    
            try {
                $uploadDirectory = '../uploads/hostels/';
    
                if (!file_exists($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }
    
                $originalFileName = '';
                $imageFILEDestination = '';
    
                if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                    $uploadedFile = $imageFILE['tmp_name'];
                    $originalFileName = $imageFILE['name'];
                    $destination = $uploadDirectory . $originalFileName;
    
                    if (move_uploaded_file($uploadedFile, $destination)) {
                        $imageFILEDestination = $originalFileName;
                    }
                }
    
                $amenities = isset($_POST['amenities']) ? $_POST['amenities'] : array(); 
    
                $this->adminModel-> add_hostel($email, $password, $role, $phone, $name, $hostelname, $location, $status, $description, $imageFILEDestination, $amenities);
    
                showToast('Hostel added successfully!');
                header("refresh:2;url=hostels.php");
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }
    


    public function get_hostel()
    {
        try {
            return $this->adminModel->showHostelData();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


    public function update_hostel()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $name = $_POST['name'];
            $hostelname = $_POST['hostelName'];
            $location = $_POST['location'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $imageFILE = $_FILES['picture'];
            $imageFILEDestination = "";
            $originalFileName = "";

            $hostelid = isset($_GET['id']) ? $_GET['id']  :  '';

            try {



                $uploadDirectory = '../uploads/hostels/'; 
                $singleImageArray = $this->adminModel->gethostelimage($hostelid);

                if ($singleImageArray) {
                    $oldImagePath = $singleImageArray['image'];

                    $imageFILE = $_FILES['picture'];
                    if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                        // Delete the old image
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }

                        $uploadedFile = $imageFILE['tmp_name'];
                        $originalFileName = $imageFILE['name'];
                        $destination = $uploadDirectory . $originalFileName;

                        if (move_uploaded_file($uploadedFile, $destination)) {
                            $imageFILEDestination = $destination;
                        }
                    }
                }
                $this->adminModel->update_hostel($hostelid, $email, $password, $phone, $name, $hostelname, $location, $description,$originalFileName,$status);
                showToast('Hostel updated successfully!');
                header("refresh:1;url=hostels.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }


    public function gethosteldetails($id)
    {
        try {
            return $this->adminModel->gethosteldetails($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }



    public function delatehostel($id)
    {
        try {
            $this->adminModel->deletehostel($id);
            showToast('Hostel delated successfully!');
            header("location:hostels.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }



    public function add_studentInfo()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $contact_no = $_POST['contact_no'];
            $studentname = $_POST['studentname'];
            $address = $_POST['address'];
            $role = $_POST['role'];
            $imageFILE = $_FILES['image'];
            $imageFILEDestination = "";
            $originalFileName = "";


            try {
                $uploadDirectory = '../uploads/students/';

                if (!file_exists($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }

                if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                    $uploadedFile = $imageFILE['tmp_name'];
                    $originalFileName = $imageFILE['name'];
                    $destination = $uploadDirectory . $originalFileName;

                    if (move_uploaded_file($uploadedFile, $destination)) {
                        $imageFILEDestination = $destination;
                    }
                }
                $this->adminModel->add_studentInfo($email, $password, $contact_no, $studentname, $address, $role, $originalFileName);
                showToast('Student added successfully!');
                header("refresh:2;url=students.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }



    public function get_students()
    {
        try {
            return $this->adminModel->showStudentData();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


    public function updateStudentInfo()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $contact_no = $_POST['contact_no'];
            $studentname = $_POST['studentname'];
            $address = $_POST['address'];
            $imageFILE = $_FILES['image'];
            $imageFILEDestination = "";
            $studentid = isset($_GET['id']) ? $_GET['id']  :  '';
            $originalFileName = "";

            try {



                $uploadDirectory = '../uploads/students/';
                $singleImageArray = $this->adminModel->getstudentimage($studentid);


                if ($singleImageArray) {
                    $oldImagePath = $singleImageArray['image'];

                    // Check if a new image is uploaded
                    $imageFILE = $_FILES['image'];
                    if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                        // Delete the old image
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }

                        $uploadedFile = $imageFILE['tmp_name'];
                        $originalFileName = $imageFILE['name'];
                        $destination = $uploadDirectory . $originalFileName;

                        if (move_uploaded_file($uploadedFile, $destination)) {
                            $imageFILEDestination = $destination;
                        }
                    }
                }
                $this->adminModel->updateStudentsInfo($email, $password, $contact_no, $studentname, $address, $originalFileName);
                showToast('Student Information updated successfully!');
                header("refresh:1;url=students.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }


    public function getStudentsdetails($id)
    {
        try {
            return $this->adminModel->getStudentsdetails($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


    public function deleteStudentInfo($id)
    {
        try {
            $this->adminModel->deleteStudentInfo($id);
            showToast('Student Record delated successfully!');
            header("location:students.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }





    public function DisplayCompalins()
    {
        try {
            return $this->adminModel->showcomplaint();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }



    public function Deletecomplaint($id)
    {
        try {
            $this->adminModel->deletecomplaint($id);
            showToast('complaint delated successfully!');
            header("location:complaint.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }



    public function DisplayContactsDetails()
    {
        try {
            return $this->adminModel->ShowcontactsRecords();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


    public function DeleteContact($id)
    {
        try {
            $this->adminModel->deleteContact($id);
            showToast('contact delated successfully!');
            header("location:contacts.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function updatecomplaintStatus()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST'); {

            $complaintId = isset($_POST['complaintId']) ? $_POST['complaintId']  :  '';
            $newStatus = isset($_POST['newStatus']) ? $_POST['newStatus']  :  '';


            try {
                $this->adminModel->updateStatus($complaintId, $newStatus);
                showToast('complaint status updated successfully!');
                header("refresh:1;url=complaints.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function DisplayHostelCount()
    {
        try {
            return $this->adminModel->GethostelCount();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function DisplayStudentCount()
    {
        try {
            return $this->adminModel->GetstudentCount();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function DisplayComplaintsCount()
    {
        try {
            return $this->adminModel->GetComplaintsCount();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function DisplayContactCount()
    {
        try {
            return $this->adminModel->GetContactCount();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


    public function DisplayBookingCount()
    {
        try {
            return $this->adminModel->GetBookinInqueryCount();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


    public function DisplayInquery()
    {
        try {
            return $this->adminModel->GetBookinginquery();
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }

    public function DeleteBookingInquery($id)
    {
        try {
            $this->adminModel->DeleteBokkingInquery($id);
            header("location:booking_inquiries.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


    
    public function get_slider()
    {
        try {
            return $this->adminModel->showSlider();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_sliders()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
           
            $imageFILE = $_FILES['image'];
            $imageFILEDestination = "";
            $originalFileName = "";
        

            try {
                $uploadDirectory = '../uploads/slider/';

                if (!file_exists($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }

                if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                    $uploadedFile =     $imageFILE['tmp_name'];
                    $originalFileName =    $imageFILE['name'];
                    $destination = $uploadDirectory . $originalFileName;

                    if (move_uploaded_file($uploadedFile, $destination)) {
                        $imageFILEDestination = $destination;
                    }
                }
                $this->adminModel->add_slider( $originalFileName);
                showToast('slider  added successfully!');
                header("refresh:2;url=slider.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function deleteSlider($id)
    {
        try {
            $this->adminModel->delete_slider($id);
            showToast('Slider Record delated successfully!');
            header("location:slider.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }


      
    public function getAboutUS()
    {
        try {
            return $this->adminModel->showrAboutUS();
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_AboutUS()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $description = $_POST['description'];
            $imageFILE = $_FILES['image'];
            $imageFILEDestination = "";
            $originalFileName = "";

        

            try {
                $uploadDirectory = '../uploads/about-us/';

                if (!file_exists($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }

                if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                    $uploadedFile =     $imageFILE['tmp_name'];
                    $originalFileName =    $imageFILE['name'];
                    $destination = $uploadDirectory . $originalFileName;

                    if (move_uploaded_file($uploadedFile, $destination)) {
                        $imageFILEDestination = $destination;
                    }
                }
                $this->adminModel->add_AboutUS($description, $originalFileName);
                showToast('about-us  added successfully!');
                header("refresh:2;url=about-us.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function deleteAboutUs($id)
    {
        try {
            $this->adminModel->deleteAboutUs($id);
            showToast(' Record delated successfully!');
            header("location:about-us.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    
}
