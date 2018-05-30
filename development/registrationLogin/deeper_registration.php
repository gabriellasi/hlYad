<?php
$servername = "localhost:3306";
$username = "gabriellasi";
$password = "]Tf07@MEeG4e";
$dbname = "gabriell_youth_at_risk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

mysqli_set_charset($conn,"utf8");




$phone=$_POST['phoneNum'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$city = $_POST['cityName'];
$user_token=$_POST['token'];



$insertUser="INSERT INTO youth (user_id,age,gender,city,phone) VALUES ('".$user_token."','".$age."','".$gender."','".$city."','".$phone."')";
    
$conn->query($insertUser);

if ($conn->query($insertUser) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " .$conn->error;
}


$conn->close();
?>
