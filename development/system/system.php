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

/*$shelterDestinationSQL = "SELECT address FROM shelter";*/
/*$groupDestinationSQL = "SELECT address FROM support_group";*/



$shelterDestinationSQL = "SELECT address FROM shelter";
$groupDestinationSQL =  "SELECT address FROM support_group";

$shelterDestination_res=$conn->query($shelterDestinationSQL);
$groupDestination_res=$conn->query($groupDestinationSQL);

$shelterArr= array();
$groupArr= array();

while($rowShelter=mysqli_fetch_assoc($shelterDestination_res)){
    $shelterArr[]=$rowShelter['address'].'|';
}

while($rowGroup=mysqli_fetch_assoc($groupDestination_res)){
    $groupArr[]=$rowGroup['address'].'|';
}


foreach($shelterArr as $valueShelter){
    echo $valueShelter . "<br>";
}


foreach($groupArr as $valueGroup){
    echo $valueGroup . "<br>";
}

//use mysqli->affected_rows

//this will return a nested array

$destinationsShelter = implode($shelterArr);

$cityOrigin=$_GET["cityName"];
echo $cityOrigin;

//$originCity = $_POST['city1'];

//echo $originCity;



//echo $origin;
//echo $_POST['city'];

//$urlContentsShelter = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($_POST['city1'])."&destinations=".urlencode($destinationsShelter)."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";

//*$urlContentsGroup = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($_GET[''])."&destinations=".urlencode($rowGroup)."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";*/



//free results
/*mysqli_free_result($rowShelter);
mysqli_free_result($rowGroup);*/


//$data = file_get_contents($urlContentsShelter);
//$distancesShelter = json_decode($data);

//print_r($distancesShelter);


?>