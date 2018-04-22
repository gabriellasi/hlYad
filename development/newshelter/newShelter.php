
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

    
$shelterName=$_POST["shelterName"];
$shelterManager=$_POST["shelterManager"];
$riskType=$_POST["riskType"];
$phone=$_POST["phone"];
$address=$_POST["address"];
$email=$_POST["email"];


$InsertShelter="INSERT INTO shelter (name,risk,manager,phone,address,mail) VALUES('".$shelterName."','".$riskType."','".$shelterManager."','".$phone."','".$address."','".$email."');";
$conn->query($InsertShelter);




$conn->close();
?>
