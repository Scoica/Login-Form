<?php
session_start();

    if($_POST['saveBtn']) {
        saveText($_SESSION["username"], $_POST['editor']);
        $_SESSION['savePage'] = TRUE;
        header('Location: login.php');
    }
    
    function saveText($user, $text) {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'root';
        
        $save = new PDO("mysql:host=$hostname;dbname=project2", $username, $password);
        
        $statement = $save->prepare("UPDATE `project2`.`users` SET `textEditor` = :text WHERE `users`.`username` = :username;");
        $statement->bindParam(':text', $text);
        $statement->bindParam(':username', $user);
        $statement->execute();
    }
?>

