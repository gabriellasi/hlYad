
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

    
$supportGroupName=$_POST["supportGroupName"];
$supportGroupManager=$_POST["supportGroupManager"];
$riskType=$_POST["riskType"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$city=$_POST["cityName"];
$street=$_POST["street"];
$address= $street . ' ' . $city;



$InsertSupportGroup="INSERT INTO support_group (name,risk,manager,phone,address,mail) VALUES('".$supportGroupName."','".$riskType."','".$supportGroupManager."','".$phone."','".$address."','".$email."');";
$conn->query($InsertSupportGroup);


$conn->close();
?>
