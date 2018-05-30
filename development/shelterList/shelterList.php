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
                max-width:500px;
            }
            button{
                color: white;
                background-color:#822040;
                border-color:#822040;
            }
            tr{
                padding:10px;
            }
            td{
                margin-top:20px;
                margin-bottom:20px;
                margin-right:30px;
                margin-left:30px;
                width:397px;
                height:43px;
            }
            th{
                text-align:right;
                margin-right:25px;
                
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
              #pageTitle{
                padding-bottom: 5px;
                padding-top:5px;
                color:white;
                -webkit-text-stroke-width: 1.5px;
               -webkit-text-stroke-color:#822040;
                font-size:38px;
                font-family: 'Amatic SC', cursive;
                margin-bottom:30px;
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

$shelterSQL = "SELECT shelter.name, risk_type.type as type, shelter.phone, shelter.address, shelter.mail, shelter.website_url FROM shelter JOIN risk_type ON shelter.risk=risk_type.ID" ;
$shelterpRes=$conn->query($shelterSQL);


$ClassName="table-responsive";
$Table="table";
$Container="container";
$Title="pageTitle";


echo "<div class='$Container'>";
echo "<h2 id='$Title'>רשימת בתי מחסה</h2>";
echo "<div class='$ClassName'>";
echo "<table class='$Table' >
    <tr><th> שם בית המחסה </th><th>תחום סיכון</th><th>טלפון</th><th>כתובת</th><th>מייל</th><th>אתר אינטרנט</th></tr>";

    if($shelterpRes->num_rows > 0){
    while($rowShelter = $shelterpRes->fetch_assoc()){
        echo "<tr><td>".$rowShelter["name"]."</td><td>".$rowShelter["type"]."</td><td>".$rowShelter["phone"]."</td><td>".$rowShelter["address"]."</td><td>".$rowShelter["mail"]."</td><td>".$rowShelter["website_url"]."</td></tr>";  
    }
}

echo "</table>";
echo "</div>";
echo "</div>";
?>
</main>
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