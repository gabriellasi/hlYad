
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

$errors; // hold validation errors
$data = array(); //  pass back data

$supportGroupName=$_POST["supportGroupName"];
$supportGroupManager=$_POST["supportGroupManager"];
$riskType=$_POST["riskType"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$city=$_POST["cityName"];
$street=$_POST["street"];
$address= $street . ' ' . $city;
$minAge=$_POST["min_age"];
$maxAge=$_POST["max_age"];
$url=$_POST["url"];

$checkExistVal="SELECT ID FROM support_group where name='$supportGroupName' and address='$address' and risk='$riskType'";
$result = $conn->query($checkExistVal);


if($result->num_rows==0){  
$InsertSupportGroup="INSERT INTO support_group (name,risk,manager,phone,address,mail,min_age,max_age,website_url) VALUES('".$supportGroupName."','".$riskType."','".$supportGroupManager."','".$phone."','".$address."','".$email."','".$minAge."','".$maxAge."','".$url."');";
$conn->query($InsertSupportGroup);
}
else{
    $errors ='קבוצת תמיכה קיימת במערכת';
}

if(!empty($errors)){
    $data['success']=false;
    $data['message']=$errors;
}
else{
    $data['success']=true;
    $data['message']='קבוצת התמיכה הוספה למערכת בהצלחה';
}

echo $data['message'];

$conn->close();
?>
