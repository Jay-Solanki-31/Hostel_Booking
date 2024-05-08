<?php

// Include the database configuration file
include 'db.php';

class UserModel
{
    private $mysqli;


    public function __construct()
    {
        // Create a new MySQLi instance
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Check connection
        if ($this->mysqli->connect_error) {
            throw new Exception("Connection failed: " . $this->mysqli->connect_error);
        }
    }



    public function UserAccountRegister($account_type, $username, $email, $password, $contact)
    {
        try {
            $account_type = $this->mysqli->real_escape_string($account_type);
            $username = $this->mysqli->real_escape_string($username);
            $email = $this->mysqli->real_escape_string($email);
            $password = $this->mysqli->real_escape_string($password);
            $contact = $this->mysqli->real_escape_string($contact);


            $query = "INSERT INTO users (role,full_name,email,password,contact_no)
            VALUES ('$account_type','$username','$email','$password','$contact')";
            $result1 = $this->mysqli->query($query);

            if (!$result1) {
                throw new Exception("Error in insert query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in contact function: " . $e->getMessage());
        }
    }


    public function Userslogin($email, $password)
    {
        try {
            // Sanitize input to prevent SQL injection
            $email = $this->mysqli->real_escape_string($email);
            $password = $this->mysqli->real_escape_string($password);

            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            // Check if the user exists
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user; // Return user details
            } else {
                return false; // Login failed
            }
        } catch (Exception $e) {
            throw new Exception("Error in login function: " . $e->getMessage());
        }
    }


    function GetHostelData()
    {
        try {
            $GetHosteldata = "SELECT id, hostel_name, image FROM hostels";
            $result = $this->mysqli->query($GetHosteldata);

            if (!$result) {
                throw new Exception("Error in query: " . $this->mysqli->error);
            }

            $hostelData = array();
            while ($row = $result->fetch_assoc()) {
                $hostelData[] = array(
                    'id' => $row['id'],
                    'hostel_name' => $row['hostel_name'],
                    'image' => $row['image']
                );
            }
            return $hostelData;
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }


    function showHostelData()
    {
        try {
            $sql = "SELECT * FROM hostels";
            $result = $this->mysqli->query($sql);
            if (!$result) {
                throw new Exception("Error in fetching hostel data: " . $this->mysqli->error);
            }
    
            $hostels = array();
            while ($row = $result->fetch_object()) {
                $hostels[] = $row;
            }
    
            // Free result set
            $result->free();
    
            return $hostels;
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    

    public function filterHostels($name, $city)
    {
        try {
            $query = "SELECT * FROM hostels WHERE hostel_name LIKE ? AND location LIKE ?";
            $stmt = $this->mysqli->prepare($query);

            if ($stmt === false) {
                throw new Exception("Error preparing statement: " . $this->mysqli->error);
            }

            // Bind parameters
            $name = '%' . $name . '%';
            $city = '%' . $city . '%';
            $stmt->bind_param('ss', $name, $city);

            // Execute statement
            if (!$stmt->execute()) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            $result = $stmt->get_result();

            $hostels = array();
            while ($row = $result->fetch_object()) {
                $hostels[] = $row;
            }

            return $hostels;
        } catch (Exception $e) {
            throw new Exception("Error filtering hostels: " . $e->getMessage());
        }
    }


    public function AddInquery($name, $email, $contactNo, $message, $hostelId)
    {
        try {
            $name = $this->mysqli->real_escape_string($name);
            $email = $this->mysqli->real_escape_string($email);
            $contactNo = $this->mysqli->real_escape_string($contactNo);
            $message = $this->mysqli->real_escape_string($message);

            $query = "INSERT INTO inquery (name, email, contact_no, description, hostel_id)
                      VALUES ('$name', '$email', '$contactNo', '$message','$hostelId')";
            $result1 = $this->mysqli->query($query);

            if (!$result1) {
                throw new Exception("Error in insert query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in insert function: " . $e->getMessage());
        }
    }



    public function contact($name, $email, $contactNo, $message)
    {
        try {
            $name = $this->mysqli->real_escape_string($name);
            $email = $this->mysqli->real_escape_string($email);
            $contactNo = $this->mysqli->real_escape_string($contactNo);
            $message = $this->mysqli->real_escape_string($message);

            $query = "INSERT INTO contact (name,email,contact_no,description)
            VALUES ('$name','$email','$contactNo','$message')";
            $result1 = $this->mysqli->query($query);

            if (!$result1) {
                throw new Exception("Error in insert query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in contact function: " . $e->getMessage());
        }
    }

    function showsliderWithDescription()
    {
        try {
            $sql = "SELECT * FROM sliders";
            $result = $this->mysqli->query($sql);
            if (!$result) {
                throw new Exception("Error in fetching slider data: " . $this->mysqli->error);
            }

            $sliders = array();
            while ($row = $result->fetch_object()) {
                $sliders[] = $row;
            }

            // Free result set
            $result->free();

            return $sliders;
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }


    public function showAboutUsData()
    {
        try {
            $sql = "SELECT * FROM aboutus";
            $result = $this->mysqli->query($sql);
            if (!$result) {
                throw new Exception("Error in fetching about us data: " . $this->mysqli->error);
            }

            $aboutUsData = array();
            while ($row = $result->fetch_object()) {
                $aboutUsData[] = $row;
            }

            $result->free();

            return $aboutUsData;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    function getStudentsdetails($id)
    {
        try {
            $getStudentsdetails = "SELECT * FROM users where users.id = '$id'";
            $result = $this->mysqli->query($getStudentsdetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    
 


    function getStudentsComplaint($id)
    {
        try {
            $getStudentsdetails = "SELECT complaint.*, users.full_name, hostels.hostel_name
            FROM complaint
            JOIN users ON complaint.student_id = users.id
            JOIN hostels ON complaint.hostel_id = hostels.id
            WHERE complaint.student_id = $id";
            $result = $this->mysqli->query($getStudentsdetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function updateStudentInfo($email, $contact_no, $name, $address, $image, $studentid)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $contact_no = $this->mysqli->real_escape_string($contact_no);
            $name = $this->mysqli->real_escape_string($name);
            $address = $this->mysqli->real_escape_string($address);
            $image = $this->mysqli->real_escape_string($image) ?? '';
    
            $picturequery = $image ? ", image = '$image'" : "";
    
            $updateOwnerData = "UPDATE users SET email='$email', contact_no='$contact_no', full_name='$name', address='$address' $picturequery WHERE id ='$studentid'";
            $result = $this->mysqli->query($updateOwnerData);
    
            if (!$result) {
                throw new Exception("Error in update query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }
    



    function getStudentImage($id)
    {
        try {
            $getOwnerImageQuery = "SELECT users.image FROM `users` WHERE users.id = '$id'";
            $result = $this->mysqli->query($getOwnerImageQuery);
            if (!$result) {
                throw new Exception("Picture not found: " . $this->mysqli->error);
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    

    function getRegisterStudentsdetails($id)
    {
        try {
            $getStudentsdetails = "SELECT booking_assign.*, hostels.hostel_name, hostels.image, hostels.location FROM booking_assign JOIN hostels ON booking_assign.hostel_id = hostels.id WHERE booking_assign.student_id = '$id'";
            $result = $this->mysqli->query($getStudentsdetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }






    //  hostel data part will start 

    function gethostelsdetails($id)
    {
        try {
            $gethosteldetails = "SELECT * from users where id = $id";
            $result = $this->mysqli->query($gethosteldetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function gethostelComplaint($id)
    {
        try {
            $gethostelcomplaint = "SELECT complaint.*, users.full_name AS student_name, hostels.hostel_name
            FROM complaint
            JOIN users ON complaint.student_id = users.id
            JOIN hostels ON complaint.hostel_id = hostels.id
            WHERE complaint.hostel_id IN (SELECT id FROM hostels WHERE user_id = '$id')";

            $result = $this->mysqli->query($gethostelcomplaint);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function gethostelInquery($id)
    {
        try {
            $gethostelinquery = "SELECT inquery.*, hostels.hostel_name
            FROM inquery
            -- JOIN users ON inquery.student_id = users.id
            JOIN hostels ON inquery.hostel_id = hostels.id
            WHERE inquery.hostel_id IN (SELECT id FROM hostels WHERE user_id = '$id')";

            $result = $this->mysqli->query($gethostelinquery);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    function getHostel($id)
    {
        try {
            $gethostel = "SELECT * from hostels where user_id = $id";
            $result = $this->mysqli->query($gethostel);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getregisterStudentData()
    {
        try {
            $getstudentData = "SELECT * FROM `users` WHERE role = 'student'";
            $result = $this->mysqli->query($getstudentData);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function add_hostel($hostelName, $location, $description, $images, $amenities)
    {
        try {
            // Sanitize and escape input
            $hostelName = $this->mysqli->real_escape_string($hostelName);
            $location = $this->mysqli->real_escape_string($location);
            $description = $this->mysqli->real_escape_string($description);
            $imagesString = implode(',', $images); 

            $amenitiesString = implode(',', $amenities);

            $userID = $_SESSION['user_id'];

            $query = "INSERT INTO hostels(user_id, hostel_name, description, location, image, amenities) 
                   VALUES ('$userID', '$hostelName', '$description', '$location', '$imagesString', '$amenitiesString')";

            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error in insert query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in add_hostel function: " . $e->getMessage());
        }
    }


    function gethosteldetails($id)
    {
        try {
            $gethosteldetails = "SELECT * from  hostels where id = '$id'";
            $result = $this->mysqli->query($gethosteldetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function updateOwnerInfo($email, $contact_no, $name, $image, $hostelid)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $contact_no = $this->mysqli->real_escape_string($contact_no);
            $name = $this->mysqli->real_escape_string($name);
            $image = $this->mysqli->real_escape_string($image) ?? '';

            if ($image) {
                $picturequery = ", image = '$image'";
            } else {
                $picturequery = "";
            }

            $updateOwnerData = "UPDATE users SET email='$email', full_name='$name', contact_no='$contact_no' $picturequery WHERE id ='$hostelid'";
            $result = $this->mysqli->query($updateOwnerData);

            if (!$result) {
                throw new Exception("Error in update query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }


    function getOwnerImage($id)
    {
        try {
            $getOwnerImageQuery = "SELECT users.image FROM `users` WHERE users.id = '$id'";
            $result = $this->mysqli->query($getOwnerImageQuery);
            if (!$result) {
                throw new Exception("Picture not found: " . $this->mysqli->error);
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function gethostelimage($id)
    {
        try {
            $gethostelimage = "SELECT hostels.image FROM `hostels`  where hostels.id = '$id'";
            $result = $this->mysqli->query($gethostelimage);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function update_hostel($hostelid, $hostelname, $location, $description, $image, $amenities)
    {
        try {
            $hostelname = $this->mysqli->real_escape_string($hostelname);
            $location = $this->mysqli->real_escape_string($location);
            $description = $this->mysqli->real_escape_string($description);
            $image = $this->mysqli->real_escape_string($image) ?? '';
            $hostelid = $this->mysqli->real_escape_string($hostelid);
            $amenitiesString = implode(',', $amenities);

            $picturequery = "";
            if ($image) {
                $picturequery = ", image = '$image'";
            }

            $updatehosteldata = "UPDATE hostels 
                             SET hostel_name = '$hostelname', 
                                 location = '$location',   
                                 amenities = '$amenitiesString',
                                 description = '$description'" . $picturequery . " 
                             WHERE id = '$hostelid'";


            $result = $this->mysqli->query($updatehosteldata);
            if (!$result) {
                throw new Exception("Error in update query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }

    public function deleteHostel($id)
    {
        try {
            $deleteQuery = "DELETE FROM hostels
                        WHERE hostels.id = $id";

            $result = $this->mysqli->query($deleteQuery);

            if (!$result) {
                throw new Exception("Error in delete query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function deletecomplain($id)
    {
        try {
            $deleteQuery = "DELETE FROM complaint
                        WHERE complaint.id = $id";

            $result = $this->mysqli->query($deleteQuery);

            if (!$result) {
                throw new Exception("Error in delete query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function deleteInquery($id)
    {
        try {
            $deleteQuery = "DELETE FROM inquery
        WHERE id = $id";

            $result = $this->mysqli->query($deleteQuery);

            if (!$result) {
                throw new Exception("Error in delete query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function getUserPassword($userId)
    {
        try {
            $getUserPassword = "SELECT password from users where id = '$userId'";
            $result = $this->mysqli->query($getUserPassword);

            if (!$result) {
                throw new Exception("Error fetching password: " . $this->mysqli->error);
            }
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }


    public function update_password($userId, $current_password, $new_password, $confirm_password)
    {
        try {
            $current_password = $this->mysqli->real_escape_string($current_password);
            $new_password = $this->mysqli->real_escape_string($new_password);
            $confirm_password = $this->mysqli->real_escape_string($confirm_password);

            $userPasswordResult = $this->getUserPassword($userId);

            if ($new_password !== $confirm_password) {
                throw new Exception("New Password and Confirm New Password must be the same.");
            }

            if ($userPasswordResult->num_rows > 0) {
                $userPassword = $userPasswordResult->fetch_assoc();
                $actual_current_password = $userPassword['password'];

                if ($current_password === $actual_current_password) {
                    $updatepassword = "UPDATE users SET `password` = '$new_password' WHERE id = '$userId'";
                    $result2 = $this->mysqli->query($updatepassword);

                    if (!$result2) {
                        throw new Exception("Error in update query: " . $this->mysqli->error);
                    }
                } else {
                    throw new Exception("Current password is incorrect");
                }
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }


    public function insertComplaint($description, $student_id)
    {
        try {
            $query = "SELECT hostel_id FROM `booking_assign` WHERE student_id = '$student_id'";
            $stmt = $this->mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $hostel_id = $row['hostel_id'];

                $query = "INSERT INTO complaint (description, student_id, hostel_id) VALUES ('$description', $student_id, $hostel_id)";

                $stmt = $this->mysqli->prepare($query);
                $stmt->execute();

                return true;
            } else {
                throw new Exception("Hostel not found.");
            }
        } catch (Exception $e) {
            // Handle exceptions
            throw new Exception("Error inserting complaint: " . $e->getMessage());
        }
    }

    public function updateStatus($complaintId, $newStatus)
    {
        try {
            $upadetStatus = "UPDATE complaint set `status` = $newStatus  where id = $complaintId";
            $result2 = $this->mysqli->query($upadetStatus);


            if (!$result2) {
                throw new Exception("Error in update  query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }

    public function assignHostel($hostelName, $studentEmail)
    {
        try {


            $hostelId = $this->getHostelIdByName($hostelName);

            $studentId = $this->getStudentIdByEmail($studentEmail);
            if ($hostelId && $studentId) {
                $query = "INSERT INTO booking_assign (hostel_id,student_id) VALUES ('$hostelId', '$studentId')";
                $stmt = $this->mysqli->query($query);

                if (!$stmt) {
                    throw new Exception("Error in update  query: " . $this->mysqli->error);
                }
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception("Error in insert function: " . $e->getMessage());
        }
    }
    private function getHostelIdByName($hostelName)
    {
        try {
            $query = "SELECT id FROM `hostels` WHERE hostel_name = '$hostelName'";
            $stmt = $this->mysqli->prepare($query);

            if (!$stmt) {
                throw new Exception("Error in prepare statement: " . $this->mysqli->error);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['id'];
            } else {
                throw new Exception("Hostel ID not found for name: $hostelName");
            }
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            return null;
        }
    }

    private function getStudentIdByEmail($studentEmail)
    {
        try {
            $query = "SELECT id FROM users WHERE email = '$studentEmail'";
            $stmt = $this->mysqli->prepare($query);

            if (!$stmt) {
                throw new Exception("Error in prepare statement: " . $this->mysqli->error);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['id'];
            } else {
                throw new Exception("Student ID not found for email: $studentEmail");
            }
        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            return null;
        }
    }


    function getAssignHostelStudentdata($id)
    {
        try {
            $getAssignHostelStudentdata = "SELECT 
                booking_assign.*,
                users.full_name AS student_name,
                users.email AS student_email,
                users.contact_no AS student_contactno,
                hostels.hostel_name
            FROM 
                booking_assign
            JOIN 
                users ON booking_assign.student_id = users.id
            JOIN 
                hostels ON booking_assign.hostel_id = hostels.id
            WHERE 
                booking_assign.hostel_id IN (SELECT id FROM hostels WHERE user_id = '$id')";

            $result = $this->mysqli->query($getAssignHostelStudentdata);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function deleteAssignHostelData($id)
    {
        try {
            $deleteQuery = "DELETE FROM booking_assign
        WHERE id = $id";

            $result = $this->mysqli->query($deleteQuery);

            if (!$result) {
                throw new Exception("Error in delete query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
