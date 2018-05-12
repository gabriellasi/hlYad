
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

$shelterName=$_POST["shelterName"];
$shelterManager=$_POST["shelterManager"];
$riskType=$_POST["riskType"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$city=$_POST["cityName"];
$street=$_POST["street"];
$address= $street . ' ' . $city;

$checkExistVal="SELECT ID FROM shelter where name='$shelterName' and address='$address'";
$result = $conn->query($checkExistVal);


if($result->num_rows==0){  
$InsertShelter="INSERT INTO shelter (name,risk,manager,phone,address,mail) VALUES('".$shelterName."','".$riskType."','".$shelterManager."','".$phone."','".$address."','".$email."');";
$conn->query($InsertShelter);
}
else{
    $errors = 'בית המחסה קיים במערכת';
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
