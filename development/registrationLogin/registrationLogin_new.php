<?php
session_start();

if(isset($_SESSION["user_token"])){

    //admin
    if($_SESSION["permit"]===1){}

    //youth
    if($_SESSION["permit"]===2){}
    //shelter
    if($_SESSION["permit"]===3){
        echo '<style type="text/css">
            #shelter{display:none;}
        </style>';
    }
    //support group
    if($_SESSION["permit"]===4){
                echo '<style type="text/css">
            #shelter{display:none;}
        </style>';
    }
    //volunteer
    if($_SESSION["permit"]===5){}
    //carer
    if($_SESSION["permit"]===6){}

}

?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
      <title>הושט לי יד</title>
      <meta charset="utf-8">
      <link rel="icon" href="logo_icon.png">
      <link rel="stylesheet" type="text/css" href="joinus.css">
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
  </head>
    
    <body>
        <div class="header">
            <div id="log">        
            <i id="logIn" class="fa" title="התחבר" >&#xf007;</i>
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
            <div class="pointer" id="shelter" style="display:none;">
                <div calss="navbar">
                    <nav class="stroke">
                        <ul>
                          <li><a href="#">הוסף בית מחסה</a></li>
                          <li><a href="#">הוסף קבוצת תמיכה</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <a href="#" onclick="signOut();" style="font-family: gisha;font-size: 20px;font-weight: bold;display: block;text-align: center;">התנתק</a>
        <script>
            function signOut() {
                var auth2 = gapi.auth2.getAuthInstance();   auth2.signOut().then(function () {
                    console.log('User signed out.');
                });
                location.reload(true);
            }
            <?php
                session_destroy();
                session_unset();
            ?>

        </script>

        
        <main>
            <div class="page-header" style="border-bottom: 1px solid #E8AFBF;">
                <h3 id="title" style="font-family: 'Amatic SC'; font-size: 50px; color:  #822040;">כניסה  למערכת</h3>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-sm-6 login">
                        <h2>רוצה להשאיר אצלנו עוד פרטים?</h2>
                        <p class="text-center">מערכת <b>הושט לי יד</b> מאפשרת רישום  פרטים נוספים לגבייך 
                        [כגון: גיל, איזור מגורים, טלפון]<br>
                        <span style="color:red;font-weight: bold;">*שלב זה אינו חובה בשלב הכניסה למערכת  </span>
                        </p>
                        <form id="registrationForm" action="deeper_registration.php" method="post" onsubmit="getCity()">
                            <div class="form-group">
                                <label for="phoneNum">מספר טלפון</label>
                                <input class="form-control" type="tel" name="phoneNum" placeholder="מספר טלפון" pattern="(?=.*[0-9]).{9,10}" required>
                            </div>
                            <div class="form-group">
                                <label for="city">שם ישוב:</label>
                                <p id="city" name="city1" placeholder="שם ישוב" required="" value="">
                            </div>
                            <div class="form-group">
                                <label for="age">גיל:
                                </label>
                                <input class="form-control" type="text" name="age" placeholder="גיל" value="" required>
                                <input type="text" id="cityChange" name="cityName" value="" style="display: none;">
                                <input type="text" id="token" name="token" value="" style="display: none;">
                            </div>
                            <div class="form-group">
                                <label for="gender">זהות מינית: 
                                </label>
                                <select name="gender" required>
                                    <option disabled selected>בחר מתוך הרשימה</option>
                                    <option>נקבה</option>
                                    <option>זכר</option>
                                    <option>אחר</option>
                                </select>
                                
                            </div>
                            <input type="submit" class="btn btn-info btn-lg" value="הצטרף" onsubmit="">
                        </form>

                    </div>
                    
                    <div class="col-sm-6 registration">
                        <h2>כניסה עם חשבון Gmail</h2>
                        <form class="form-row">
                            <p class="text-center">בעת הכניסה, מערכת <b>הושט לי יד</b> תשמור את כתובת המייל והשם המלא המקושר לכתובת.</p><br><br>
                            
                            <select id="permission" required>
                                <option disabled="" selected="" value="">בחר את סוג המשתמש</option>
                                <option value="2">נוער</option>
                                <option value="5">מתנדב ממערך "הושט לי יד"</option>
                                <option value="4">קבוצת תמיכה</option>
                                <option value="3">בית מחסה</option>
                                <option value="6">מטפל</option>
                            </select>
                            <br><br>
                            <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" data-onfailure="onFailure"></div>
                            <script>
                                function onFailure(error) {
                                    console.log(error);
                                }
                                
                                function onSignIn(googleUser) {
                                // Useful data for your client-side scripts:
                                console.log('Logged in as:');
                                var profile = googleUser.getBasicProfile();
                                console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                                console.log('Full Name: ' + profile.getName());
                                console.log('Given Name: ' + profile.getGivenName());
                                console.log('Family Name: ' + profile.getFamilyName());
                                console.log("Image URL: " + profile.getImageUrl());
                                console.log("Email: " + profile.getEmail());

                                // The ID token you need to pass to your backend:
                                var id_token = googleUser.getAuthResponse().id_token;
                                    var full_name = profile.getName();
                                    var family_name= profile.getFamilyName();
                                    var first_name= profile.getGivenName();
                                    var email_add = profile.getEmail();
                                    var email_ID = profile.getId();
                                    
                                console.log("ID Token: " + id_token);
                                    
                                    
                                    /*var user_permit = Document.getElementById('permission');
                                    var chosen_permit = user_permit.options[user_permit.selectedIndex].value;
                                    */
                                updateToken(id_token, full_name, family_name, first_name, email_add, email_ID);
                                    
                                    var token = document.getElementById("token");
                                    token.setAttribute("value",id_token);
                                    
                                    };
                                
                                function updateToken(tokenid, fullName, familyName, firstName, emailAdd, emailId){
                                    $.post("authenticate.php",
                                            { id_token: tokenid , full_name: fullName, family_name: familyName, first_name: firstName, email_add: emailAdd, email_id: emailId},
                                            function(){
                                            alert("Successfuly added token");
                                            });
                                    /*updatePermission(tokenid);*/
                                    var user_permit = document.getElementById('permission');
                                    var chosen_permit = user_permit.options[user_permit.selectedIndex].value;
                                    $.post("update_permission.php",
                                            { id_token: tokenid , permit: chosen_permit
                                            },
                                            function(){
                                            alert("updated permission");
                                            });
                                        }
                                
                                /*function updatePermission(tokenid){
                                    var user_permit = document.getElementById('permission');
                                    var chosen_permit = user_permit.options[user_permit.selectedIndex].value;
                                    
                                    $.post("update_permission.php",
                                            { id_token: tokenid , permit: chosen_permit
                                            },
                                            function(){
                                            alert("updated permission");
                                            });
                                }*/
                              
                            </script>
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
            txt+="<select>"
            txt+="<option disabled selected>בחר/י ישוב"
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
        <?php
        /*$_SESSION["user"] = $_POST['token'];
        $_SESSION["permit"] = $_POST['permit'];*/
        echo $_SESSION["permit"];
        echo $_SESSION["user"];
        ?>
        
    </body>
</html>