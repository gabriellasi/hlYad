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
    <link rel="stylesheet" type="text/css" href="homePageStyle.css">
    <link rel="stylesheet" type="text/css" href="riskTypeContent.css"> 
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Amatic SC" rel="stylesheet">
    
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
                <a id="logToSystem" href="http://gabriellasi.mtacloud.co.il/registrationLogin/registraion_latest.php"><i id="logIn"  class="fa" title="התחבר" >&#xf007;</i></a>
            </div>
            
            <div class="text-center">
                <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php"><img id="logo" src="logo.png"></a>
            </div>
            
            <a href="http://gabriellasi.mtacloud.co.il/riskTypes/riskTypeContent.php" onclick="signOut();" id="signOut" style="display:none;"> התנתק</a>
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
<script>
                //admin
                if (permission !=0){
                    $("#signOut").css("display", "block");
                }
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
        <hr>
        <main>
            <div class="container">
        <h2 id="activityTitle">תחומי סיכון</h2>        
       <div class="paragraph">
        <h3 id="LGBT"><u>להט"ב</u></h3>
        <p> 
        נערים ונערות רבים אשר בחרו ללכת אחרי הלב ולצאת לשינוי, נאבקים מדי יום על שווין זכויות והכרה.<br>
         ישנם לא מעט בני נוער אשר נותרים ללא מסגרת תומכת, סיוע וליווי בדרכם החדשה.<br>
            בני נוער אלו אינם מבקשים דבר מעבר למענה על הצורך הבסיסי ביותר - קבלת יחס שווה, הרי כולנו אותו הדבר.<br>
        "הושט לי יד" כאן כדי לסייע ולספק תמיכה עבור כל אותם בני נוער שנאלצים להתמודד עם קשיי היום - יום לבדם.<br>
            גופי טיפול רבים בוחרים לשתף פעולה עם "הושט לי יד" ולסייע לבני הנוער במאבק ובהתמודדות, ובניהם:
            </p>
            <ul>
            <li>האגודה למען הלהט"ב</li>
            <li>איגי - ארגון נוער גאה</li>
            <li>המרכז הגאה</li>
            </ul>
            <p>
            <b>אל תשאר/י לבד - אפשר/י לנו למצוא לך מסגרת מותאמת, תומכת וחמה.</b>
            </p></div>
            
       <div class="paragraph">
        <h3 id="Religious"><u>יוצאים בשאלה</u></h3>
        <p>
       בני נוער רבים אשר גדלו והתחנכו במסגרת דתית, מוצאים עצמם מבולבלים ומחפשים את דרכם החדשה בעולם החילוני.<br>
            פעמים רבות, משפחותיהם אינן מוכנות לקבל את השינוי באמונות ובדרך החיים של ילדיהם ואף מנדות אותם מהמשפחה.<br>
        במצבים אלו, הנער/ה מוצאים עצמם לבד וללא כל תמיכה והכוונה אישית ומקצועית,
        דבר אשר הופך את הסיטואציה לקשה אף יותר עבורם.<br>
            "הושט לי יד" נועדה לסייע לכל אותם בני נוער שסביבתם הטבעית אינה מקבלת אותם בשל השינוי והדרך החדשה שבחרו לצאת אליה.<br>
            באמצעות התאמה ייחודית ואישית, "הושט לי יד" מספקת התאמה ייחודית ואישית של גוף מטפל ותומך בהתאם לצרכיו של הנער/ה.<br>
            גופי טיפול רבים לוקחים חלק ומשתפים פעולה עם "הושט לי יד" במטרה לסייע לכל נער/ה אשר זקוק/ה לתמיכה והכוונה, ובניהם:<br>
            </p><ul>
            <li>ה.ל.ל האגודה ליוצאים בשאלה</li>
            <li>עמותת דרור</li>
            <li>יוצאים לשינוי</li>
            </ul>
            <p>
            <b>אל תשאר/י לבד - אפשר/י לנו למצוא לך מסגרת מותאמת, תומכת וחמה.</b>
            </p></div>
       
         <div class="paragraph">
        <h3 id="sexualAbuse"><u>נפגעי תקיפה מינית</u></h3>
        <p>
            נערים ונערות רבים נקלעים לסיטואציה בה בניגוד לרצונם נכפתה עליהם התנהגות/מעשה מיני על - ידי אדם זר/מכר.<br>
            פעמים רבות, בני נוער אלו בוחרים לא לשתף את הסביבה שלהם במקרה ואף מדחיקים אותו.<br>
            לעיתים, כאשר בני הנוער כן בוחרים לשתף הסביבה בוחרת לא להאמין ולהתעלם וכך  הנער/ה מוצאים עצמם לבד בהתמודדות והמאבק המתמשך.<br>
            חשוב לנו לציין כי תקיפה מינית אינה רק מעשה פיזי - אלא כל פעולה, אמירה והתנהגות בהקשר מיני שנעשה ללא הסכמה של שני הצדדים.<br>
            "הושט לי יד" כאן בכדי לסייע לכל אותם בני הנוער שנאלצו להתמודד עם סיטואציות כאלו בעל כורחם, ולהתאים להם גוף מטפל שילווה אותם בכל צעד בהתמודדות.<br>
            גופים מטפלים רבים בוחרים לסייע לבני הנוער ולשתף פעולה עם "הושט לי יד" במטרה לספק מסגרת תומכת, ובניהם:
        </p>
            <ul>
            <li>עמותת עלם</li>
            <li>עמותת יחדיו - ענב"ל</li>
            <li>קול הילד</li>
            </ul>
        <p>
        <b>אל תשאר/י לבד - אפשר/י לנו למצוא לך מסגרת מותאמת, תומכת וחמה.</b>
        </p></div>
         
         
      
        <h3 id="youthAtRisk"><u>נוער בסיכון</u></h3>
        <p>
        .בני נוער רבים מוצאים עצמם במצבים המסכנים אותם בקרב משפחותיהם וסביבתם<br>
           הסיבות להיקלעות למצבים אלו רבות - קשיים כלכליים, משברים במשפחה, קשיי הסתגלות בחברה, מוגבלויות, התמכרויות ועוד.<br>
            בני נוער אלו פעמים רבות נותרים ללא מסגרת וסביבה תומכת שתסייע להם בהתמודדות עם הקשיים, דבר אשר לעיתים גורם להרעה במצבם.<br>
            "הושט לי יד" מסייעת בסיפוק תמיכה והכוונה לכל אותם בני נוער באמצעות התאמה ייחודית ואישית של גוף מטפל.<br>
            גופים מטפלים רבים משתפים פעולה עם "הושט לי יד" ומבקשים להוות מסגרת לבני הנוער, ובניהם:           
        </p>
        <ul>
        <li>עלם - עמותה לנוער במצבי סיכון</li>
        <li>עמותת גשר אל הנוער</li>
        <li>עמותת בית השנטי</li>
        </ul>
        <p>
        <b>אל תשאר/י לבד - אפשר/י לנו למצוא לך מסגרת מותאמת, תומכת וחמה.</b>
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