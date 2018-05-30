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
<html lang="he">
    <head>
	<meta charset="utf-8">
	<title>הושט לי יד</title>
	<link rel="icon" href="logo_icon.png">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Amatic SC" rel="stylesheet">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="contact.css"> 
        <link rel="stylesheet" type="text/css" href="homePageStyle.css">
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
                <div class="container form">
                <h2 id="pageTitle">
                    צור קשר
                </h2>
                <form action="contact.php" dir="rtl" method="post" id="contact">
                    
                    <div class="form-group">
                        <p class="required">
                            *
                        </p>
                        <label for="first_name">
                            שם פרטי: 
                        </label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="שם פרטי" required pattern="(?=.*[\u0590-\u05FF]).{2,}" title="אנא הכנס/י שם פרטי המכיל לפחות 2 תווים"
                        oninvalid="this.setCustomValidity('אנא הכנס/י שם פרטי המכיל לפחות 2 תווים')"
                     onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                    if(this.checkValidity()) form.firat_name.pattern = this.value;"
                        />
                    </div>
                    
                    <div class="form-group">
                        <p class="required">
                            *
                        </p>
                        <label for="last_name">
                           שם משפחה:
                        </label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="שם משפחה" required pattern="(?=.*[\u0590-\u05FF]).{2,}" title="אנא הכנס/י שם משפחה המכיל לפחות 2 תווים"          
                        oninvalid="this.setCustomValidity('אנא הכנס/י שם משפחה המכיל לפחות 2 תווים')"
                        onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"
                       />
                    </div>

                     <div class="form-group">
                        <p class="required">
                            *
                        </p>
                        <label for="email">
                            כתובת מייל:
                        </label>
                        <input type="email" class="form-control" name="email"
                        id="email" placeholder="כתובת מייל"
                        title="אנא הכנס/י כתובת מייל באנגלית המכילה @"
                        required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                        oninvalid="this.setCustomValidity('אנא הכנס/י כתובת מייל באנגלית המכילה @')"
                        onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"
                        />
                    </div>
                    <div class="form-group">
                        <p class="required">
                            *
                        </p>
                        <label for="massage">
                            הודעה:
                        </label>
                        <textarea class="form-control" name="comments" 
                        id="comments" maxlength="6000" minlength="10" rows="7" 
                        required pattern="(?=.*[\u0590-\u05FF]).{10,}" 
                        title="יש למלא שדה זה" oninvalid="this.setCustomValidity('אנא הכנס/י הודעה בעברית המכילה לפחות 10 תווים')"></textarea>
                    </div>

                    <input type="submit" class="btn btn-info btn-lg" value="שלח" onsubmit="loadModal()"  >
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="massege">
                                        ההודעה נשלחה בהצלחה! אנו ניצור איתך קשר בהקדם
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="homePage()">
                                        חזור לדף הבית
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetForm()">
                                        שלח הודעה נוספת
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
      </script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
      </script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    
    <script>
        $('#comments').keyup(validateTextarea);
        function validateTextarea() {
            var errorMsg = "אנא הכנס/י הודעה בעברית המכילה לפחות 10 תווים";
            var textarea = this;
            var pattern = new RegExp('^' + $(textarea).attr('pattern') + '$');
            // check each line of text
            $.each($(this).val().split("\n"), function () {
                // check if the line matches the pattern
                var hasError = !this.match(pattern);
                if (typeof textarea.setCustomValidity === 'function') {
                    textarea.setCustomValidity(hasError ? errorMsg : '');
                } else {
                    // Not supported by the browser, fallback to manual error display...
                    $(textarea).toggleClass('error', !!hasError);
                    $(textarea).toggleClass('ok', !hasError);
                    if (hasError) {
                        $(textarea).attr('title', errorMsg);
                    } else {
                        $(textarea).removeAttr('title');
                    }
                }
                return !hasError;
            });
        }
        </script>
        
        <script>

        $('#contact').ajaxForm(function() { 
              //$('#myModal').modal('show');
              $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });

            });; 
        </script>
        
        <script>
            function resetForm(){
             document.getElementById("contact").reset();
            }
        </script>
        
        <script>
            function homePage(){
                location.href='http://gabriellasi.mtacloud.co.il/home%20page/homePage.php';
            }
        </script>
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