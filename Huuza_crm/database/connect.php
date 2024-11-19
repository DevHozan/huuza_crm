<?php



// Database credentials
$host = 'localhost';
$dbname = 'crm_system';
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

// Create a MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}else{
    $usermanager=new UsersManager($conn);
    $mainmanager=new DatabaseHandler($conn);
}


?>
