
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

$errors=array(); // hold validation errors
$data = array(); //  pass back data

$tableName=$_POST["tableName"];
$name=$_POST["name"];
$manager=$_POST["manager"];
$addresse=$_POST["address"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$website=$_POST["website"];
$minAge=$_POST["minAge"];
$maxAge=$_POST["maxAge"];

$checkTableName=("SHOW TABLES LIKE '".$tableName."'");
$checkTableNameRes = $conn->query($checkTableName);
if($checkTableNameRes->num_rows == 1) {
        $errors = 'שם הטבלה קיים במערכת';
    }
else {
   $createTable=("CREATE TABLE `".$tableName."`(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)");
if ($conn->query($createTable) === FALSE) {
    $errors = 'שגיאה ביצירת הטבלה';
     }
else{
   
if (isset($name)){
$addName=("ALTER TABLE `".$tableName."`
ADD name varchar(40) CHARACTER SET utf8");
if ($conn->query($addName) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת שם הגוף';
}
}

if (isset($manager)){
$addManager=("ALTER TABLE `".$tableName."`
ADD manager varchar(20) CHARACTER SET utf8");
if ($conn->query($addManager) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת מנהל';
}
}

if (isset($addresse)){
$addAddress=("ALTER TABLE `".$tableName."`
ADD address varchar(30) CHARACTER SET utf8");
if ($conn->query($addAddress) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת כתובת';
}
}

if (isset($phone)){
$addPhone=("ALTER TABLE `".$tableName."`
ADD phone varchar(30) CHARACTER SET utf8");
if ($conn->query($addPhone) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת טלפון';
}
}

if (isset($email)){
$addEmail=("ALTER TABLE `".$tableName."`
ADD email varchar(50) CHARACTER SET utf8");
if ($conn->query($addEmail) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת כתובת מייל';
}
}

if (isset($website)){
$addWebsite=("ALTER TABLE `".$tableName."`
ADD website_url varchar(60) CHARACTER SET utf8");
if ($conn->query($addWebsite) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת אתר אינטרנט';

}
}

if (isset($minAge)){
$addMinAge=("ALTER TABLE `".$tableName."`
ADD min_age int(11)");
if ($conn->query($addMinAge) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת גיל מינימלי';
}
}

if (isset($maxAge)){
$addMaxAge=("ALTER TABLE `".$tableName."`
ADD max_age int(11)");
if ($conn->query($addMaxAge) === FALSE) {
    $errors = 'שגיאה בהוספת עמודת גיל מקסימלי';
}
}
}
}

if(!empty($errors)){
    $data['success']=false;
    $data['message']=$errors;
}

else{
    $data['success']=true;
    $data['message']='הטבלה נוצרה בהצלחה';
    
}

echo $data['message'];

$conn->close();

    $email_to = "hoshetly@gmail.com";
    $email_subject = "טבלה חדשה נפתחה";
    $email_message = "פרטי הטבלה";



mail( $email_to, $email_subject, $email_message); 
 
?>