<?php
session_start();
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
$user_perm=$_POST["permit"];

$_SESSION["permit"]= $user_perm;

$updateUser= "UPDATE googleUsers SET permission='".$user_perm."' WHERE id_token='".$user_id."'";

$conn->query($updateUser);

if ($conn->query($updateUser) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " .$conn->error;
}
/*
$insertYouth="INSERT INTO youth (user_id) VALUES ('".$user_id."')";

$conn->query($insertYouth);
if ($conn->query($insertYouth) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " .$conn->error;
}
*/
$conn->close();

?>