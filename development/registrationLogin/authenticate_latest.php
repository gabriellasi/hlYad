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
$fullName=$_POST["full_name"];
$emailAdd=$_POST["email_add"];
$emailId=$_POST["email_id"];
$familyName=$_POST["family_name"];
$firstName=$_POST["first_name"];
$user_perm=$_POST["permit"];

$_SESSION["user"]= $user_id;
$_SESSION["permit"]= $user_perm;
$_SESSION["emailId"] = $emailId;

//echo "<p>".$user_id."</p>";
//echo "<p>".$firstName."</p>";
//echo "<p>".$familyName."</p>";
//echo "<p>".$emailAdd."</p>";
//echo "<p>".$emailId."</p>";
//echo "<p>".$fullName."</p>";
//echo "<p>".$user_perm."</p>";

echo "<p>".$_SESSION["user"]."</p>";
echo "<p>".$_SESSION["permit"]."</p>";

$checkUser="SELECT ID FROM googleUsers WHERE email_ID='$emailId'";


$result=$conn->query($checkUser);

if($result->num_rows == 0){
    $insertUser="INSERT INTO googleUsers (id_token,full_name,email,email_ID,family_name,given_name,permission) VALUES ('".$user_id."','".$fullName."','".$emailAdd."','".$emailId."','".$familyName."','".$firstName."','".$user_perm."')";
    
    $conn->query($insertUser);
}
else{
    echo "Record already exist";
}

/*
$conn->query($insertUser);

if ($conn->query($updateUser) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " .$conn->error;
}
*/

$conn->close();
?>

