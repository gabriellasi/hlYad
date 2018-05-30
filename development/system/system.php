<?php
session_start();

if (isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    $permit = $_SESSION["permit"];
}
else{
    $user = "";
    $permit = 0;
}

//echo $user. "<br>";
//echo $permit. "<br>";

?>

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
//$originCityName= $_GET['cityName'];

$cityOrigin=$_GET["cityName"];

if(isset($originStreet)){
    $cityOrigin = $originStreet. ' ' . $cityOrigin;
}

//echo $cityOrigin."<br>";

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
//echo 'Address of shelters withoud distance'.'<br>';
//print_r($shelterArr);

//creating array of support groups addresses
while($rowGroup=mysqli_fetch_assoc($groupDestination_res)){
    $groupArr[]=$rowGroup['address'];
}

//echo 'Address of groups without distance'.'<br>';
//print_r($groupArr);

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

//print_r ($distanceResGroup);
//print_r ($addressNamesGroup);

$addressDistGroup= array_combine($distanceResGroup,$addressNamesGroup);
ksort($addressDistGroup);

//echo "this is the distance and address support groups"."<br>";
//print_r ($addressDistGroup);




//this is distance array of shelter
//echo "this is the address for each shelter"."<br>";
foreach($shelterArr as $valueShelter){
    //echo $valueShelter . "<br>";
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

//echo "array of shelter distance without address" .'<br>';
//print_r ($distanceResShelter);
//echo "address name shelter array".'<br>';
//print_r ($addressNamesShelter);

//echo "array shelter combined: adrress + distance"."<br>";
$addressDistShelter= array_combine($distanceResShelter,$addressNamesShelter);
//$addressDistShelter= array_combine($addressNamesShelter,$distanceResShelter);


//echo "this is the combined array not sorted";
//print_r ($addressDistShelter);
ksort($addressDistShelter);

//echo "This is sorted combine array of distance + address - shelters" .'<br>';
//print_r ($addressDistShelter);


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
//echo "this is the 100 percent array - group"."<br>";
//print_r($percentGroup);


$percentShelterCombine=array_combine($addressNamesShelter,$percentShelter);
$percentSupportCombine=array_combine($addressNamesGroup,$percentGroup);

//echo "this is the combined 100 percent and address - shelter"."<br>";
//print_r($percentShelterCombine);
//echo "this is the combined 100 percent and address - support"."<br>";
//print_r($percentSupportCombine);


//grading the $percentShelterCombine array according to distance
while($address = current($addressDistShelter)){
    
    //echo $address."<br>";
    $distanceKey = key ($addressDistShelter);
    //echo $distanceKey."<br>";
    $score=$percentShelterCombine[$address];
    //echo $score."<br>";
    if($distanceKey>="0" && $distanceKey <="5"){
        //echo $score;
    }
    elseif($distanceKey>"5" &&$distanceKey<="10"){
        $score = $score-2;
        //echo $score;
    }
    elseif($distanceKey>"10" &&$distanceKey<="15"){
        $score = $score-5;
        //echo $score;
    }
    elseif($distanceKey>"15" &&$distanceKey<="20"){
        $score = $score-7;
        //echo $score;
    }
    elseif($distanceKey>"20" &&$distanceKey<="30"){
        $score = $score-9;
        //echo $score;
    }
    elseif($distanceKey>"30" &&$distanceKey<="50"){
        $score = $score-13;
        //echo $score;
    }
    elseif($distanceKey>"50" &&$distanceKey<="70"){
        $score = $score-18;
        //echo $score;
    }
    elseif($distanceKey>"70" &&$distanceKey<="90"){
        $score = $score-22;
        //echo $score;
    }
    else{
        $score = $score-25;
        //echo $score;
    }
    $percentShelterCombine[$address]= $score;
    //echo $percentShelterCombine[$address];
    next($addressDistShelter);
}

//print_r($percentShelterCombine)."<br>";

//grading $percentShelterCombine array according to age
//echo "this is the min and max age of every shelter"."<br>";
while($grade = current($percentShelterCombine)){
    
    $addressKey = key ($percentShelterCombine);
    //echo $addressKey;
    $age_range ="SELECT min_age, max_age FROM shelter WHERE address='$addressKey'";
    $result = $conn->query($age_range);
    
   /* if(!$result = $conn->query($age_range)){
    die('There was an error running the query [' . $conn->error . ']');
    }*/
    

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $min_age = $row['min_age'];
            $max_age = $row['max_age'];
            //echo $min_age."<br>";
            //echo $max_age."<br>";
        }
    }
        
    if($userAge<$min_age || $userAge>$max_age){
        if($userAge < $min_age){
             if(($min_age-$userAge) < 5){
                  $percentShelterCombine[$addressKey]-=2;
                    //$scoreGroup =$scoreGroup-2;
             }
             else if(($min_age-$userAge) < 8){
                 $percentShelterCombine[$addressKey]-=4;
                 //$scoreGroup =$scoreGroup-4;
             }
            else {
                $percentShelterCombine[$addressKey]-=6;
                 //$scoreGroup =$scoreGroup-6;
             }
         }
        else if ($max_age<$userAge){
            if(($userAge-$max_age) < 5){
                $percentShelterCombine[$addressKey]-=2;
                    //$scoreGroup =$scoreGroup-2;
             }
             else if(($userAge-$max_age) < 8){
                 $percentShelterCombine[$addressKey]-=4;
                // $scoreGroup =$scoreGroup-4;
             }
            else {
                $percentShelterCombine[$addressKey]-=6;
                 //$scoreGroup =$scoreGroup-6;
             }
         }
     }
     
    /* if($userAge < $min_age || $max_age<$userAge){
    $percentShelterCombine[$addressKey]-=5;

    }*/

    
    //$percentShelterCombine[$addressKey]= $score;
    //echo $percentShelterCombine[$addressKey]; 
    next($percentShelterCombine);
}

//echo "final grades after age and distance check"."<br>";
//print_r($percentShelterCombine)."<br>";


//grading the $percentSupportCombine array according to distance
//echo "address of groups"."<br>";
while($addressGroup = current($addressDistGroup)){
   
    //echo $addressGroup."<br>";
    $distanceKeyGroup = key ($addressDistGroup);
    //echo $distanceKeyGroup."<br>";
    $scoreGruop=$percentSupportCombine[$addressGroup];
    //echo $scoreGruop;
    
    if($distanceKeyGroup>="0" && $distanceKeyGroup <="5"){
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"5" && $distanceKeyGroup<="10"){
        $scoreGruop = $scoreGruop-2;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"10" && $distanceKeyGroup<="15"){
        $scoreGruop = $scoreGruop-5;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"15" && $distanceKeyGroup<="20"){
        $scoreGruop = $scoreGruop-7;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"20" && $distanceKeyGroup<="30"){
        $scoreGruop = $scoreGruop-9;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"30" && $distanceKeyGroup<="50"){
        $scoreGruop = $scoreGruop-13;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"50" && $distanceKeyGroup<="70"){
        $scoreGruop = $scoreGruop-18;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"70" && $distanceKeyGroup<="90"){
        $scoreGruop = $scoreGruop-22;
        //echo $scoreGruop;
    }
    else{
        $scoreGruop = $scoreGruop-25;
        //echo $scoreGruop;
    }
    $percentSupportCombine[$addressGroup]= $scoreGruop;
    //echo $percentSupportCombine[$addressGroup];
    next($addressDistGroup);
}

//echo "precent support group combine array"."<br>";
//print_r($percentSupportCombine)."<br>";

//grading $percentSupportCombine array according to age
//echo "this is the min and max age of every support group"."<br>";
while($gradeSupport = current($percentSupportCombine)){
    
    $addressKeyGroup = key ($percentSupportCombine);
    $age_range_group ="SELECT min_age, max_age FROM support_group WHERE address='$addressKeyGroup'";
    $resultGroup = $conn->query($age_range_group);
    
    
    if($resultGroup->num_rows > 0){
        while($rowGoup = $resultGroup->fetch_assoc()){
            $min_age_group = $rowGoup['min_age'];
            $max_age_group = $rowGoup['max_age'];
            //echo $min_age_group."<br>";
            //echo $max_age_group."<br>";
        
    }
    
            if($userAge <  $min_age_group || $userAge>$max_age_group){
                if($userAge < $min_age_group){
                     if(($min_age_group-$userAge) < 5){
                          $percentSupportCombine[$addressKeyGroup]-=2;
                            //$scoreGroup =$scoreGroup-2;
                     }
                     else if(($min_age_group-$userAge) < 8){
                         $percentSupportCombine[$addressKeyGroup]-=4;
                         //$scoreGroup =$scoreGroup-4;
                     }
                    else {
                        $percentSupportCombine[$addressKeyGroup]-=6;
                         //$scoreGroup =$scoreGroup-6;
                     }
                 }
                else if ($max_age_group<$userAge){
                    if(($userAge-$max_age_group) < 5){
                        $percentSupportCombine[$addressKeyGroup]-=2;
                            //$scoreGroup =$scoreGroup-2;
                     }
                     else if(($userAge-$max_age_group) < 8){
                         $percentSupportCombine[$addressKeyGroup]-=4;
                        // $scoreGroup =$scoreGroup-4;
                     }
                    else {
                        $percentSupportCombine[$addressKeyGroup]-=6;
                         //$scoreGroup =$scoreGroup-6;
                     }
                 }
            }
        
        }

    
   /* if($userAge <  $min_age_group ||  $max_age_group<$userAge){
        $percentSupportCombine[$addressKeyGroup]-=5;
    }*/

    //$percentSupportCombine[$addressKeyGroup]= $scoreGruop;
    //echo $percentSupportCombine[$addressKeyGroup];
    next($percentSupportCombine);
}

//echo "final grades after age and distance check - Support Group"."<br>";
//print_r($percentSupportCombine);

//sorting Shelter final Grades!
//echo "the shelter grades after sorting:"."<br>";
arsort($percentShelterCombine);
//print_r($percentShelterCombine);

//echo "the Support Group grades after sorting:"."<br>";
arsort($percentSupportCombine);
//print_r($percentSupportCombine);

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
    <head>
        <title>הושט לי יד</title>
        <meta charset="utf-8">
        <link rel="icon" href="logo_icon.png">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Amatic SC" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="homePageStyle.css"> 
        <link rel="stylesheet" type="text/css" href="systemDesign.css"> 
        
        <script>
        var permission = <?php echo $permit?>;
        </script>
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
        <div class="header">
            <div id="log">
                <a href="http://gabriellasi.mtacloud.co.il/registrationLogin/registraion_latest.php"><i id="logIn"  class="fa" title="התחבר" >&#xf007;</i></a
            </div>
            
            <div class="text-center">
                <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php"><img id="logo" src="logo.png"></a>
            </div>
            
            <a href="http://gabriellasi.mtacloud.co.il/contact%20us/contactPage.php" onclick="signOut();" id="signOut" style="display:none;"> התנתק</a>
             
             <script>
                function signOut() {
                    gapi.auth2.init();
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                        console.log('User signed out.');
                    });
                    <?php
                    session_unset($_SESSION["user"]);
                    session_unset($_SESSION["permit"]);
                    //$_SESSION["user"] = "";
                    //$_SESSION["permit"]= 0;
                    session_destroy();
                    ?>
                    window.location.reload();
                    refreshPage();
                }
            </script>
            
            
            <div id="wrapper">
                <div class="overlay"></div>
                <!-- Sidebar -->
                <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                    <ul class="nav sidebar-nav">
                        <li class="sidebar-brand">
                            <a name="hlyTitle">הושט לי יד</a>
                        </li>
                        <hr>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php">דף הבית</a>
                        </li>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/about%20-%20try/about.php">אודות</a>
                        </li>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/activities%20page/activities.php">תחומי פעילות</a>
                        </li>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/joinUs/joinus.php">הצטרפות כגוף מטפל</a>
                        </li>
                    </ul>
                </nav>
                <!-- /#sidebar-wrapper -->
                
                <!-- Page Content -->
                <div id="page-content-wrapper">
                    <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                        <span class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                        </button>
                </div>
            </div>
            
            <div class="pointer" id="youthNav">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="http://gabriellasi.mtacloud.co.il/systemTryDesign/system.html">התאמת גוף מטפל</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/Shelters%20list/shelterList.php">בתי מחסה</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/support%20group%20list/supportTable.php">קבוצות תמיכה</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/hot%20line%20list/hotLineTable.php">קווים חמים</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/PersonalErea/personalPage_Trial.php" id="personalAreaLink" style="display:none;">איזור אישי</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/contact%20us/contactPage.php">יצירת קשר</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
                </div>
            </div>
        </div>
        </div>
        <hr>
        <script>
            if (permission !=0){
                    $("#signOut").css("display", "block");
                }
                //admin
                if (permission == 1){
                    $("#adminNav").css("display", "block");
                    $("#careService").css("display", "block");
                    $("#volunteerNav").css("display", "block");
                }
                
                //youth
                if (permission == 2){
                    $("#youthNav").css("display", "block");
                    $("#personalAreaLink").css("display", "block");
                }
                
                //shelter
                if (permission == 3){
                    $("#careService").css("display", "block");
                    $("#youthNav").css("display", "none");
                }
                
                //support group
                if (permission == 4){
                    $("#careService").css("display", "block");
                    $("#youthNav").css("display", "none");
                }
                
                //volunteer
                if (permission == 5){
                    $("#volunteerNav").css("display", "block");
                    $("#youthNav").css("display", "none");
                }
                
        </script>
        
        
        <main>
        <div class="container">
        <h4 id="matchTitle">לתשומת לבך,
            ההתאמה שבוצעה הינה אישית עבורך
        ומבוססת על הגיל, המיקום ותחום הסיכון שהזנת  </h4><p>באפשרותך לבחור מספר גופי טיפול (בית מחסה וגם קבוצת תמיכה, או רק אחד מהשניים).</p></div>

<?php



$type="submit";
$btnClass="btn btn-info btn-lg";
$btnCheck="check";
$btnValueSupport="רשימת קבוצות תמיכה";
$btnValueShelter="רשימת בתי מחסה";
$btnValueHotLine="רשימת קווים חמים";
$btnValueCheck="שלח בחירה";
$btnIdSupport="btnSupport";
$btnIdShelter="btnShelter";
$btnIdLine="btnLine";
$btnIdCheck="btnCheck";
$ClassName="table-responsive";
$Table="table";
$Container="container";
$idShelter="divShelter";
$idSupport="divSupport";
$idLines="divLine";
$btnViewDataShelter="dataShelter";
$btnViewDataSupport="dataSupport";
$name="name";
//$contatiner = "container";

$typeCheckbox = "checkbox";
$nameCheckboxSupport = "supportGroupCheck";
$nameCheckboxShelter = "shelterCheck";

echo "<div class='$Container'>";
echo "<input type='$type' class='$btnClass' value='$btnValueSupport' id='$btnIdSupport'>";
echo "<div id='$idSupport'>";
echo "<div class='$Container'>";
echo "<div class='$ClassName'>";
echo "<table class='$Table' >
    <tr><th> שם קבוצת תמיכה </th><th> אחוז התאמה</th><th>פרטים נוספים</th><th>בחירה</th></tr>";
while($gradeSupport = current($percentSupportCombine)){
    
    $addressKeyGroup = key ($percentSupportCombine);
    //echo $addressKeyGroup;
    
    $resultGroups = "SELECT name FROM support_group WHERE address ='$addressKeyGroup'";
     $resGroup = $conn->query($resultGroups);


   if($resGroup->num_rows > 0){
    while($rowGroup = $resGroup->fetch_assoc()){
      echo "<tr><td>".$rowGroup["name"]."</td><td>".$gradeSupport."%</td><td><button id='$rowGroup[$name]' class='$btnViewDataSupport'>מידע נוסף</button></td><td><input type='$typeCheckbox' name='$nameCheckboxSupport' value='$rowGroup[$name]' class='$btnCheck'></td></tr>";

    }
}

   next($percentSupportCombine);

}


echo "</table>";
echo "</div>";
echo"</div>";
echo "</div>";
//print_r($percentSupportCombine);

echo "<input type='$type' class='$btnClass' value='$btnValueShelter' id='$btnIdShelter' >";
echo "<div id='$idShelter'>";
echo "<div class='$Container'>";
echo "<div class='$ClassName'>";
echo "<table class='$Table' >
    <tr><th> שם בית מחסה </th><th> אחוז התאמה</th><th>פרטים נוספים</th><th>בחירה</th></tr>";
while($gradeShelter = current($percentShelterCombine)){
    
    $addressKeyShelter = key ($percentShelterCombine);
    
    $resultShelter = "SELECT name FROM shelter WHERE address ='$addressKeyShelter'";
    $resShelter = $conn->query($resultShelter);
    
    
    if($resShelter->num_rows > 0){
    while($rowShelter = $resShelter->fetch_assoc()){
        echo "<tr><td>".$rowShelter["name"]."</td><td>".$gradeShelter."%</td><td><button id='$rowShelter[$name]' class='$btnViewDataShelter'>מידע נוסף</button></td><td><input type='$typeCheckbox' name='$nameCheckboxShelter' value='$rowShelter[$name]' class='$btnCheck'></td></tr>";
    }

}
     next($percentShelterCombine);

}
echo "</table>";
echo "</div>";
echo"</div>";
echo "</div>";


echo "<input type='$type' class='$btnClass' value='$btnValueHotLine' id='$btnIdLine' >";

 $resultHotLine = "SELECT name,phone,mail,website_url FROM hot_line WHERE risk ='$originRiskTypet'";
    $resHotLine = $conn->query($resultHotLine);
    
echo "<div id='$idLines'>";
echo "<div class='$Container'>";
echo "<div class='$ClassName'>";
echo "<table class='$Table' >
    <tr><th>שם הקו החם</th><th>טלפון</th><th>כתובת מייל</th><th>אתר אינטרנט</th></tr>";
    if($resHotLine->num_rows>0){
        while($rowHotLine=$resHotLine->fetch_assoc()){
            echo"<tr><td>".$rowHotLine["name"]."</td><td>".$rowHotLine["phone"]."</td><td>".$rowHotLine["mail"]."</td><td>".$rowHotLine["website_url"]."</td></tr>";
        }
    }
echo "</table>";
echo "</div>";
echo"</div>";
echo"</div>";

echo "<input type='$type' class='$btnClass' value='$btnValueCheck' id='$btnIdCheck' >";
echo "</div>";


?>

 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">פרטי הגוף המטפל</h4>  
                </div>  
                <div class="modal-body" id="moreDetails">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">סגירה</button>  
                </div>  
           </div>  
      </div>  
 </div> 
 
 
  <div id="dataModalCheck" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">אנא מלא/י את הפרטים הבאים:</h4> 
                </div>  
                <div class="modal-body" id="moreDetails">  
                </div>  
                <div>
                    <input type="email" class="form-control" name="email" id="email" value="" placeholder="כתובת מייל"> 
                    <textarea name="comments" class="form-control" id="comments" maxlength="6000" minlength="10" rows="7" placeholder="השאר הודעה"></textarea>
                </div> 
                <div class="modal-footer">  
                     <button id="sendUserChoice"type="button" class="btn btn-default" data-dismiss="modal">שליחה</button>  
                </div>  
           </div>  
      </div>  
 </div> 
</main>
 <script>
$(document).ready(function(){
    $("#btnSupport").click(function(){
        $("#divSupport").toggle();
    });
     $("#btnShelter").click(function(){
        $("#divShelter").toggle();
    });
     $("#btnLine").click(function(){
        $("#divLine").toggle();
    });
});
</script>
<script>  
 $(document).ready(function(){  
      $('.dataSupport').click(function(){  
           var placeNameSupport = $(this).attr("id"); 
           console.log(placeNameSupport);
           $.ajax({  
                url:"select.php",  
                method:"post",  
                data:{ placeNameSupport : placeNameSupport },  
                success:function(data){  
                     $('#moreDetails').html(data);
                   // $('.modal-title').html("בחירתך הועברה בהצלחה!");
                      $('.modal-title').html("פרטי הגוף המטפל");
                     $('#dataModal').modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                }); 
                }    
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('#sendUserChoice').click(function(){  
           var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
        
        var emailUser = document.getElementById("email").value;
        var messgeUser = document.getElementById("comments").value;
        
        console.log(emailUser);
        console.log(messgeUser);
           
           $.ajax({  
                url:"userChoice.php",  
                method:"post",  
                data:{ myCheckboxes : myCheckboxes,
                email : emailUser,
                comments : messgeUser
                },  
                success:function(data){  
                     $('#moreDetails').html(data); 
                     $('.modal-title').html("בחירתך הועברה בהצלחה!");
                     $('#dataModal').modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                }); 
                }    
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.dataShelter').click(function(){  
           var placeNameShelter = $(this).attr("id"); 
           console.log(placeNameShelter);
           $.ajax({  
                url:"select.php",  
                method:"post",  
                data:{ placeNameShelter : placeNameShelter },  
                success:function(data){  
                     $('#moreDetails').html(data); 
                      $('.modal-title').html("פרטי הגוף המטפל");
                     $('#dataModal').modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                }); 
                }    
           });  
      });  
 });  
 </script>
 <script>
    $("#btnCheck").click(function(e){
    if($(".check:checked").length == 0){
        e.preventDefault();
        $('#moreDetails').html("אנא בחר/י לפחות שדה אחד");
         $('.modal-title').html("לתשומת לבך!");
         $("#dataModal").modal("show");
    }
    else{
        $('.modal-title').html("אנא מלא/י את הפרטים הבאים");
        $('#dataModalCheck').modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
        $("#dataModalCheck").modal("show");
    }
});
</script>

<footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="#"><img src="logo_icon.png" id="logo_foo"></a>
                    </div>
                    <div class="col-sm-9">
                        <h4 class="title" >הושט לי יד - ארגון לנוער במצבי סיכון</h4>
                            <p id="about"> 
                            <br>אבן גבירול 26, רמת גן, ת.ד 52217
                            <br>טל. 03-3657777 פקס. 03-2550319
                            <br><b>hoshetLiYad@gmail.com</b></p>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <ul class="social-icon">
                        <a href="#" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-google" aria-hidden="true"></i></a>
                    </ul>
                </div>
            </div>	
        </footer>
        
        <script>
                $(document).ready(function () {
          var trigger = $('.hamburger'),
              overlay = $('.overlay'),
             isClosed = false;
        
            trigger.click(function () {
              hamburger_cross();      
            });
        
            function hamburger_cross() {
        
              if (isClosed == true) {          
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
              } else {   
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
              }
          }
          
          $('[data-toggle="offcanvas"]').click(function () {
                $('#wrapper').toggleClass('toggled');
          });  
        });
                
        </script>
        
        <script>
        // שפת התוסף, עברית - ברירת מחדל: he, אנגלית: en
        nl_lang = "he";
        // מיקום התוסף, שמאל למעלה - ברירת מחדל: tl, שמאל למטה: bl, ימין למעלה: tr, ימין למטה: br
        nl_pos = "bl";
        // הצהרת הנגישות עבור התוסף, כתובת ישירה אל הצהרת הנגישות של האתר שלך
        nl_link = "0";
        // צבע התוסף המתאים ביותר לאתרך מתוך 10 צבעים לבחור מתוכם כרגע
        nl_color = "gray ";
        // האם התוסף יוצג כסרגל או כלחצן
        nl_compact = "1";
        // האם לפתוח תפריט אחד בכל פעם
        nl_accordion = "0";
        </script>
        <script type="text/javascript" charset="utf-8" src="http://gabriellasi.mtacloud.co.il/accessibility/nagishli.js" defer>
        </script>
</body>
</html>
<?php
$conn->close();
?>
