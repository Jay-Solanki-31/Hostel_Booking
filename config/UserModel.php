<?php

// Include the database configuration file
include 'config/db.php';

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



    public function UserAccountRegister($account_type, $username, $email, $password,$contact)
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
            $GetHosteldata = "SELECT * FROM hostels";
            $result = $this->mysqli->query($GetHosteldata);
    
            if (!$result) { 
                throw new Exception("Error in query: " . $this->mysqli->error);
            }
    
            $hostelImages = array();
            while ($row = $result->fetch_assoc()) {
                $hostelImages[$row['hostel_name']] = $row['image']; 
            }
            return $hostelImages;
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
    


    function GetUserPassword($email)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $GetUseremail = "SELECT password FROM users WHERE email = '$email'";
            $result = $this->mysqli->query($GetUseremail);

            if (!$result) {
                throw new Exception("Error fetching password: " . $this->mysqli->error);
            }
            return $result;
        } catch (Exception $e) {
            echo "error: " . $e->getMessage();
        }
    }


    public function UpdateUsers_password($email, $new_password, $confirm_password)
    {
        try {
            $email = $this->mysqli->real_escape_string($email);
            $new_password = $this->mysqli->real_escape_string($new_password);
            $confirm_password = $this->mysqli->real_escape_string($confirm_password);

            $userPasswordResult = $this->GetUserPassword($email);

            if ($new_password !== $confirm_password) {
                throw new Exception("New Password and Confirm New Password must be the same.");
            }

            if ($userPasswordResult->num_rows > 0) {
                $updatepassword = "UPDATE users SET `password` = '$new_password' WHERE email = '$email'";
                $result2 = $this->mysqli->query($updatepassword);

                if (!$result2) {
                    throw new Exception("Error in update query: " . $this->mysqli->error);
                }
            } else {
                throw new Exception("No user found with the provided email.");
            }
        } catch (Exception $e) {
            throw new Exception("Error in update function: " . $e->getMessage());
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

    function showslider()
    {
        try {
            $sql = "SELECT * FROM sliders";
            $result = $this->mysqli->query($sql);
            if (!$result) {
                throw new Exception("Error in fetching slider data: " . $this->mysqli->error);
            }
    
            $slider = array();
            while ($row = $result->fetch_object()) {
                $slider[] = $row;
            }
    
            // Free result set
            $result->free();
    
            return $slider;
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    
    public function showAboutUsData()
{
    try {
        $sql = "SELECT info, picture FROM aboutus";
        $result = $this->mysqli->query($sql);
        if (!$result) {
            throw new Exception("Error in fetching about us data: " . $this->mysqli->error);
        }

        $aboutUsData = array();
        while ($row = $result->fetch_object()) {
            $aboutUsData[] = $row; // Append each row (object) to the array
        }

        $result->free();

        return $aboutUsData; // Return the array
    } catch (Exception $e) {
        return "Error: " . $e->getMessage(); // Return error message as string
    }
}



function getStudentsdetails($id)
{
    try {
        $getStudentsdetails = "SELECT id, email  FROM users where users.id = '$id'";
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
        $getStudentsdetails = "SELECT * FROM complaint Where student_id = $id";
        $result = $this->mysqli->query($getStudentsdetails);

        if (!$result) {
            throw new Exception("Error in login query: " . $this->mysqli->error);
        }

        return $result;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}



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
        $gethostelcomplaint= "SELECT complaint.*, users.full_name AS student_name
        FROM complaint
        JOIN users ON complaint.student_id = users.id
        WHERE complaint.hostel_id IN (SELECT id FROM hostels WHERE user_id = '$id');
        ";
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
        $gethostelinquery= "SELECT inquiry.*, users.full_name AS student_name
        FROM inquiry
        JOIN users ON inquiry.student_id = users.id
        WHERE inquiry.hostel_id IN (SELECT id FROM hostels WHERE user_id = '$id');
        ";
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
        $gethostel= "SELECT * from hostels where user_id = $id";
        $result = $this->mysqli->query($gethostel);

        if (!$result) {
            throw new Exception("Error in login query: " . $this->mysqli->error);
        }

        return $result;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


public function add_hostel($hostelName, $location, $description, $image, $amenities)
{
    try {
        // Sanitize and escape input
        $hostelName = $this->mysqli->real_escape_string($hostelName);
        $location = $this->mysqli->real_escape_string($location);
        $description = $this->mysqli->real_escape_string($description);
        $image = $this->mysqli->real_escape_string($image) ?? '';
        $amenitiesString = implode(',', $amenities);

        $userID = $_SESSION['user_id'];
    
        $query = "INSERT INTO hostels(user_id, hostel_name, description, location, image, amenities) 
                   VALUES ('$userID', '$hostelName', '$description', '$location', '$image', '$amenitiesString')";
    
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
        $gethosteldetails = "SELECT * from  hostels where hostels.id = '$id'";
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












}