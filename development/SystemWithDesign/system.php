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
    
    if($distanceKey>="0" && $distanceKey <="5"){
        //echo $score;
    }
    elseif($distanceKey>"5" &&$distanceKey<="10"){
        $score = $score-5;
        //echo $score;
    }
    elseif($distanceKey>"10" &&$distanceKey<="15"){
        $score = $score-7;
        //echo $score;
    }
    elseif($distanceKey>"15" &&$distanceKey<="20"){
        $score = $score-9;
        //echo $score;
    }
    elseif($distanceKey>"20" &&$distanceKey<="30"){
        $score = $score-11;
        //echo $score;
    }
    elseif($distanceKey>"30" &&$distanceKey<="50"){
        $score = $score-13;
        //echo $score;
    }
    else{
        $score = $score-15;
        //echo $score;
    }
    $percentShelterCombine[$address]= $score;
    next($addressDistShelter);
}

//print_r($percentShelterCombine);

//grading $percentShelterCombine array according to age
//echo "this is the min and max age of every shelter"."<br>";
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
    //echo "min: ".$min_age."<br>";
    //echo "max: ".$max_age."<br>";
    $score=$percentShelterCombine[$addressKey];
    
    if($userAge < $min_age || $max_age<$userAge){
        $score = $score-10;
    }
    
    $percentShelterCombine[$addressKey]= $score;
    next($percentShelterCombine);
}

//echo "final grades after age and distance check"."<br>";
//print_r($percentShelterCombine);


//grading the $percentSupportCombine array according to distance
//echo "address of groups"."<br>";
while($addressGroup = current($addressDistGroup)){
   
    //echo $addressGroup."<br>";
    $distanceKeyGroup = key ($addressDistGroup);
    //echo $distanceKeyGroup."<br>";
    $scoreGruop=$percentSupportCombine[$addressGroup];
    
    if($distanceKeyGroup>="0" && $distanceKeyGroup <="5"){
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"5" && $distanceKeyGroup<="10"){
        $scoreGruop = $scoreGruop-5;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"10" && $distanceKeyGroup<="15"){
        $scoreGruop = $scoreGruop-7;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"15" && $distanceKeyGroup<="20"){
        $scoreGruop = $scoreGruop-9;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"20" && $distanceKeyGroup<="30"){
        $scoreGruop = $scoreGruop-11;
        //echo $scoreGruop;
    }
    elseif($distanceKeyGroup>"30" && $distanceKeyGroup<="50"){
        $scoreGruop = $scoreGruop-13;
        //echo $scoreGruop;
    }
    else{
        $scoreGruop = $scoreGruop-15;
        //echo $scoreGruop;
    }
    $percentSupportCombine[$addressGroup]= $scoreGruop;
    next($addressDistGroup);
}

//echo "precent support group combine array"."<br>";
//print_r($percentSupportCombine);

//grading $percentSupportCombine array according to age
//echo "this is the min and max age of every support group"."<br>";
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
    //echo "min: ".$min_age_group."<br>";
    //echo "max: ".$max_age_group."<br>";
    $scoreGroup=$percentSupportCombine[$addressKeyGroup];
    
    if($userAge <  $min_age_group ||  $max_age_group<$userAge){
        $scoreGroup =$scoreGroup-10;
    }
    
    $percentSupportCombine[$addressKeyGroup]= $scoreGroup;
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

        <style>
            table{
                
                font-family: gisha;
                
            }
            button{
                color: white;
                background-color:#822040;
                border-color:#822040;
            }
            tr{
                padding:20px;
            }
            td{
                padding:20px;
                width:397px;
                height:43px;
            }
            th{
                text-align:right;
                
            }
            input[type=submit]{
                font-size:20px;
                font-weight:bold;
                width:250px;
                background-color:#822040;
                border-color:#822040;
                display:block;
                margin-top:40px;
                margin-right:50px;
                margin-bottom:30px;
                
            }
              input[type=submit]:hover{
                 background-color:#822040;
                border-color:#822040;
                color:white;
              }
              #divSupport, #divShelter, #divLine{
                  display:none;
              }
              .btn-info:hover, .btn-info:active, .btn-info:focus {
                  box-shadow: none !important;
                  background-color:#822040 !important;
                  border-color:#822040;
              }
                .modal-header .close{
                    margin-top:-2px;
                    font-size:xx-large;
                }
                .modal-body{
                    position:relative;
                    padding-right:35px !important;
                }
              
        </style>
        
    </head>
    <body>
        <div class="header">
            <div id="log">
                <i id="logIn"  class="fa" title="התחבר" >&#xf007;</i>
            </div>
            
            <div class="text-center">
                <a href="#"><img id="logo" src="logo.png"></a>
            </div>
            
            <div class="pointer">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="#">דף הבית</a></li>
                          <li><a href="#">אודות</a></li>
                          <li><a href="#">תחומי פעילות</a></li>
                          <li><a href="#">התנדבות</a></li>
                          <li><a href="#">צור קשר</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
        <main>
        
<?php



$type="submit";
$btnClass="btn btn-info btn-lg";
$btnValueSupport="רשימת קבוצות תמיכה";
$btnValueShelter="רשימת בתי מחסה";
$btnValueHotLine="רשימת קווים חמים";
$btnIdSupport="btnSupport";
$btnIdShelter="btnShelter";
$btnIdLine="btnLine";
$ClassName="table-responsive";
$Table="table";
$Container="container";
$idShelter="divShelter";
$idSupport="divSupport";
$idLines="divLine";
$btnViewDataShelter="dataShelter";
$btnViewDataSupport="dataSupport";
$name="name";

echo "<input type='$type' class='$btnClass' value='$btnValueSupport' id='$btnIdSupport'>";
echo "<div id='$idSupport'>";
echo "<div class='$Container'>";
echo "<div class='$ClassName'>";
echo "<table class='$Table' >
    <tr><th> שם קבוצת תמיכה </th><th> אחוז התאמה</th><th>פרטים נוספים</th></tr>";
while($gradeSupport = current($percentSupportCombine)){
    
    $addressKeyGroup = key ($percentSupportCombine);
    
    $resultGroups = "SELECT name FROM support_group WHERE address ='$addressKeyGroup'";
    $resGroup = $conn->query($resultGroups);
    
    
    if($resGroup->num_rows > 0){
    while($rowGroup = $resGroup->fetch_assoc()){
        echo "<tr><td>".$rowGroup["name"]."</td><td>".$gradeSupport."</td><td><button id='$rowGroup[$name]' class='$btnViewDataSupport'>מידע נוסף</button></td></tr>";
        
    }
}
     next($percentSupportCombine);

}
echo "</table>";
echo "</div>";
echo"</div>";
echo "</div>";


echo "<input type='$type' class='$btnClass' value='$btnValueShelter' id='$btnIdShelter' >";
echo "<div id='$idShelter'>";
echo "<div class='$Container'>";
echo "<div class='$ClassName'>";
echo "<table class='$Table' >
    <tr><th> שם בית מחסה </th><th> אחוז התאמה</th><th>פרטים נוספים</th></tr>";
while($gradeShelter = current($percentShelterCombine)){
    
    $addressKeyShelter = key ($percentShelterCombine);
    
    $resultShelter = "SELECT name FROM shelter WHERE address ='$addressKeyShelter'";
    $resShelter = $conn->query($resultShelter);
    
    
    if($resShelter->num_rows > 0){
    while($rowShelter = $resShelter->fetch_assoc()){
        echo "<tr><td>".$rowShelter["name"]."</td><td>".$gradeShelter."</td><td><button id='$rowShelter[$name]' class='$btnViewDataShelter'>מידע נוסף</button></td></tr>";
        
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
</body>
</html>
<?php
$conn->close();
?>
