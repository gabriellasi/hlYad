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

<!DOCTYPE html>
<html lang="en">
    <head>
    <title> הושט לי יד</title>
	<meta charset="utf-8">
	<link rel="icon" href="logo_icon.png">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Amatic SC" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="homePageStyle.css"> 
    <link rel="stylesheet" type="text/css" href="activities.css">
    
    <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-scope" content="profile email">
      <meta name="google-signin-client_id" content="230287754090-959u5p3brfb0l6tv1vd4gdl7hlmcr1t9.apps.googleusercontent.com">
    
    <script>
        var permission = <?php echo $permit?>;
    </script>
    </head>
    
    <body dir="rtl">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="header">
            <div id="log">
                 <a href="http://gabriellasi.mtacloud.co.il/registrationLogin/registraion_latest.php"><i id="logIn"  class="fa" title="התחבר" >&#xf007;</i></a>
            </div>
            
            <div class="text-center">
                <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php"><img id="logo" src="logo.png"></a>
            </div>
            
            <a href="http://gabriellasi.mtacloud.co.il/activities%20page/activities.php" onclick="signOut();" id="signOut" style="display:none;"> התנתק</a>
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
        <script>
        
        if (permission !=0){
                    $("#signOut").css("display", "block");
                }
        
            //admin
            if (permission == 1){
                $("#youthNav").css("display", "block");
                $("#careService").css("display", "block");
                $("#adminNav").css("display", "block");

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
                $("#youthNav").css("display", "block");
                $("#youthNav").css("display", "none");
            }
                
            
        </script>
        <main>
        <div class="container">
            <h2 id="activityTitle">תחומי פעילות</h2>        
            <h3><u>תמיכה נפשית</u></h3>
            <p>
            ילדים ובני נוער, החיים במצבים המסכנים אותם במשפחתם ובסביבתם, ואשר כתוצאה ממצבים אלה נפגעת יכולתם לממש את זכויותיהם בתחומים הבאים: <br>
            </p>
            <ul>
               <li>קיום פיזי והתפתחות</li> 
               <li>השתייכות למשפחה</li> 
               <li>למידה ורכישת מיומנויות</li> 
               <li>בטחון ורווחה רגשית</li> 
               <li> השתייכות חברתית</li>
               <li>הגנה מאחרים ומעצמו</li> 
            </ul>
    
            <p>
                בני נוער אלה לרב מנותקים ממערכות תמיכה משפחתיות, חברתיות וטיפוליות. מרביתם נאלצים להתמודד בעולם כשאין להם משאבים כלל, בשל מצבם הנפשי והפיזי וגילם הצעיר.<br>
                ארגון הושט לי יד מספק מענה לבני נוער, צעירים וצעירות הנמצאים במצב רגיש זה.<br> בבסיס העבודה עומדת השאיפה לספק מענה לכל נער או נערה הזקוקים לעזרה במטרה לסדוק ולו במעט את מעגל הניכור והניתוק שבו הם חיים.<br>
                על כן, ארגון הושט לי יד עובד מול גופים מקצועיים המוכשרים לספק טיפולים ראויים לכל נער או נערה שנקלעו למצב קשה בהתאם לתחום הטיפול שצריך.<br>
                אנו רוצים לאפשר לכל נער ונערה את הזכות הבסיסית לקיום פיזי הולם, לספק תחושת שייכות ובטחון, ואת הידיעה שאינם נמצאים לבד.<br> 
            </p>
    
            <h3><u>ייעוץ תעסוקתי</u></h3>
            <p>
                אחת המטרות של ארגון הושט לי יד הוא לקדם עצמאות כלכלית של נערים ונערות במצוקה.<br> 
                במידה והנער או הנערה מעוניינים בקבלת סיוע, הם עוברים הכשרה מקצועית ומקבלים כלים המאפשרים להם לרכוש מקצוע, להתפרנס ולהתפתח.<br>
                מיזם זה מהווה חלק חשוב בתהליך חברתי, העצמתם, הכנתם לעולם התעסוקה ושילובם בחברה.<br>
                
                מבחינת הגופים המקצועיים אשר עובדים בשיתוף עם הושט לי יד - הבחירה שלהם היא בחירה במקצועיות עם ערך חברתי!<br>
                הצטרפות להושט לי יד מאפשרת לפגוש את הנערים והנערות בעשייה, להוות עבורם מודל לחיקוי, לנפץ סטיגמות, לחוש תחושת סיפוק של נתינה, ולתרום באופן אישי להעצמתם האישית והכלכלית.<br>
        
            </p>
        
           
            <h3><u>ליווי אישי</u></h3>
            <p>
                להושט לי יד מערך מתנדבים רחב שיוכלו ללוות אתכם ויהיו לכם לידידים נאמנים.<br>
                אחריות רבה מוטלת על כתפם של המתנדבים המלווים.<br> לכן כל כך חשוב שהמלווים יכירו בקושי שעובד על הנער או הנערה, וישמשו אוזן קשרת, שידאגו לשלומו, וישדרו לו אכפתיות ודאגה.<br>
                כל המתנדבים של הושט לי יד עוברים ראיון מוקפד מול מנהלי הושט לי יד. הם מקבלים הדרכה כדי לדעת כיצד יש לפעול מול הנערים,<br> והלעשיר את כלי ההתמודדות שלהם על מנת להבין טוב יותר את המצב בו נמצאים הנערים והנערות.<br>
                חלק מהמתנדבים הינם נערים אשר עברו על בשרם קשיים והצליחו לשקם את עצמם, וכיום רוצים  לסייע לאחרים ולהראות להם שיש דרך אחרת ואפשר להתמודד עם כל קושי.<br>
            </p>
           
            <h3><u>הקו הפתוח</u></h3>
            <p>
              הושט לי יד הוקמה במטרה לספק לכל נער ונערה מענה הולם בכל שעה שירגיש צורך שזקוק לעזרה.<br>
                על כן, תוכלו לדבר בעילום שם עם מתנדבים על כל התהיות, השאלות והבעיות שמטרידות אתכם.<br>
                המתנדבים יקבלו אתכם בברכה! תוכלו לדבר בשמכם האמיתי או כאמור בעילום שם. <br>בנוסף תוכלו לבחור אם לנהל את השיחה בטלפון או במייל.<br><br>
                טלפון הקו הפתוח: 03-3657777 <br>
                כתובת מייל: hoshetly@gmail.com<br>
            </p>
        </div>
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
                            <br><b>hoshetly@gmail.com</b></p>
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