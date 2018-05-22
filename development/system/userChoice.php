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

$email_to="hoshetly@gmail.com";
$email_subject = "בקשה להצטרפות לגוף מטפל";
$service = $_POST["myCheckboxes"];
$message = $_POST["comments"];
$userMail = $_POST["email"];
$communication = "0";
$checked;

mysqli_set_charset($conn,"utf8");

//print_r($service);



foreach($service as $serviceName){
 
     $insertUserChoice = "INSERT into youth_shelter (email_id,service,communication) VALUES ('".$userMail."','".$serviceName."','".$communication."')";
     $conn->query($insertUserChoice);
 }
 
 
$email_message = "פרטי הטופס:\n\n";
function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}


$email_message .= "כתובת מייל: ".clean_string($userMail)."\n";
$email_message .= "הודעה: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$userMail."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 


$checkUserChoice = "SELECT email FROM googleUsers WHERE email='$userMail'";
$resultCheck=$conn->query($checkUserChoice);
 
 $errors=array();
 $data=array();
     
if($resultCheck -> num_rows > 0){
    $data['success']=true;
    $data['message']= "הודעתך הועברה לגופים המטפלים,".'<br>'."חשוב לנו לדעת שקיבלת מענה הולם ונשמח שתעדכן/י באיזור האישי את חוות דעתך ".'&#9825'.'<br>'.'<a href="" target="_blank">האיזור האישי שלך</a>';
}
else{
    $data['success']=false;
    $data['message']= "הודעה הועברה לגופים המטפלים.".'<br>'."חשוב לנו לדעת שקיבלת מענה  הולם נשמח שתירשם אלינו על מנת שנוכל  לעזור לך יותר!".'<br>'.'<a href="http://gabriellasi.mtacloud.co.il/registrationLogin/registraion_latest.php" target="_blank"> לרישום לחץ/י כאן </a>';
}

echo $data['message'];

$conn->close();
?>