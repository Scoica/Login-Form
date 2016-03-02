<html>
    <head>
        <title>Project 2</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            h1 {
                text-align: center;
            }
            form {
                text-align: center;
            }
            #buttons {
                text-align: center;
            }
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        $loginErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] ==  "POST") {
            if(empty($_POST["username"]) == FALSE && empty($_POST["password"] == FALSE)) {
                $values = getSingleValue($_POST["username"], $_POST["password"]); 
                if($values[0] == NULL) {
                    $loginErr = "Incorrect username or password";
                } else {
                    $_SESSION['mainPage'] = TRUE;
                    $_SESSION["username"] = $values[0];
                    header("Location: login.php");
                }
            } elseif(empty($_POST["username"]) == TRUE && empty($_POST["password"] == FALSE)) {
                $loginErr = "No username.";
            } elseif((empty($_POST["username"]) == FALSE && empty($_POST["password"] == TRUE))) {
                $loginErr = "No password."; 
            } elseif(empty($_POST["username"]) == TRUE && empty($_POST["password"] == TRUE)) {
                $loginErr = "No username and password";
            }
        }
        function getSingleValue($username, $password) {
            $conn = new PDO("mysql:host=localhost;dbname=project2","root","root");
            $query = $conn->query("SELECT `username`,`password` FROM `users` WHERE `username` LIKE '".$username."' AND `password` LIKE '".$password."'");
            $f = $query->fetch();
            $result = array($f["username"],$f["password"]);
            return $result;
        }
        ?>
        <h1>Main Page</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="loginForm">
            <p><label for="name">Username</label> <input type="text" name="username"><br></p>
            <p><label for="name">Password</label> <input type="password" name="password"><br></p>
        </form>
        <div id="buttons">
            <button type="submit" form="loginForm" value="Confirm">Confirm</button>
            <button type="button" onclick="window.location='registerPage.php'" value="Register">Register</button>
            <p><span class="error"><?php echo $loginErr ?></span></p>
        </div>
    </body>
</html>