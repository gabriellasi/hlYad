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
 if(isset($_POST["placeNameSupport"]))  
 {  
      


    $nameSupport=$_POST["placeNameSupport"];

    $querySupport = "SELECT * FROM support_group WHERE name ='$nameSupport'";  
      $resultSupport = $conn->query($querySupport);
      
      
    $ClassName="table-responsive";
    $Table="table";
    $Container="container";
    echo "<div class='$ClassName'>";
    echo "<table class='$Table' >
        <tr><th>שם</th><th>טלפון</th><th>כתובת</th><th>גילאים</th><th>מייל</th><th>אתר אינטרנט</th></tr>";

  
      if($resultSupport->num_rows > 0){
    while($rowSupport = $resultSupport->fetch_assoc())
      {  
            echo"<tr><td>".$rowSupport["name"]."</td><td>".$rowSupport["phone"]."</td><td>".$rowSupport["address"]."</td><td>".$rowSupport["min_age"].'-'.$rowSupport["max_age"]."</td><td>".$rowSupport["mail"]."</td><td>".$rowSupport["website_url"]."</td></tr>";
      }  
      }
 echo "</table>";
echo "</div>";
echo"</div>";



 }
  if(isset($_POST["placeNameShelter"]))  
 {  
     
    $nameShelter=$_POST["placeNameShelter"];

        $queryShelter = "SELECT * FROM shelter WHERE name ='$nameShelter'";  
      $resultShelter = $conn->query($queryShelter);
      
      
    $ClassName="table-responsive";
    $Table="table";
    $Container="container";
    echo "<div class='$ClassName'>";
    echo "<table class='$Table' >
        <tr><th>שם</th><th>טלפון</th><th>כתובת</th><th>גילאים</th><th>מייל</th><th>אתר אינטרנט</th></tr>";

  
      if($resultShelter->num_rows > 0){
    while($rowShelter = $resultShelter->fetch_assoc())
      {  
            echo"<tr><td>".$rowShelter["name"]."</td><td>".$rowShelter["phone"]."</td><td>".$rowShelter["address"]."</td><td>".$rowShelter["min_age"].'-'.$rowShelter["max_age"]."</td><td>".$rowShelter["mail"]."</td><td>".$rowShelter["website_url"]."</td></tr>";
      }  
      }
 echo "</table>";
echo "</div>";
echo"</div>";



 }
 
 ?>
