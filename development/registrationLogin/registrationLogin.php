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
        
        mysqli_set_charser($conn,"utf8");
        
        $sql = "INSERT INTO youth (user_id, first_name, last_name, age, mail, gender, city, password) VALUES ('1234','Gaby','Silver','26','gabytsilver@gmail.com','female','Netanya','yay123');";
        result = $conn->query($sql);
        
        if ($result->num_rows > 0){
            echo "<style>table{ color: green; text-align:center; background-color:yellow; border: 2px blue solid;} tr{ border: 2px blue solid;} td{ border: 2px blue solid;}</style><table><tr><th>user_id</th><th>first_name	</th><th>last_name</th><th>age</th><th>mail</th><th>gender</th><th>city</th><th>password</th></tr>";
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["user_id"]. "</td><td>" . $row["first_name"]. " " . $row["last_name"]. "</td><td>" . $row["age"]. "</td><td>" . $row["mail"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["city"]. "</td><td>" . $row["password"]. "</td></tr>";
            }
        }
        else{
            echo "the "$result" has 0 rows";
        }
        
        
        $conn->close();
        ?>
    </body>
</html>