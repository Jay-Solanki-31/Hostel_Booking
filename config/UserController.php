
<?php
ob_start();
include 'function.php';
include 'constants.php';
include 'UserModel.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function UserRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['account_type'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['contact_no'])) {
                $account_type = $_POST['account_type'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $contact = $_POST['contact_no'];


                try {
                    $this->userModel->UserAccountRegister($account_type, $username, $email, $password, $contact);
                    showToast('Registration was successful!');
                    header("refresh:1;url=login.php");
                } catch (Exception $e) {
                    error_log('Error: ' . $e->getMessage());
                    showToast($e->getMessage(), 'error');
                }
            } else {
                showToast('All fields are required.', 'error');
            }
        }
    }

    public function Userlogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            try {
                // Fetch user from UserModel
                $user = $this->userModel->Userslogin($email, $password);
             
                if ($user) {
                    showToast('Login Successful');
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_id'] = $user['id'];
    
                  
                    
                    $redirectUrl = ($user['role'] === 'hostel') ? 'index.php' : 'index.php';
                 
                    header("refresh:1;url= $redirectUrl");
                    exit();
                } else {
                    showToast('Login failed. Please check your credentials.', 'error');
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    

    public function GetHostelData()
    {
        try {
            $hostelData = $this->userModel->GetHostelData();

            if (!is_array($hostelData)) {
                throw new Exception("Invalid data returned from the model");
            }

            $limitedHostelData = array_slice($hostelData, 0, 6);

            return $limitedHostelData;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }


    public function get_hostel()
    {
        try {
            return $this->userModel->showHostelData();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function filterHostels($name, $city)
    {
        try {
            return $this->userModel->filterHostels($name, $city);
        } catch (Exception $e) {
            throw new Exception("Error filtering hostels: " . $e->getMessage());
        }
    }


    public function Contact()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contactNo = $_POST['contactNo'];

            $message = $_POST['message'];


            try {

                $this->userModel->contact($name, $email, $contactNo, $message);
                showToast('Contact Deatils Sent Sucessfully');
                header("refresh:1;url=contact.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }
    public function AddInquery()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contactNo = $_POST['contactNo'];
            $message = $_POST['message'];
            // $userId = $_SESSION['user_id'];
            $hostelId = $_POST['hostel_id'];

            try {
                $this->userModel->AddInquery($name, $email, $contactNo, $message, $hostelId);
                showToast('Inquery sent Sucessfuly');
                header("refresh:1;url=hostels-detail.php?id=$hostelId");
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }


    public function displaysliders()
    {
        try {
            $sliders = $this->userModel->showsliderWithDescription();
            return $sliders;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    public function showAboutUsData()
    {
        try {
            $aboutUsData = $this->userModel->showAboutUsData();
            return $aboutUsData;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function getStudentsdetails($id)
    {
        try {
            return $this->userModel->getStudentsdetails($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function getStudentscomplaint($id)
    {
        try {
            return $this->userModel->getStudentsComplaint($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateStudentInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ;
            $contact_no = $_POST['contact_no'] ;
            $name = $_POST['full_name'] ;
            $address = $_POST['address'] ;
            $imageFILE = $_FILES['picture'] ;
            $imageFILEDestination = "";
            $studentid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            $originalFileName = "";

    
            try {
                $uploadDirectory = 'uploads/students/';
                $singleImageArray = $this->userModel->getStudentImage($studentid);
            
                if ($imageFILE['error'] === UPLOAD_ERR_OK) {
                    // Handle profile picture upload
                    $uploadedFile = $imageFILE['tmp_name'];
                    $originalFileName = $imageFILE['name'];
                    $destination = $uploadDirectory . $originalFileName;
            
                    if (move_uploaded_file($uploadedFile, $destination)) {
                        $imageFILEDestination = $destination;
                    }
                }
            
                $this->userModel->updateStudentInfo($email, $contact_no, $name, $address, $originalFileName, $studentid);
                showToast('Student Information updated successfully!');
                header("refresh:1;url=studentProfile.php");
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
            
        }
    }
    
    public function updateStudentPassword($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
    
            try {
                $this->userModel->update_password($userId, $current_password, $new_password, $confirm_password);
                showToast('Password updated successfully!');
                header("refresh:1;url=studentProfile.php");
                exit();
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }
    
    
    public function getregisterStudentsdetails($id)
    {
        try {
            return $this->userModel->getRegisterStudentsdetails($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    // HOSTEL PART START
    public function gethostelsdetails($id)
    {
        try {
            return $this->userModel->gethostelsdetails($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function gethostelcomplaint($id)
    {
        try {
            return $this->userModel->gethostelComplaint($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function gethostelinquery($id)
    {
        try {
            return $this->userModel->gethostelInquery($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function gethostelInformation($id)
    {
        try {
            return $this->userModel->getHostel($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function getregisterStudentInfo()
    {
        try {
            return $this->userModel->getregisterStudentData();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }




    public function gethosteldetails($id)
    {
        try {
            return $this->userModel->gethosteldetails($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_hostel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hostelName = $_POST['hostelName'];
            $location = $_POST['location'];
            $description = $_POST['description'];
            $imageFILE = $_FILES['image'];
            try {
                $uploadDirectory = 'uploads/hostels/';

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
                } elseif ($imageFILE['error'] === UPLOAD_ERR_NO_FILE) {
                    $imageFILEDestination = null;
                } else {
                    throw new Exception('File upload error: ' . $imageFILE['error']);
                }

                $amenities = isset($_POST['amenities']) && is_array($_POST['amenities']) ? $_POST['amenities'] : array();
                $this->userModel->add_hostel($hostelName, $location, $description, $imageFILEDestination, $amenities);

                showToast('Hostel added successfully!');
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }



    public function update_hostel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hostelid = isset($_GET['id']) ? $_GET['id'] : '';

            try {
                $hostelname = $_POST['hostelName'];
                $location = $_POST['location'];
                $description = $_POST['description'];
                $imageFILE = $_FILES['picture']['name'];

                $uploadDirectory = 'uploads/hostels/';
                $imageFILEDestination = "";

                $currentHostelImage = $this->userModel->gethostelimage($hostelid)['image'];

                if (!empty($imageFILE)) {
                    $uploadedFile = $_FILES['picture']['tmp_name'];
                    $originalFileName = $_FILES['picture']['name'];
                    $destination = $uploadDirectory . $originalFileName;

                    if (move_uploaded_file($uploadedFile, $destination)) {
                        $imageFILEDestination = $originalFileName;

                        if ($currentHostelImage && file_exists($uploadDirectory . $currentHostelImage)) {
                            unlink($uploadDirectory . $currentHostelImage);
                        }
                    }
                } else {
                    $imageFILEDestination = $currentHostelImage;
                }
                $amenities = isset($_POST['amenities']) && is_array($_POST['amenities']) ? $_POST['amenities'] : array();
                $this->userModel->update_hostel($hostelid, $hostelname, $location, $description, $imageFILEDestination,$amenities);

                showToast('Hostel updated successfully!');
                header("refresh:1;url=hostelProfile.php");
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function deletehostel($id)
    {
        try {
            $this->userModel->deletehostel($id);
            showToast('Hostel delated successfully!');
            header("location:hostelProfile.php");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteComplain($id)
    {
        try {
            $this->userModel->deletecomplain($id);
            showToast('Complain delated successfully!');
            header("location:hostelProfile.php");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteInquery($id)
    {
        try {
            $this->userModel->deleteInquery($id);
            showToast('inquery  delated successfully!');
            header("location:hostelProfile.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateOwnerInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $contact_no = $_POST['phone'];
            $name = $_POST['name'];
            $imageFILE = $_FILES['picture'];
            $imageFILEDestination = "";
            $hostelid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            $originalFileName = "";


            try {
                $uploadDirectory = 'uploads/owners/';
                $singleImageArray = $this->userModel->getOwnerImage($hostelid);

                if ($singleImageArray) {
                    $oldImagePath = $singleImageArray['image'];

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

                $this->userModel->updateOwnerInfo($email, $contact_no, $name, $originalFileName, $hostelid);
                showToast('Owner Information updated successfully!');
                echo "<script>setTimeout(function(){window.location.href='hostelProfile.php';}, 2000);</script>";
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function updateHostelPassword($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
                $current_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
    
                try {
                    $this->userModel->update_password($userId, $current_password, $new_password, $confirm_password);
                    showToast('Password updated successfully!');
                    header("refresh:1;url=hostelProfile.php");
                    exit();
                } catch (Exception $e) {
                    error_log('Error: ' . $e->getMessage());
                    showToast($e->getMessage(), 'error');
                }
            } 
        }
    }
    

    public function insertComplaint()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $student_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            $description = $_POST['complaintDescription'];


            try {
                $this->userModel->insertComplaint($description, $student_id);

                showToast('Complaint submitted successfully!');
                header("refresh:1;url=studentProfile.php");
                exit();
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }


    public function updatecomplaintStatus()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST'); {

            $complaintId = isset($_POST['complaintId']) ? $_POST['complaintId']  :  '';
            $newStatus = isset($_POST['newStatus']) ? $_POST['newStatus']  :  '';

            try {
                $this->userModel->updateStatus($complaintId, $newStatus);
                showToast('complaint status updated successfully!');
                header("refresh:1;url=hostelProfile.php");
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function assignHostel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hostelName = $_POST['hostel'];
            $studentEmail = $_POST['student_email']; 


            try {
            
               $sucess= $this->userModel->assignHostel($hostelName, $studentEmail);
                if($sucess){
                    echo json_encode(array('sucess' => true, 'message'=>'Hostel Assign Sucessfully!'));
                }else{
                    echo json_encode(array('sucess' => false, 'message'=>'failed to  Assign Sucessfully!'));  
                }
                exit();
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function getassiggnhosteldata($id)
    {
        try {
            return $this->userModel->getAssignHostelStudentdata($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function deleteassignHostel($id)
    {
        try {
            $this->userModel->deleteAssignHostelData($id);
            showToast('assign Hostel  delated successfully!');
            header("location:hostelProfile.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }
}
