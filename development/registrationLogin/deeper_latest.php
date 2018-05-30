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

$user_id=$_SESSION["user"];
$phone=$_POST['phoneNum'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$city = $_POST['cityName'];
$emailId = $_SESSION["emailId"];

//is logged in
if(isset($_SESSION["emailId"])){
    
    $checkUser="SELECT email_ID FROM googleUsers WHERE email_ID='$emailId'";
    $result=$conn->query($checkUser);
    
    //has logged in the past
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
              $checkBeforInsert="SELECT user_id FROM youth WHERE email_id='$emailId'";
              $resultCheck=$conn->query($checkBeforInsert);
              
              //has registered in the past to the system
              if($resultCheck->num_rows > 0){
                  $errors='אתה כבר רשום אצלנו במערכת'; 
              }
              else{
                $insertUser="INSERT INTO youth (user_id,email_id,age,gender,city,phone) VALUES ('".$user_id."','".$emailId."','".$age."','".$gender."','".$city."','".$phone."');";
                $conn->query($insertUser);
              }
            }
    }
}
//not logged in
else{
        $errors="עליך לבצע כניסה עם חשבון Gmail על מנת להירשם";
}
    

if(!empty($errors)){
    $data['success']=false;
    $data['message']=$errors;
}
else{
    $data['success']=true;
    $data['message']='פרטיך נרשמו בהצלחה!';
}

echo $data['message'];


$conn->close();

?>