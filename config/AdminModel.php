<?php

// Include the database configuration file
include '../config/db.php';

class AdminModel
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

    public function Adminlogin($email, $password)
    {
        try {
            // Sanitize input to prevent SQL injection
            $email = $this->mysqli->real_escape_string($email);
            $password = $this->mysqli->real_escape_string($password);

            // Query to check admin login
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND role = 'admin'";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            // Check if the user exists
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Login successful
            } else {
                return false; // Login failed
            }
        } catch (Exception $e) {
            throw new Exception("Error in login function: " . $e->getMessage());
        }
    }


    function GetAdminDetails()
    {
        try {
            $GetAdminDetails = "SELECT * FROM users WHERE role = 'admin'";
            $result = $this->mysqli->query($GetAdminDetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetAdminPassword()
    {
        try {
            $GetAdminPassword = "SELECT password from users where role = 'admin'";
            $result = $this->mysqli->query($GetAdminPassword);

            if (!$result) {
                throw new Exception("Error to fetch password :" . $this->mysqli->error);
            }
            return $result;
        } catch (Exception $e) {
            echo "error :" . $e->getMessage();
        }
    }
    function updateAdminInfo($email, $contact_no, $name, $image)
    {
        try {
            $name = $this->mysqli->real_escape_string($name);
            $email = $this->mysqli->real_escape_string($email);
            $contact_no = $this->mysqli->real_escape_string($contact_no);
            $image = $this->mysqli->real_escape_string($image) ?? '';
    
            // Update query to include image update
            $picturequery = "";
            if ($image) {
                $picturequery = ", image = '$image'";
            }
    
            $updateQuery = "UPDATE users SET `email`='$email', `full_name`='$name', `contact_no`='$contact_no' $picturequery WHERE role ='admin'";
            $result = $this->mysqli->query($updateQuery);
    
            if (!$result) {
                throw new Exception("Error in update query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }
    

    public function update_password($current_password, $new_password, $confirm_password)
    {
        try {
            $current_password = $this->mysqli->real_escape_string($current_password);
            $new_password = $this->mysqli->real_escape_string($new_password);
            $confirm_password = $this->mysqli->real_escape_string($confirm_password);

            $adminPasswordResult = $this->GetAdminPassword();

            if ($new_password !== $confirm_password) {
                throw new Exception("New Password And Confirm New Passsowrd must be same.");
            }

            if ($adminPasswordResult->num_rows > 0) {
                $adminPassword = $adminPasswordResult->fetch_assoc();
                $actual_current_password = $adminPassword['password'];


                if ($current_password === $actual_current_password) {
                    $updatepassword = "UPDATE users SET `password` = '$new_password' WHERE role = 'admin'";
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


    function getAdminimage()
    {
        try {
            $getstudentimage = "SELECT users.image FROM `users` WHERE role = 'admin'";
            $result = $this->mysqli->query($getstudentimage);
            if (!$result) {
                throw new Exception("Picrure not Found: " . $this->mysqli->error);
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_hostel($email, $password, $role, $phone, $name, $hostelname, $location, $status, $description, $images, $amenities)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $password = $this->mysqli->real_escape_string($password);
            $role = $this->mysqli->real_escape_string($role);
            $phone = $this->mysqli->real_escape_string($phone);
            $name = $this->mysqli->real_escape_string($name);
            $hostelname = $this->mysqli->real_escape_string($hostelname);
            $location = $this->mysqli->real_escape_string($location);
            $status = $this->mysqli->real_escape_string($status);
            $description = $this->mysqli->real_escape_string($description);
    
            $imagesString = implode(',', $images); 
            
    
            $amenitiesString = implode(',', $amenities);
    
            $query = "INSERT INTO users (full_name, email, contact_no, password, role) VALUES ('$name', '$email', '$phone', '$password', '$role')";
            $result1 = $this->mysqli->query($query);
    
            if ($result1) {
                $lastInsertedID = $this->mysqli->insert_id;
    
                $query2 = "INSERT INTO hostels(user_id, hostel_name, description, location, status, image, amenities) VALUES ('$lastInsertedID', '$hostelname', '$description', '$location', '$status', '$imagesString', '$amenitiesString')";

                $result2 = $this->mysqli->query($query2);
    
                if (!$result2) {
                    throw new Exception("Error in insert query: " . $this->mysqli->error);
                }
            } else {
                throw new Exception("Error in insert query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in add_hostel function: " . $e->getMessage());
        }
    }
    
    
    function showHostelData()
    {
        try {
            $sql = "SELECT * FROM hostels";
            $result = $this->mysqli->query($sql);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update_hostel($hostelid, $email, $password, $phone, $name, $hostelname, $location, $description, $pictures, $status)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $password = $this->mysqli->real_escape_string($password);
            $phone = $this->mysqli->real_escape_string($phone);
            $name = $this->mysqli->real_escape_string($name);
            $hostelname = $this->mysqli->real_escape_string($hostelname);
            $location = $this->mysqli->real_escape_string($location);
            $description = $this->mysqli->real_escape_string($description);
            $status = $this->mysqli->real_escape_string($status);
            $hostelid = $this->mysqli->real_escape_string($hostelid);
    
            $picturesQuery = '';
    
            foreach ($pictures as $picture) {
                $picture = $this->mysqli->real_escape_string($picture);
                $picturesQuery .= "'$picture', "; 
            }
    
            // Remove the trailing comma and space
            $picturesQuery = rtrim($picturesQuery, ', ');
    
            $picturesUpdateQuery = "hostels.image = CONCAT(hostels.image, $picturesQuery)";
    
            // Prepare update query
            $updatehosteldata = "UPDATE hostels JOIN users ON users.id = hostels.user_id
                SET users.full_name = '$name', users.email = '$email', users.contact_no = '$phone', users.password = '$password',
                hostels.hostel_name = '$hostelname', hostels.location = '$location', hostels.description = '$description',
                hostels.status = '$status', $picturesUpdateQuery
                WHERE hostels.id = '$hostelid'";

            $result2 = $this->mysqli->query($updatehosteldata);
            if (!$result2) {
                throw new Exception("Error in update query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }
    


    function gethosteldetails($id)
    {
        try {
            $gethosteldetails = "SELECT hostels.*, users.email,users.full_name,users.contact_no FROM `hostels` INNER JOIN users on users.id=hostels.user_id
            where hostels.id = '$id'";
            $result = $this->mysqli->query($gethosteldetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function deletehostel($id)
    {
        try {
            $deletehostel = "DELETE hostels, users FROM hostels JOIN users ON hostels.user_id = users.id 
            WHERE hostels.id = $id";
            $result = $this->mysqli->query($deletehostel);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
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



    public function add_studentInfo($email, $password, $contact_no, $studentname, $address, $role, $image)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $password = $this->mysqli->real_escape_string($password);
            $contact_no = $this->mysqli->real_escape_string($contact_no);
            $address = $this->mysqli->real_escape_string($address);
            $role = $this->mysqli->real_escape_string($role);
            $studentname = $this->mysqli->real_escape_string($studentname);
            $image = $this->mysqli->real_escape_string($image) ?? '';

            $query = "INSERT INTO users (full_name, email, contact_no, password, image, address, role)
             VALUES ('$studentname', '$email', '$contact_no', '$password', '$image', '$address', '$role')";


            $result1 = $this->mysqli->query($query);

            if (!$result1) {
                throw new Exception("Error in insert query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in student function: " . $e->getMessage());
        }
    }


    function showStudentData()
    {
        try {
            $sql = "SELECT * FROM users where role ='Student'";
            $result = $this->mysqli->query($sql);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function updateStudentsInfo($email, $password, $contact_no, $studentname, $address, $image)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $password = isset($password) ? $this->mysqli->real_escape_string($password) : '';
            $contact_no = $this->mysqli->real_escape_string($contact_no);
            $studentname = $this->mysqli->real_escape_string($studentname);
            $address = $this->mysqli->real_escape_string($address);
            $image = $this->mysqli->real_escape_string($image) ?? '';
            $studentid = isset($_GET['id']) ? $_GET['id']  :  '';


            if ($image) {
                $picturequery = ",users.image = '$image'";
            } else {
                $picturequery = "";
            }



            $upadetStudentData = "UPDATE users SET `email`='$email',`full_name`='$studentname',`contact_no`='$contact_no',`address`='$address',`password`='$password' " . $picturequery . " WHERE id ='$studentid'";
            $result2 = $this->mysqli->query($upadetStudentData);


            if (!$result2) {
                throw new Exception("Error in update  query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }



    function getStudentsdetails($id)
    {
        try {
            $getStudentsdetails = "SELECT id, email, full_name,contact_no,address,image FROM users where users.id = '$id'";
            $result = $this->mysqli->query($getStudentsdetails);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function getstudentimage($id)
    {
        try {
            $getstudentimage = "SELECT users.image FROM `users` WHERE users.id = '$id'";
            $result = $this->mysqli->query($getstudentimage);
            if (!$result) {
                throw new Exception("Picrure not Found: " . $this->mysqli->error);
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function deleteStudentInfo($id)
    {
        try {
            $deleteStudentInfo = "DELETE FROM users WHERE id=$id";
            $result = $this->mysqli->query($deleteStudentInfo);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function showcomplaint()
    {
        try {
            $complain = "SELECT complaint.*,hostels.hostel_name,users.full_name
            FROM complaint  LEFT JOIN users  ON complaint.student_id = users.id LEFT JOIN hostels ON complaint.hostel_id = hostels.id
            WHERE users.role = 'Student'";


            $result = $this->mysqli->query($complain);

            if (!$result) {
                throw new Exception("Error in select query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
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


    function deletecomplaint($id)
    {
        try {
            $deletecomplaint = "DELETE FROM complaint WHERE id=$id";
            $result = $this->mysqli->query($deletecomplaint);

            if (!$result) {
                throw new Exception("Error in delete query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function ShowcontactsRecords()
    {
        try {
            $record = "SELECT* from contact";

            $record = $this->mysqli->query($record);

            if (!$record) {
                throw new Exception("Error in select query: " . $this->mysqli->error);
            }

            return $record;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function deleteContact($id)
    {
        try {
            $deletecontact = "DELETE  FROM  contact where id=$id";
            $result = $this->mysqli->query($deletecontact);

            if (!$result) {
                throw new Exception("Error in delete query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    function GethostelCount()
    {
        try {
            $GethostelCount = "SELECT COUNT(*) as count FROM hostels ";
            $result = $this->mysqli->query($GethostelCount);

            if (!$result) {
                throw new Exception("Error in query: " . $this->mysqli->error);
            }

            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetstudentCount()
    {
        try {
            $GethostelCount = "SELECT COUNT(*) as count FROM users where role = 'Student'";
            $result = $this->mysqli->query($GethostelCount);

            if (!$result) {
                throw new Exception("Error in query: " . $this->mysqli->error);
            }

            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetComplaintsCount()
    {
        try {
            $GethostelCount = "SELECT COUNT(*) as count FROM complaint ";
            $result = $this->mysqli->query($GethostelCount);

            if (!$result) {
                throw new Exception("Error in query: " . $this->mysqli->error);
            }

            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetContactCount()
    {
        try {
            $GethostelCount = "SELECT COUNT(*) as count FROM contact ";
            $result = $this->mysqli->query($GethostelCount);

            if (!$result) {
                throw new Exception("Error in query: " . $this->mysqli->error);
            }

            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetBookinInqueryCount()
    {
        try {
            $GetinqueryCount = "SELECT COUNT(*) as count FROM inquiry ";
            $result = $this->mysqli->query($GetinqueryCount);

            if (!$result) {
                throw new Exception("Error in query: " . $this->mysqli->error);
            }

            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetBookinginquery()
    {
        try {
            $getbookinginquery = "SELECT inquery.*, hostels.hostel_name
            FROM inquery
            JOIN hostels ON inquery.hostel_id = hostels.id;
            ";
            $getbookinginquery = $this->mysqli->query($getbookinginquery);

            if (!$getbookinginquery) {
                throw new Exception("error in select query" . $this->mysqli->error);
            }
            return $getbookinginquery;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function DeleteBokkingInquery($id)
    {
        try {
            $deletebooking = "DELETE FROM inquery WHERE id=$id";
            $result = $this->mysqli->query($deletebooking);

            if (!$result) {
                throw new Exception("Error in delete query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getsliderimage($id)
    {
        try {
            $getsliderimage = "SELECT sliders.picture FROM `sliders`  where sliders.id = '$id'";
            $result = $this->mysqli->query($getsliderimage);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result->fetch_assoc();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    function showSlider()
    {
        try {
            $sql = "SELECT * FROM sliders";
            $result = $this->mysqli->query($sql);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_slider($description,$image){
        try {

            $description = $this->mysqli->real_escape_string($description);
            $image = $this->mysqli->real_escape_string($image) ?? '';


            $query = "INSERT INTO sliders (info,picture) VALUES ('$description','$image')";
            $result1 = $this->mysqli->query($query);
            if (!$result1) {
                  throw new Exception("Error in insert  query: " . $this->mysqli->error);
                }
            } 
            
         catch (Exception $e) {
            throw new Exception("Error in login function: " . $e->getMessage());
        }
    }

    
    public function update_slider($hostelid, $email, $password, $phone, $name, $hostelname, $location, $description, $image, $status)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $password = $this->mysqli->real_escape_string($password);
            $phone = $this->mysqli->real_escape_string($phone);
            $name = $this->mysqli->real_escape_string($name);
            $hostelname = $this->mysqli->real_escape_string($hostelname);
            $location = $this->mysqli->real_escape_string($location);
            $description = $this->mysqli->real_escape_string($description);
            $status = $this->mysqli->real_escape_string($status);
            $image = $this->mysqli->real_escape_string($image) ?? '';
            $hostelid = $this->mysqli->real_escape_string($hostelid);

            if ($image) {
                $picturequery = ",hostels.image = '$image'";
            } else {
                $picturequery = "";
            }


            $updatehosteldata = "UPDATE hostels JOIN users ON users.id = hostels.user_id
             SET users.full_name = '$name', users.email = '$email' , users.contact_no = '$phone' ,users.password = '$password',
             hostels.hostel_name = '$hostelname', hostels.location = '$location',   hostels.description = ' $description',   hostels.status = ' $status'" . $picturequery . " 
            WHERE hostels.id = '$hostelid'";


            $result2 = $this->mysqli->query($updatehosteldata);
            if (!$result2) {
                throw new Exception("Error in update  query: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
        }
    }


    function delete_slider($id)
    {
        try {
            $query = "DELETE FROM sliders WHERE id=$id";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function get_slider($id)
    {
        try {
            $query = "SELECT * FROM sliders WHERE id=$id";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    function showrAboutUS()
    {
        try {
            $sql = "SELECT * FROM aboutus";
            $result = $this->mysqli->query($sql);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_AboutUS($title,$description, $image){
        try {

            $title = $this->mysqli->real_escape_string($title);
            $description = $this->mysqli->real_escape_string($description);
            $image = $this->mysqli->real_escape_string($image) ?? '';


            $query = "INSERT INTO aboutus (heading,picture, info) VALUES ('$title','$image', '$description')";

            $result1 = $this->mysqli->query($query);
            if (!$result1) {
                  throw new Exception("Error in insert  query: " . $this->mysqli->error);
                }
            } 
            
         catch (Exception $e) {
            throw new Exception("Error in login function: " . $e->getMessage());
        }
    }

    
    function getAboutUs($id)
    {
        try {
            $query = "SELECT * FROM aboutus WHERE id=$id";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    function deleteAboutUs($id)
    {
        try {
            $query = "DELETE FROM aboutus WHERE id=$id";
            $result = $this->mysqli->query($query);

            if (!$result) {
                throw new Exception("Error in login query: " . $this->mysqli->error);
            }

            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
