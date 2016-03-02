<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                    label {
                        display: block;
                        text-align: center;
                        line-height: 150%;
                        font-size: .85em;
                    }
                    h1, #buttons, #formDiv, #Instructions { 
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
    $usernameErr = $passwordErr = $retypePasswordErr = "";
    $username = $password = $retypePassword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["username"])) {
            $usernameErr = "Username is required.";
        } else {
            $username = $_POST["username"];
            if (!preg_match("/[a-zA-Z\d]/",$username)) {
                $usernameErr = "Only letters and numbers allowed";
            }
        }
        if(empty($_POST["password"])) {
            $passwordErr = "Password is required.";
        } else {
            if($_POST["password"] != $_POST["username"]) {
                if($_POST["password"] != $_POST["retypePassword"]) {
                    $passwordErr = "Passwords don't match.";
                    if(empty($_POST["retypePassword"])) {
                        $retypePasswordErr = "Password is required.";
                        $passwordErr = "";
                    }
                }
                elseif($_POST["password"] == $_POST["retypePassword"]) {               
                    $_SESSION["username"] = $_POST["username"];
                    $_SESSION["password"] = $_POST["password"];
                    $URL = "register.php";  
                    header ("Location: $URL");  
                }
            } else {
                $passwordErr = "Username and Password must be different.";        
            }   
        }
    }
    
    ?>
        <h1>Register</h1>
        <div id="formDiv">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="registerForm">
                <p><label for="name">Username</label><input type="text" name="username"><span class='error'><?php echo $usernameErr ?></span></p>
                <p><label for="name">Password</label><input type="password" name="password"><span class='error'><?php echo $passwordErr ?></span></p>
                <p><label for="name">Retype Password</label><input type="password" name="retypePassword"><span class='error'><?php echo $retypePasswordErr ?></span></p>
            </form>
        </div>
        <div id="buttons">
            <input type="submit" form="registerForm" value="Confirm">
            <button type="button" onclick="window.location='mainPage.php'" name="backBtn" value="Back">Back</button>
        </div>
        <div id='Instructions'>
            <?php 
            echo "<br>Hints:<br>";
            echo "Username can be letters and digits.<br>";
            echo "Username and Password must be different."
            ?>
        </div>      
    </body>
</html>