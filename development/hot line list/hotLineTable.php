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
        <link rel="stylesheet" type="text/css" href="hotLineTable.css">
    </head>
    <body>
        <div class="header">
            <div id="log">
                <i id="logIn"  class="fa" title="התחבר" >&#xf007;</i>
            </div>
            
            <div class="text-center">
                <a href="#"><img id="logo" src="logo.png"></a>
            </div>
            
    <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                      הושט לי יד
                    </a>
                </li>
                <li>
                    <a href="#">דף הבית</a>
                </li>
                <li>
                    <a href="#">אודות</a>
                </li>
                <li>
                    <a href="#">תחומי פעילות</a>
                </li>
                <li>
                    <a href="#">התנדבות</a>
                </li>
                <li>
                    <a href="#">הצטרפות כגוף מטפל</a>
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
            
    
            
            <div class="pointer">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="#">התאמת גוף מטפל</a></li>
                          <li><a href="#">בתי מחסה</a></li>
                          <li><a href="#">קבוצות תמיכה</a></li>
                          <li><a href="#">קווים חמים</a></li>
                          <li><a href="#">צור קשר</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
        <hr>
        <main>
            <div class="container">
              <div class="row">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <a href="#" id="find_a_place">
                        <p>לחץ/י לקבלת סיוע בהתאמה אישית
                        </p>
                    </a>
                </div>
              </div>
            </div>
            <h2 id="activityTitle">רשימת קווים חמים </h2>

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

$hotLineSQL = "SELECT hot_line.name, risk_type.type as type, hot_line.phone, hot_line.mail, hot_line.website_url FROM hot_line JOIN risk_type ON hot_line.risk=risk_type.ID" ;
$hotLineRes=$conn->query($hotLineSQL);


$ClassName="table-responsive";
$Table="table";
$Container="container";
$HotLine="hotline";

echo "<div class='$Container' id='$HotLine'>";
echo "<div class='$ClassName'>";
echo "<table class='$Table' >
    <tr><th> שם קבוצת תמיכה </th><th>תחום סיכון</th><th>טלפון</th><th>מייל</th><th>אתר אינטרנט</th></tr>";

    if($hotLineRes->num_rows > 0){
    while($rowHotLine = $hotLineRes->fetch_assoc()){
        echo "<tr><td>".$rowHotLine["name"]."</td><td>".$rowHotLine["type"]."</td><td>".$rowHotLine["phone"]."</td><td>".$rowHotLine["mail"]."</td><td>".$rowHotLine["website_url"]."</td></tr>";  
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