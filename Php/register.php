<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
        <?php 
        session_start();
        $result = checkUser($_SESSION['username']);
        if( $result == FALSE){
            addUser();
        } else {
            echo "<h1> Username exists. Try another username.</h1>";
        }
        function checkUser($user) {
            $hostname = 'localhost';
            $username = 'root';
            $password = 'root';

            $check = new PDO("mysql:host=$hostname;dbname=project2", $username, $password);
            $statement = $check->prepare("SELECT * FROM `users` WHERE `users`.`username` = :user");
            $statement->bindParam(':user', $user);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        function addUser(){
            $hostname = 'localhost';
            $username = 'root';
            $password = 'root';

            $conn = new PDO("mysql:host=$hostname;dbname=project2", $username, $password);
            $statement = $conn->prepare("INSERT INTO `project2`.`users` (`user_id`, `username`, `password`) VALUES (NULL, :name, :password);");
            $statement->bindParam(':name', $_SESSION["username"]);
            $statement->bindParam(':password', $_SESSION["password"]);
            $statement->execute();

            echo "<h1> Registration succesfull! </h1>";  
        }
        ?>
        <button type="button" onclick="window.location ='registerPage.php'" name="backBtn">Back</button>          
    </body>
</html>