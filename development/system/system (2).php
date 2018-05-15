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
echo 'Address of shelters withoud distance'.'<br>';
print_r($shelterArr);

//creating array of support groups addresses
while($rowGroup=mysqli_fetch_assoc($groupDestination_res)){
    $groupArr[]=$rowGroup['address'];
}

echo 'Address of groups withoud distance'.'<br>';
print_r($groupArr);

//this is distance array of support group
foreach($groupArr as $valueGroup){
    //echo $valueGroup.'<br>';
    
    $urlContentsGroup = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($cityOrigin)."&destinations=".urlencode("$valueGroup")."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";
    $group_data = file_get_contents($urlContentsGroup);
    $distancesGroup = json_decode($group_data, true);
    //$distance="the distance from".$cityOrigin."to".$valueGroup."is".$distancesGroup['rows'][0]['elements'][0]['distance']['text'];
    $destinationKM_group=$distancesGroup['rows'][0]['elements'][0]['distance']['text'];
    
    $addressNamesGroup[]=$valueGroup;
    
    $destinationKM_group=substr($destinationKM_group,0,-2);
    $destinationKM_group=doubleval($destinationKM_group);
    //echo $destinationKM_group.'<br>';
    $distanceResGroup[]=$destinationKM_group;
}

$addressDistGroup= array_combine($distanceResGroup,$addressNamesGroup);
ksort($addressDistGroup);

echo "this is the combined 100 percent and support addresses after sort"."<br>";
print_r ($addressDistGroup);




//this is distance array of shelter
echo "this is the address for each shelter"."<br>";
foreach($shelterArr as $valueShelter){
    echo $valueShelter . "<br>";
    $urlContentsShelter = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($cityOrigin)."&destinations=".urlencode("$valueShelter")."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";
    $shelter_data = file_get_contents($urlContentsShelter);
    $distancesShelter = json_decode($shelter_data, true);
    $distance="the distance from".$cityOrigin."to".$valueShelter."is".$distancesShelter['rows'][0]['elements'][0]['distance']['text'];
   $destinationKM=$distancesShelter['rows'][0]['elements'][0]['distance']['text'];
   
   $addressNamesShelter[] = $valueShelter;
   
   $destinationKM=substr($destinationKM, 0, -2);
   $destinationKM=doubleval($destinationKM);
   //echo $destinationKM.'<br>';
   $distanceResShelter[]= $destinationKM;
   
}

echo "array of shelter distance without address" .'<br>';
print_r ($distanceResShelter);
echo "address name shelter array".'<br>';
print_r ($addressNamesShelter);

echo "array shelter combined: adrress + distance"."<br>";
$addressDistShelter= array_combine($distanceResShelter,$addressNamesShelter);
//$addressDistShelter= array_combine($addressNamesShelter,$distanceResShelter);


//echo "this is the combined array not sorted";
//print_r ($addressDistShelter);
ksort($addressDistShelter);

echo "This is sorted combine array of distance + address - shelters" .'<br>';
print_r ($addressDistShelter);


$percentShelter=array();
$percentGroup=array();

// percent array for shelter
foreach($addressNamesShelter as $addressNamesShelterValue ){
    $percentShelter[]=100;
}
//echo "this is the 100 percent array - shelter"."<br>";
//print_r($percentShelter);

// percent array for support group
foreach($addressNamesGroup as $addressNamesGroupValue ){
    $percentGroup[]=100;
}
echo "this is the 100 percent array - group"."<br>";
print_r($percentGroup);


$percentShelterCombine=array_combine($addressNamesShelter,$percentShelter);
$percentSupportCombine=array_combine($addressNamesGroup,$percentGroup);

//echo "this is the combined 100 percent and address - shelter"."<br>";
//print_r($percentShelterCombine);
echo "this is the combined 100 percent and address - support"."<br>";
print_r($percentSupportCombine);

//grading the $percentShelterCombine array according to distance
while($address = current($addressDistShelter)){
    
    echo $address."<br>";
    $distanceKey = key ($addressDistShelter);
    echo $distanceKey."<br>";
    $score=$percentShelterCombine[$address];
    
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
    $percentShelterCombine[$address]= $score;
    next($addressDistShelter);
}

print_r($percentShelterCombine);

//grading $percentShelterCombine array according to age
echo "this is the min and max age of every shelter"."<br>";
while($grade = current($percentShelterCombine)){
    
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

echo "final grades after age and distance check"."<br>";
print_r($percentShelterCombine);


//grading the $percentSupportCombine array according to distance
echo "address of groups"."<br>";
while($addressGroup = current($addressDistGroup)){
   
    echo $addressGroup."<br>";
    $distanceKeyGroup = key ($addressDistGroup);
    echo $distanceKeyGroup."<br>";
    $scoreGruop=$percentSupportCombine[$addressGroup];
    
    if($distanceKeyGroup>="0" && $distanceKeyGroup <="5"){
        echo $scoreGruop;
    }
    elseif($distanceKeyGroup<="10"){
        $scoreGruop = $scoreGruop-5;
        echo $scoreGruop;
    }
    elseif($distanceKeyGroup<="20"){
        $scoreGruop = $scoreGruop-10;
        echo $scoreGruop;
    }
    else{
        $scoreGruop = $scoreGruop-15;
        echo $scoreGruop;
    }
    $percentSupportCombine[$addressGroup]= $scoreGruop;
    next($addressDistGroup);
}

echo "precent support group combine array"."<br>";
print_r($percentSupportCombine);

//grading $percentSupportCombine array according to age
echo "this is the min and max age of every support group"."<br>";
while($gradeSupport = current($percentSupportCombine)){
    
    $addressKeyGroup = key ($percentSupportCombine);
    $age_range_group ="SELECT min_age, max_age FROM support_group where address='$addressKeyGroup'";
    $resultGroup = $conn->query($age_range_group);
    
    
    if($resultGroup->num_rows > 0){
        while($row = $resultGroup->fetch_assoc()){
            $min_age_group = $row['min_age'];
            $max_age_group = $row['max_age'];
        }
    }
    echo "min: ".$min_age_group."<br>";
    echo "max: ".$max_age_group."<br>";
    $scoreGroup=$percentSupportCombine[$addressKeyGroup];
    
    if($userAge <  $min_age_group ||  $max_age_group<$userAge){
        $scoreGroup =$scoreGroup-10;
    }
    
    $percentSupportCombine[$addressKeyGroup]= $scoreGroup;
    next($percentSupportCombine);
}

echo "final grades after age and distance check - Support Group"."<br>";
print_r($percentSupportCombine);





?>
