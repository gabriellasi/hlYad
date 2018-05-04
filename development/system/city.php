<html>
    <body>
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
        
      /*  if ( ! empty( $_GET['msg'] ) ) {
        	echo "JS says " . $_GET['msg']; // Outputs : JS says Hi!
        } */
         
        $cityOrigin = $_GET['cityName'];       
        echo $cityOrigin;
        
        echo "hello";
        ?>
        
    </body>
</html>