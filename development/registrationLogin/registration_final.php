<?php session_start();
if (isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    $permit = $_SESSION["permit"];
    $emailId = $_SESSION["emailId"];
}
else{
    $user = "";
    $permit = 0;
    //$emailId ="BAR";
}

echo $permit. "<br>";
echo $emailId. "<br>";
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
      <title>הושט לי יד</title>
      <meta charset="utf-8">
      <link rel="icon" type="image/png" href="http://gabriellasi.mtacloud.co.il/registrationLogin/logo_icon.png">
      <link rel="stylesheet" type="text/css" href="homePageStyle.css"> 
      <link rel="stylesheet" href="registrationLogin.css">
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css?family=Amatic SC" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
      <meta name="google-signin-scope" content="profile email">
      <meta name="google-signin-client_id" content="230287754090-959u5p3brfb0l6tv1vd4gdl7hlmcr1t9.apps.googleusercontent.com">
      <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
      </script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
      </script>
                  
      <script>
      var permission = <?php echo $permit?>;
      var emailId = <?php echo $emailId?>;
      var signedIn = false;
      </script>

  </head>
    
    <body>
         <script>
            function onFailure(error) {
                console.log(error);
            }
            
            function onSignIn(googleUser) {
            // Useful data for your client-side scripts:
            console.log('Logged in as:');
            var profile = googleUser.getBasicProfile();
            /*console.log("ID: " + profile.getId()); // Don't send this directly to your server!
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());
    */
            // The ID token you need to pass to your backend:
            var id_token = googleUser.getAuthResponse().id_token;
                var full_name = profile.getName();
                var family_name= profile.getFamilyName();
                var first_name= profile.getGivenName();
                var email_add = profile.getEmail();
                var email_ID = profile.getId();
                
            console.log("ID Token: " + id_token);
                var user_permit = document.getElementById('permission');
                var chosen_permit = user_permit.options[user_permit.selectedIndex].value;
                
                updateToken(id_token, full_name, family_name, first_name, email_add, email_ID,chosen_permit);
                
                if(chosen_permit!=0){
                    loation.reload();
                }
                
            };
            
            function updateToken(tokenid, fullName, familyName, firstName, emailAdd, emailId,chosen_permit){
                $.post("authenticate_latest.php",{
                    id_token: tokenid , full_name: fullName, family_name: familyName, first_name: firstName, email_add: emailAdd, email_id: emailId,
                    permit: chosen_permit
                },function(data,status){
                //alert("Successfuly added token");
                //refreshPage();

                permission = chosen_permit;
                signedIn = true;
                //alert(data);
                //alert(chosen_permit);
               // alert("chosen"+'2'==chosen_permit);
               // alert("data"+ 2==data);
               //alert (typeof(chosen_permit));
               //var compare=data.localeCompare(chosen_permit);

                //if(data.equals(chosen_permit)==true)){
                  // alert("הכניסה בוצעה בהצלחה!");
               // }
               // else{
                // alert("ההרשאה איתה ניסית להיכנס אינה תואמת להרשאה איתה נרשמת במידה וברצונך לשנות את ההרשאה, יש ליצור קשר עם 'הושט לי יד'. לידיעתך התפריט התעדכן בהתאם להרשאה הקיימת לך במערכת."); 
                //}
                updateNavBar(data);
                }
                );
            };
            
            function updateNavBar(user_perm){
                permission=user_perm;
               // alert(permission);
                if (permission !=0){
                    $("#signOut").css("display", "block");
                }
                //admin
                if (permission == 1){
                    $("#adminNav").css("display", "block");
                    $("#careService").css("display", "block");
                    $("#volunteerNav").css("display", "block");
                    $("#youthNav").css("display", "none");
                }
                //youth
                if (permission == 2){
                    $("#youthNav").css("display", "block");
                    $("#personalAreaLink").css("display", "block");
                     $(".login").css("display","block");
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
            }
        </script>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="header">
            <div id="log">
                <a id="logToSystem" href="http://gabriellasi.mtacloud.co.il/registrationLogin/registration_final.php"><i id="logIn"  class="fa" title="התחבר" >&#xf007;</i></a>
            </div>
            
            <div class="text-center">
                <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php"><img id="logo" src="logo.png"></a>
            </div>
            
            <a href="http://gabriellasi.mtacloud.co.il/home%20page/homePage.php" id="signOut" onclick="signOut();" style="display:none;" >התנתק</a>

        <script>
        
            function signOut() {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut().then(function () {
                    console.log('User signed out.');
                    updateNavBar(0);
                });
                <?php
                session_unset($_SESSION["user"]);
                session_unset($_SESSION["permit"]);
                session_unset($_SESSION["emailId"]);
                session_destroy();
                $_SESSION=[];

                //session_destroy();
                
                ?>
                
                //window.location.reload();
                location.reload();
                location.reload();
               // refreshPage();
               // refreshPage();
               // refreshPage();
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
            
            <div class="pointer" id="adminNav" style="display:none;">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="http://gabriellasi.mtacloud.co.il/newshelter/shelter.php">הוסף בית מחסה</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/new%20support%20group/supportGroup.php">הוסף קבוצת תמיכה</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/newLine/hotline.php">הוסף קו חם</a></li>
                          <li><a href="http://gabriellasi.mtacloud.co.il/newCategory/category.php">הוסף קטגוריה</a></li>
                        </ul>
                    </nav>
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
                          <li><a href="http://gabriellasi.mtacloud.co.il/PersonalErea/person_final.php" id="personalAreaLink" target="_blank" style="display:none;">איזור אישי</a></li>
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
                if (permission !=0){
                    $("#signOut").css("display", "block");
                }
                //admin
                if (permission == 1){
                    $("#adminNav").css("display", "block");
                    $("#careService").css("display", "block");
                    $("#volunteerNav").css("display", "block");
                    $("#youthNav").css("display", "none");
                }
                
                //youth
                if (permission == 2){
                    $("#youthNav").css("display", "block");
                    $("#personalAreaLink").css("display", "block");
                    $(".login").css("display","block");
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
                <div class="row">
                    
                    <div class="col-sm-6 login" style="display:none;">
                        
                        <form id="registrationForm" action="deeper_latest.php" method="post" onsubmit="getCity()">
                            <h2 id="pageTitle">רוצה להשאיר אצלנו עוד פרטים?</h2>
                            <p class="text-right">מערכת <b>הושט לי יד</b> מאפשרת רישום  פרטים נוספים לגבייך 
                        [כגון: גיל, איזור מגורים, טלפון]<br>
                        <span style="color:red;font-weight: bold;">*שלב זה אינו חובה בשלב הכניסה למערכת  </span>
                        </p>
                        <div class="form-group">
                                <label for="phoneNum">מספר טלפון</label>
                                <input type="tel" class="form-control" id="phone" name="phoneNum" placeholder="הכנס/י  מספר טלפון " required pattern="^[0-9]{9,11}$" title="אנא הכנס/י מספר טלפון המכיל 9-11 ספרות"
                        oninvalid="setCustomValidity(' אנא הכנס/י מספר טלפון המכיל 9-11 ספרות ')"
                       />
                            </div>
                            <div class="form-group">
                                <label for="city">שם ישוב:</label>
                                <p id="city" name="city1" placeholder="שם ישוב" required></p>                            </div>
                            <div class="form-group">
                                <label for="age">גיל:
                                </label>
                                <input class="form-control" type="number" name="age" id="age" placeholder="גיל" value="" required oninvalid="setCustomValidity('אנא הכנס/י גיל בין 8 ל-30')" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" min="8" max="30">
                                <input type="text" id="cityChange" name="cityName" value="" style="display: none;">
                                <input type="text" id="token" name="token" value="" style="display: none;"/>
                            </div>
                            <div class="form-group">
                                <label for="gender">זהות מינית: 
                                </label>
                                <select name="gender" id="gender" required oninvalid="setCustomValidity('אנא בחר אפשרות מהרשימה')" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
                                    <option value="" disabled selected>בחר מתוך הרשימה</option>
                                    <option>נקבה</option>
                                    <option>זכר</option>
                                    <option>אחר</option>
                                </select>
                                
                            </div>
                            <input type="submit" class="btn btn-info btn-lg" value="הצטרף" onsubmit="loadModal()"  >
                                                <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <div class="modal-body" id="data">
                                   
                                </div>
                                <div class="modal-footer">
                               <button id="firstKey" type="button" class="btn btn-default" data-dismiss="modal" onclick="homePage()">
                                        חזרה לדף הבית
                                    </button>
                                    <button id="secKey" type="button" class="btn btn-default" data-dismiss="modal" onclick="personalErea()">
                                        מעבר לאיזור האישי
                                    </button>
                                    <button id="thirdKey" type="button" class="btn btn-default" data-dismiss="modal" onclick="resetForm()" style="display:none;">
                                        סגור
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                        </form>

                    </div>
                    
                    <div class="col-sm-6 registration" style="float:right;">
                        
                        <form class="form-row">
                            <h2 id="pageTitle">כניסה עם חשבון Gmail</h2>
                            <p class="text-right">בעת הכניסה, מערכת <b>הושט לי יד</b> תשמור את כתובת המייל והשם המלא המקושר לכתובת.</p><br><br>
                            
                            <select id="permission" required>
                                <option disabled="" selected="" value="">בחר את סוג המשתמש</option>
                                <option value="1">אדמין</option>
                                <option value="2">נוער</option>
                                <option value="5">מתנדב ממערך "הושט לי יד"</option>
                                <option value="4">קבוצת תמיכה</option>
                                <option value="3">בית מחסה</option>
                            </select>
                            <br><br>
                            <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" data-onfailure="onFailure"></div>
                           
                        </form>
                    </div>
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
                <script>
            document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("select");
           elements[0].oninvalid= function(e){
                e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("אנא בחר/י שם ישוב");
                    }
           };
          elements[0].oninput = function(e) {
             e.target.setCustomValidity("");
                }
            });
           
        </script>
                  <script>
        $('#phone').keyup(validatePhone);
        function validatePhone() {
            var errorMsg = "אנא הכנס/י מספר טלפון המכיל 9-11 ספרות";
            var phone = this;
            var pattern = new RegExp('^' + $(phone).attr('pattern') + '$');
            // check each line of text
            $.each($(this).val().split("\n"), function () {
                // check if the line matches the pattern
                var hasError = !this.match(pattern);
                if (typeof phone.setCustomValidity === 'function') {
                    phone.setCustomValidity(hasError ? errorMsg : '');
                } else {
                    // Not supported by the browser, fallback to manual error display...
                    $(phone).toggleClass('error', !!hasError);
                    $(phone).toggleClass('ok', !hasError);
                    if (hasError) {
                        $(phone).attr('title', errorMsg);
                    } else {
                        $(phone).removeAttr('title');
                    }
                }
                return !hasError;
            });
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
            txt+="<select required>"
            txt+="<option disabled selected value>בחר/י ישוב"
            for(x in cities){
                txt+="<option>"+cities[x].name;
            }
            txt+="</select>"
            document.getElementById("city").innerHTML=txt;
        };
        </script>

        <script>
            function getCity(){
            var obj = document.getElementsByTagName('select');
            console.log(obj);
            console.log(obj[0]);
            var select = obj[0];
            //this should have an event handler for a click on submit!!!! 
            var cityName = select.options[select.selectedIndex].text;
            document.getElementById("cityChange").setAttribute("value",cityName);
            };
   
        </script>
        <script>
            function refreshPage(){
                window.location.reload();
                location.href='http://gabriellasi.mtacloud.co.il/registrationLogin/registration_final.php';
            }
        </script>
        <script>
                function homePage(){
                window.location.reload();
                location.href='http://gabriellasi.mtacloud.co.il/home%20page/homePage.php';
            }
        </script>
            <script>
            function resetForm(){
             document.getElementById("registrationForm").reset();
            }
        </script>
        <script>
            
            function personalErea(){
            document.getElementById("registrationForm").reset();
             location.href='http://gabriellasi.mtacloud.co.il/PersonalErea/person_final.php';
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
                        } 
                        else {   
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
        $(function() {
        $('#registrationForm').submit(function (event) {
            event.preventDefault();
            event.returnValue = false;
            $.ajax({
                type: 'POST',
                url: 'deeper_latest.php',
                data: $('#registrationForm').serialize(),
                success: function(data) {
                if(data=='פרטיך נרשמו בהצלחה!'){
                $('#data').html(data);
                $('#firstKey').css("display", "inline");
                $('#secKey').css("display", "inline");
                $('#thirdKey').css("display","none");
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
                }
                    else{
                    $('#data').html(data);
                    $('#firstKey').css("display", "none");
                    $('#secKey').css("display", "none");
                    $('#thirdKey').css("display","inline");
                    $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
               }
            
            }
    });
    });
        });
    </script> 
    </body>
</html>