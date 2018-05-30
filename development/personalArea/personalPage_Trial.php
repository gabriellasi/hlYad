<?php
session_start();

if (isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    $permit = $_SESSION["permit"];
    $emailId = $_SESSION["emailId"];
}
else{
    $user = "";
    $permit = 0;
}

//echo $emailId. "<br>";
//echo $user. "<br>";
//echo $permit. "<br>";

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

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
    <head>
        <title>הושט לי יד</title>
        <meta charset="utf-8">
        <link rel="icon" href="logo_icon.png">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
        </script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
      </script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Amatic SC" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="homePageStyle.css">
        <link rel="stylesheet" type="text/css" href="personalPage.css">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-scope" content="profile email">
      <meta name="google-signin-client_id" content="230287754090-959u5p3brfb0l6tv1vd4gdl7hlmcr1t9.apps.googleusercontent.com">
        <script>
            var permission = <?php echo $permit;?>;
        </script>
        <script>
        $(document).ready(function() {
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
        });
                
        </script>

    </head>
    
        <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="header">
            <div id="log">
                <a id="logToSystem" href="http://gabriellasi.mtacloud.co.il/registrationLogin/registraion_latest.php"><i id="logIn"  class="fa" title="התחבר" >&#xf007;</i></a>
            </div>
            
            <div class="text-center">
                <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php"><img id="logo" src="logo.png"></a>
            </div>
            
            <a href="http://gabriellasi.mtacloud.co.il/PersonalErea/personalPage_Trial.php" onclick="signOut();" id="signOut" style="display:none;"> התנתק</a>
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
                    //window.location.reload();
                    //refreshPage();
                }
            </script>
            
            <div id="wrapper">
                <div class="overlay"></div>
                <!-- Sidebar -->
                <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                    <ul class="nav sidebar-nav">
                        <li class="sidebar-brand">
                            <a name="hlyTitle" style="font-family: 'Times New Roman'">הושט לי יד</a>
                        </li>
                        <hr>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php" style="font-family: 'Times New Roman'">דף הבית</a>
                        </li>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/about%20-%20try/about.php" style="font-family: 'Times New Roman'">אודות</a>
                        </li>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/activities%20page/activities.php" style="font-family: 'Times New Roman'">תחומי פעילות</a>
                        </li>
                        <li>
                            <a href="http://gabriellasi.mtacloud.co.il/joinUs/joinus.php" style="font-family: 'Times New Roman'">הצטרפות כגוף מטפל</a>
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
            
            <div class="pointer" id="careService" style="display:none;">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="http://gabriellasi.mtacloud.co.il/newshelter/shelter.php">הוסף בית מחסה</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/new%20support%20group/supportGroup.php">הוסף קבוצת תמיכה</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/newLine/hotline.php">הוסף קו חם</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/contact%20us/contactPage.php">יצירת קשר</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="pointer" id="adminNav" style="display:none;">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="http://gabriellasi.mtacloud.co.il/newCategory/category.php">הוספת קטגוריה</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="pointer" id="volunteerNav" style="display:none;">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="http://gabriellasi.mtacloud.co.il/new%20volunteer/volunteer.php">הצטרף כמתנדב/ת</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/contact%20us/contactPage.php">יצירת קשר</a></li>
                        </ul>
                    </nav>
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

        
                
        <hr>
        <main>
            <div class="container">
                <h2 id="pageTitle">איזור אישי</h2>
            <?php
            
            $serviceTextBox="classService";
            $Container="container";        
            $ClassName="table-responsive";
            $Table="table";
            
            
             $getEmail = "SELECT DISTINCT email FROM googleUsers WHERE email_ID='$emailId'";
             $resGetEmail=$conn->query($getEmail);
    
             if($resGetEmail->num_rows > 0){
                 while($row=$resGetEmail->fetch_assoc()){
                 $email=$row['email']  ; 
                $getYouthChoice= "SELECT service, message FROM youth_shelter WHERE email_id='$email'";
                
                $resGetYouthChoice=$conn->query($getYouthChoice);
                //echo "<div class='$Container'>";
                echo "<div class='$ClassName'>";
                echo "<table class='$Table' >
                <tr><th> שם גוף מטפל  </th><th> הודעה </th></tr>";
                
                if($resGetYouthChoice->num_rows > 0){
                while($rowChoice = $resGetYouthChoice->fetch_assoc())
                  {  
                        $service=$rowChoice["service"];
                        echo"<tr><td>".$rowChoice["service"]."</td><td><textarea name='$service' class='$serviceTextBox' >".$rowChoice["message"]."</textarea></td></tr>";
                  } 
                  

                 }
                 else{
                     $idHistoryMessage ="noHistoryMessage";
                     echo "<p id='$idHistoryMessage'>לא קיימת היסטוריה</p>";
                 }
                echo "</table>";
                echo "</div>";
                //echo"</div>";
                
                $idButton="submitMessages";
                $typeButton="submit";
                $classButton="btn btn-info btn-lg";
                $value="שמירת שינויים";
                $loadModal="loadModal()";
                echo "<input type='$typeButton' id='$idButton' class='$classButton' value='$value' onsubmit='$loadModal'>";
                 
             }
             }
            else{
                $idEcho = "messageNotConected";
                     echo "<p id='$idEcho'>אתה לא מחובר לחשבון</p>";
                 }
                 

    
        $conn->close();  
        ?>
        
                         
            </div>

             <div id="dataModal" class="modal fade">  
              <div class="modal-dialog">  
                   <div class="modal-content">  
                        <div class="modal-header">  
                             <button type="button" class="close" data-dismiss="modal">&times;</button>  
                             <h4 class="modal-title">תודה שבחרת לשתף אותנו</h4> 
                        </div>  
                        <div class="modal-body" id="moreDetails">  
                        </div>  
                        <div class="modal-footer">  
                             <button type="button" class="btn btn-default" data-dismiss="modal">סגירה</button>  
                        </div>  
                   </div>  
              </div>  
         </div>
<script>  
<?php
$servername = "localhost:3306";
$username = "gabriellasi";
$password = "]Tf07@MEeG4e";
$dbname = "gabriell_youth_at_risk";

// Create connection
$secConn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($secConn->connect_error) {
     die("Connection failed: " . $secConn->connect_error);
} 

mysqli_set_charset($secConn,"utf8");
?>
   $(function() {
      //$('#submitMessages').click(function(){
        $("#submitMessages").on("click", function(){
            var emailId = "<?php echo $emailId?>";
            <?php
            $getEmailFirst = "SELECT DISTINCT email FROM googleUsers WHERE email_ID='$emailId'";
            $resEmail=$secConn->query($getEmailFirst);
            if($resEmail->num_rows > 0){
                 while($rowEmail=$resEmail->fetch_assoc()){
                 $email=$rowEmail['email']  ; 
                 }
            }
            ?>
            var emailUser = "<?php echo $email?>";
            var myMessages = new Array();
            
            $("textarea").each(function() {
                var message = $(this).val();
                var serviceName = $(this).attr("name");
           
                $.ajax({
                    type: 'POST',
                    url: 'updateUserMessage.php',   
                    data:
                    { 
                    message : message,
                    email : emailUser,
                    service : serviceName
                    },  
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
      });  

 </script>


        

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
            function refreshPage(){
                window.location.reload();
                location.href='#';
            }
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