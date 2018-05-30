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

$message= $_POST["message"];
$email= $_POST["email"];
$service= $_POST["service"];

$updateMessage= "UPDATE youth_shelter SET message ='$message' WHERE email_id='$email' AND service='$service'";

$conn->query($updateMessage);

$data = array();

$data['success']=true;
$data['message']= "חוות דעתך עודכנה".'<br>'."תודה ששיתפת אותנו,".'<br>'."<b>חשוב לנו שתדע שיש מי שיושיט לך יד.</b>";
echo $data['message'];
$conn->close();
?>