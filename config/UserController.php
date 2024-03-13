
<?php
ob_start();
include 'config/function.php';
include 'config/UserModel.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        // Create an instance of UserModel
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
            $user = $this->userModel->Userslogin($email, $password);

            if ($user) {
                $_SESSION['user_email'] = $email;
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];

                // Redirect users based on their role
                $redirectUrl = ($user['role'] === 'hostel') ? 'index.php' : 'index.php';
                header("Location: $redirectUrl");
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
            $hostelImages = $this->userModel->GetHostelData();

            if (!is_array($hostelImages)) {
                throw new Exception("Invalid data returned from the model");
            }

            $limitedHostelImages = array_slice($hostelImages, 0, 6);

            return $limitedHostelImages;
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
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
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
                header("refresh:1;url=contact.php");
            } catch (Exception $e) {

                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function displaysliders()
    {
        try {
            $sliders = $this->userModel->showslider();
            return $sliders;
        } catch (Exception $e) {
            // Handle exceptions or log errors
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
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function getStudentscomplaint($id)
    {
        try {
            return $this->userModel-> getStudentsComplaint($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateStudentInfo()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $contact_no = $_POST['phone']; 
        $name = $_POST['name']; 
        $address = $_POST['address'];
        $imageFILE = $_FILES['picture']; 
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

// HOSTEL PART START
    public function gethostelsdetails($id)
    {
        try {
            return $this->userModel->gethostelsdetails($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function gethostelcomplaint($id)
    {
        try {
            return $this->userModel-> gethostelComplaint($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function gethostelinquery($id)
    {
        try {
            return $this->userModel-> gethostelInquery($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function gethostelInformation($id)
    {
        try {
            return $this->userModel-> getHostel($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    

    public function gethosteldetails($id)
    {
        try {
            return $this->userModel->gethosteldetails($id);
        } catch (Exception $e) {
            // Handle exceptions or log errors
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
                }
        
                $amenities = isset($_POST['amenities']) && is_array($_POST['amenities']) ? $_POST['amenities'] : array();
                $this->userModel->add_hostel($hostelName, $location, $description, $imageFILEDestination, $amenities);
        
                showToast('Hostel added successfully!');
                header("refresh:2;url=hostelProfile.php");
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
    
                $this->userModel->update_hostel($hostelid, $hostelname, $location, $description, $imageFILEDestination);
    
                showToast('Hostel updated successfully!');
                header("refresh:2;url=hostelProfile.php");
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
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteComplain($id)
    {
        try {
            $this->userModel->deletecomplain($id);
            showToast('Hostel delated successfully!');
            header("location:hostelProfile.php");
        } catch (Exception $e) {
            // Handle exceptions or log errors
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
                header("refresh:1;url=hostelProfile.php");
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                showToast($e->getMessage(), 'error');
            }
        }
    }

    public function updateHostelPassword($userId)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
