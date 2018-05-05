
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

$user_id=$_POST["id_token"];

//echo "<p>".$user_id."</p>";


$insertUser="INSERT INTO googleUsers (ID,id_token) VALUES ('1','".$user_id."')";

$conn->query($insertUser);

$conn->close();
?>
