
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

$lineName=$_POST["lineName"];
$lineManager=$_POST["lineManager"];
$riskType=$_POST["riskType"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$url=$_POST["url"];

$checkExistVal="SELECT ID FROM hot_line where name='$lineName' and  risk='$riskType'";
$result = $conn->query($checkExistVal);


if($result->num_rows==0){  
$InsertLine="INSERT INTO hot_line (name,risk,manager,phone,mail,website_url) VALUES('".$lineName."','".$riskType."','".$lineManager."','".$phone."','".$email."','".$url."');";
$conn->query($InsertLine);
}
else{
    $errors = 'הקו החם קיים במערכת';
}

if(!empty($errors)){
    $data['success']=false;
    $data['message']=$errors;
}
else{
    $data['success']=true;
    $data['message']='הקו החם הוסף למערכת בהצלחה';
}

echo $data['message'];

$conn->close();
?>
