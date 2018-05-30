<?php

$email_to = "hoshetly@gmail.com";
$email_subject = "הודעה חדשה מנער/ה";

$first_name = $_POST['first_name']; // required
$last_name = $_POST['last_name']; // required
$email_from = $_POST['email']; // required
$comments = $_POST['comments']; // required
 
$email_message = "פרטי הטופס:\n\n";

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

$email_message .= "שם פרטי: ".clean_string($first_name)."\n";
$email_message .= "שם משפחה: ".clean_string($last_name)."\n";
$email_message .= "כתובת מייל: ".clean_string($email_from)."\n";
$email_message .= "הודעה: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
 
?>

