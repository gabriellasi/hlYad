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

$originStreet= $_GET['street'];
$originRiskTypet= $_GET['riskType'];
$userAge= $_GET['age'];
$originCityName= $_GET['cityName'];

$cityOrigin=$_GET["cityName"];

$shelterDestinationSQL = "SELECT address FROM shelter where risk=$originRiskTypet";
$groupDestinationSQL =  "SELECT address FROM support_group where risk=$originRiskTypet";

$shelterDestination_res=$conn->query($shelterDestinationSQL);
$groupDestination_res=$conn->query($groupDestinationSQL);

$shelterArr= array();
$groupArr= array();

$distanceResShelter = array();
$addressNamesShelter= array();

$distanceResGroup= array();
$addressNamesGroup= array();




//creating array of shelters addresses
while($rowShelter=mysqli_fetch_assoc($shelterDestination_res)){
    $shelterArr[]=$rowShelter['address'];
}

//creating array of support groups addresses
while($rowGroup=mysqli_fetch_assoc($groupDestination_res)){
    $groupArr[]=$rowGroup['address'];
}

//this is distance array of support group
foreach($groupArr as $valueGroup){
    echo $valueGroup.'<br>';
    
    $urlContentsGroup = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($cityOrigin)."&destinations=".urlencode("$valueGroup")."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";
    $group_data = file_get_contents($urlContentsGroup);
    $distancesGroup = json_decode($group_data, true);
    //$distance="the distance from".$cityOrigin."to".$valueGroup."is".$distancesGroup['rows'][0]['elements'][0]['distance']['text'];
    $destinationKM_group=$distancesGroup['rows'][0]['elements'][0]['distance']['text'];
    
    $addressNamesGroup[]=$valueGroup;
    
    $destinationKM_group=substr($destinationKM_group,0,-2);
    $destinationKM_group=intval($destinationKM_group);
    echo $destinationKM_group.'<br>';
    $distanceResGroup[]=$destinationKM_group;
}

$addresDistGroup= array_combine($distanceResGroup,$addressNamesGroup);
ksort($addresDistGroup);
print_r ($addresDistGroup);




//this is distance array of shelter
foreach($shelterArr as $valueShelter){
    echo $valueShelter . "<br>";
    $urlContentsShelter = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($cityOrigin)."&destinations=".urlencode("$valueShelter")."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";
    $shelter_data = file_get_contents($urlContentsShelter);
    $distancesShelter = json_decode($shelter_data, true);
    $distance="the distance from".$cityOrigin."to".$valueShelter."is".$distancesShelter['rows'][0]['elements'][0]['distance']['text'];
   $destinationKM=$distancesShelter['rows'][0]['elements'][0]['distance']['text'];
   
   $addressNamesShelter[] = $valueShelter;
   
   $destinationKM=substr($destinationKM, 0, -2);
   $destinationKM=intval($destinationKM);
   echo $destinationKM.'<br>';
   $distanceResShelter[]= $destinationKM;
}

//print_r ($distanceResShelter);
//print_r ($addressNamesShelter);

$addressDistShelter= array_combine($distanceResShelter,$addressNamesShelter);
//print_r ($addressDistShelter);
ksort($addressDistShelter);
print_r ($addressDistShelter);


$percentShelter=array();
$percentGroup=array();

// percent array for shelter
foreach($addressNamesShelter as $addressNamesShelterValue ){
    $percentShelter[]=100;
}
print_r($percentShelter);

// percent array for support group
foreach($addressNamesGroup as $addressNamesGroupValue ){
    $percentGroup[]=100;
}

print_r($percentGroup);


$percentShelterCombine=array_combine($addressNamesShelter,$percentShelter);
$percentSupportGCombine=array_combine($addressNamesGroup,$percentGroup);

print_r($percentShelterCombine);
print_r($percentSupportGCombine);

//grading the $percentShelterCombine array according to distance
while($valueDist = current($addressDistShelter)){
    
    echo $valueDist."<br>";
    $distanceKey = key ($addressDistShelter);
    echo $distanceKey."<br>";
    $score=$percentShelterCombine[$valueDist];
    
    if($distanceKey>="0" && $distanceKey <="5"){
        echo $score;
    }
    elseif($distanceKey<="10"){
        $score = $score-5;
        echo $score;
    }
    elseif($distanceKey<="20"){
        $score = $score-10;
        echo $score;
    }
    else{
        $score = $score-15;
        echo $score;
    }
    $percentShelterCombine[$valueDist]= $score;
    next($addressDistShelter);
}

print_r($percentShelterCombine);

//grading $percentShelterCombine array according to age
while($valueDist = current($percentShelterCombine)){
    
    $addressKey = key ($percentShelterCombine);
    $age_range ="SELECT min_age, max_age FROM shelter where address='$addressKey'";
    $result = $conn->query($age_range);
    
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $min_age = $row['min_age'];
            $max_age = $row['max_age'];
        }
    }
    echo "min: ".$min_age."<br>";
    echo "max: ".$max_age."<br>";
    $score=$percentShelterCombine[$addressKey];
    
    if($userAge < $min_age || $max_age<$userAge){
        $score = $score-10;
    }
    
    $percentShelterCombine[$addressKey]= $score;
    next($percentShelterCombine);
}

print_r($percentShelterCombine);


/*while($rowShelter=mysqli_fetch_assoc($shelterDestination_res)){
    $shelterArr[]=$rowShelter['address'].'|';
}*/

/*while($rowGroup=mysqli_fetch_assoc($groupDestination_res)){
    $groupArr[]=$rowGroup['address'].'|';
}*/


/*foreach($shelterArr as $valueShelter){
    echo $valueShelter . "<br>";
}


foreach($groupArr as $valueGroup){
    echo $valueGroup . "<br>";
}*/


/*$destinationsShelter = implode($shelterArr);
echo $destinationsShelter;

$cityOrigin=$_GET["cityName"];
echo $cityOrigin . "<br>";

$natanya="נתניה";



$urlContentsShelter = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($cityOrigin)."&destinations=".urlencode($shelterArr)."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";

$shelter_data = file_get_contents($urlContentsShelter);
$distancesShelter = json_decode($shelter_data, true);
print_r($distancesShelter);


$distance="the distance from".$cityOrigin."to".$shelterArr[15]."is".$distancesShelter['rows'][0]['elements'][15]['distance']['text'];
echo $distance;


/*$distance="the distance from".$cityOrigin."to".$shelterArr[15]."is".$distancesShelter['rows'][0]['elements'][15]['distance']['text'];
echo $distance;*/

/*$urlContentsGroup = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($_GET[''])."&destinations=".urlencode($rowGroup)."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";
*/


//free results
/*mysqli_free_result($rowShelter);
mysqli_free_result($rowGroup);*/






?>