<?php
$servername = "localhost";  
$username = "victor";       
$password = "admin";          
$dbname = "victor";  

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
