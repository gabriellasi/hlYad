
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

$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];
$riskType=$_POST["riskType"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$city=$_POST["cityName"];
$street=$_POST["street"];
$address= $street . ' ' . $city;

$checkExistVal="SELECT ID FROM volunteer where name='$firstName' and address='$address' and risk='$riskType'";
$result = $conn->query($checkExistVal);


if($result->num_rows==0){  
$InsertVolunteer="INSERT INTO volunteer (fisrt_name,last_name,treatment_area,phone,address,mail) VALUES('".$firstName."','".$lastName."','".$riskType."','".$phone."','".$address."','".$email."');";
$conn->query($InsertVolunteer);
}
else{
    $errors = 'מתנדב קיים במערכת';
}

if(!empty($errors)){
    $data['success']=false;
    $data['message']=$errors;
}
else{
    $data['success']=true;
    $data['message']='בית המחסה הוסף למערכת בהצלחה';
}

echo $data['message'];

$conn->close();
?>