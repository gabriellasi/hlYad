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

$originCity = $_POST['city1'];

echo $originCity;
//echo $origin;
//echo $_POST['city'];

$urlContentsShelter = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($_POST['city1'])."&destinations=".urlencode($destinationsShelter)."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";

//*$urlContentsGroup = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".urlencode($_GET[''])."&destinations=".urlencode($rowGroup)."&key=AIzaSyAgnrRznulN8DCt5jeMMrQf75HwV0f6thM";*/



//free results
/*mysqli_free_result($rowShelter);
mysqli_free_result($rowGroup);*/


$data = file_get_contents($urlContentsShelter);
$distancesShelter = json_decode($data);
?>


<!DOCTYPE html>
<html lang="he" dir="rtl">
    <head>
        <title> הושט לי יד</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="logo2.ico">
        <link rel="stylesheet" type="text/css" href="system.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Amatic SC" rel="stylesheet">
    </head>

    <body>   
        <header>
            <div id="log">        
                <i id="logIn" class="fa" title="התחבר" >&#xf007;</i>
                <p id="song">
        "אִם תִּפְגֹּשׁ אָדָם שָׁבוּר
        שֵׁב אִתּוֹ
        עַל סַף הַשֶּׁבֶר הָאָרוּר
        אַל תְּנַסֶּה לְתַקֵּן
        אַל תִּרְצֶה שׁוּם דָּבָר
        בְּיִרְאָה וּבְאַהֲבַת הַזּוּלָת
        שֵׁב אִתּוֹ
         שֶׁלֹּא יִהְיֶה שָׁם לְבַד."
                </p> 
            </div>
        
            <div class="present"> 
                <a href="#"><img id="logo" src="Untitled.png"></a>
    
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
        </header>
    
       <main>
        <div id="frame">
            <h2 id="pageTitle">התאם לי גוף מטפל</h2>
            <div class="container form">
                <form action="system.php" dir="rtl" method="post">
                    <div class="form-group">
                       <p> <span class="required">*</span>הכנס/י עיר:</p>
                        <p id="city" name="city1" placeholder="שם ישוב"></p></div>
                        <div class="form-group">
                            <label for="street">הכנס/י רחוב:</label>
                            <input type="text" class="form-control" id="street" name="street" placeholder="הכנס/י רחוב" required>
                        </div>
                        <script>
                            
                            var cityValue = e.options[e.selectedIndex].value;
                        </script>
                        <div class="form-group">
                        <p class="required">*</p>
                        <label for="riskType">תחום סיכון: </label>
                        <select class="form-control" id="ristType" name="riskType" required>
                        <option value="" disabled selected>בחר/י תחום סיכון</option>
                        <option value="1" disab>פגיעה מינית</option>
                        <option value="2">התעללות במשפחה</option>
                        <option value="3">אלכוהוליזם</option>
                        <option value="4">בית סוהר</option>
                        <option value="5">סמים</option>
                        <option value="6">מקרה התאבדות במשפחה</option>
                        <option value="7">להט"ב</option>
                        <option value="8">חזרה בשאלה</option>
                        </select>
                        </div>
                        
                        <div class="form-group">
                        <p class="required">*</p>
                        <label for="age">הכנס/י גיל:</label>
                        <input type="text" class="form-control" id="age" name="age" min="12" max="30" placeholder="הכנס/י גילך" required>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn">Submit
                            </button>
                        </div>
                    
                    <?php
                    if($distancesShelter){
                        print_r($distancesShelter);
                    }
                    
                    ?>
                        </form>
                    </div>
            </div>
            </main>
        
                <footer dir="rtl">
            <div class="foo">
                <div id="in_foo">
                    <div id="face_gma">
                        <p> בקרו אותנו</p><br>
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-google"></a>
                    </div>
                    <p id="about"><b>הושט לי יד - עמותה לנוער במצבי סיכון</b>
                        <br><br>אבן גבירול 26, רמת גן, ת.ד 52217
                        <br><br>טל. 03-3657777 פקס. 03-2550319
                        <br><br><b>hoshetLiYad@gmail.com</b></p>
                </div>            
            </div>
        </footer>
        
        <script>
    // שפת התוסף, עברית - ברירת מחדל: he, אנגלית: en
    nl_lang = "he";
    // מיקום התוסף, שמאל למעלה - ברירת מחדל: tl, שמאל למטה: bl, ימין למעלה: tr, ימין למטה: br
    nl_pos = "br";
    // הצהרת הנגישות עבור התוסף, כתובת ישירה אל הצהרת הנגישות של האתר שלך
    nl_link = "0";
    // צבע התוסף המתאים ביותר לאתרך מתוך 10 צבעים לבחור מתוכם כרגע
    nl_color = "gray ";
    // האם התוסף יוצג כסרגל או כלחצן
    nl_compact = "1";
    // האם לפתוח תפריט אחד בכל פעם
    nl_accordion = "0";
        </script>
        <script type="text/javascript" charset="utf-8" src="http://gabriellasi.mtacloud.co.il/accessibility/nagishli.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
      </script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
      </script>
      <script> 
    $(document).ready(function(){
    $(".form-control").keydown(function(){
        $(this).css("background-color", "antiquewhite");
    });
    $(".form-control").keyup(function(){
        $(this).css("background-color", "antiquewhite");
    });
    $(".form-control").keyup(function(){
       if($(this).val() == '') 
    {
        $(this).css('background-color' , 'white');
        }
    });
      $(".form-control").keydown(function(event){ 
       if(($(this).val() == '') &&(event.which==9))
    {
        $(this).css('background-color' , 'white');
        }
});  
        $("select").keydown(function(event){ 
       if(($("option").val() == '') &&(event.which==9))
    {
        $(this).css('background-color' , 'white');
        }
            });
         $("select").keydown(function(){
        $("option").css("background-color", "antiquewhite");
    });
    $("select").keyup(function(){
        $("option").css("background-color", "antiquewhite");
    });
     $("select").keyup(function(){
       if($("option").val() == '') 
    {
        $(this).css('background-color' , 'white');
        }
    });
        
        
});
        </script>

        <script>
        var x, txt="";
        var requestURL = 'http://gabriellasi.mtacloud.co.il/system/cities.json';
         var request = new XMLHttpRequest();
        request.open('POST', requestURL);
        request.responseType = 'text';
        request.send();
        request.onload=function (){
            var citiesText=request.response;
            var cities=JSON.parse(citiesText);
            txt+="<select>"
            txt+="<option disabled selected>בחר/י ישוב"
            for(x in cities){
                txt+="<option>"+cities[x].name;
            }
            txt+="</select>"
            document.getElementById("city1").innerHTML=txt;
        };
        </script>

    </body>
</html>