<?php
class UsersManager {
    private $conn;

    // Correct the constructor method name from __constructor to __construct
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registration($names, $email, $role, $telephone, $password) {
        // Use a prepared statement to prevent SQL injection
        $sql = "INSERT INTO users (Username, Email, Role, PhoneNumber, Password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        // Check if the statement was prepared successfully
        if ($stmt) {
            // Use bind_param correctly and then execute
            $stmt->bind_param('sssss', $names, $email, $role, $telephone, $password);
            $executeResult = $stmt->execute();
            
            // Check if the execution was successful
            if ($executeResult) {
                echo "<script>alert('Registered successfully');</script>";
                if(isset($_SESSION['user_id'])){
                    
                }else{
                    echo"<script>window.location.href='login.php'</script>";
                }
            } else {
                echo "<script>alert('Something went wrong during registration');</script>";
            }
            $stmt->close(); // Close the statement
        } else {
            echo "<script>alert('Failed to prepare the SQL statement');</script>";
        }
    }

    public function login($email, $password) {
        $conn = $this->conn;
        $sql = "SELECT * FROM users WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if user is found
        if ($result->num_rows > 0) {
            // Fetch user data
            $user = $result->fetch_assoc();
    
            // Verify password using password_verify() for better security
            if ($password==$user['Password']) {
                if($user['status']=='approved'){
 // Start session for logged-in user
                $_SESSION['Email'] = $user['Email']; // Store email in session
                $_SESSION['Role'] = $user['Role']; // Store role in session
                $_SESSION['user_id'] = $user['UserID'];
                $role= $_SESSION['Role'];
                $_SESSION['username']=$user['username'];
                $_SESSION['ProvinceId'] = $user['ProvinceId'];
                $_SESSION['DistrictId'] = $user['DistrictId'];


                // Redirect to the dashboard page or home page
                if($role=='admin'){
                    header('Location: ../'.$role.'/dashboard/');
                }else{
                    header('Location: ../'.$role.'/dashboard/mine/reports.php');
                }
                                }else{
                    echo"<script>alert('Your account is not approved.Contact Call Center');window.location.href=''</script>";
                }
               
                
                exit();
            } else {
                // Invalid password
                $error_message = "Incorrect password!";
                echo "<script>alert('$error_message');</script>";
            }
        } else {
            // Email not found
            $error_message = "No account found with that email!";
            echo "<script>alert('$error_message');</script>";
        }
    
        // Close the statement
        $stmt->close();
    }
    }
?>
