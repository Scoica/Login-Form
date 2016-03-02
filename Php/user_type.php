<?php
    if($_GET['name'] == 'delete') {
        deleteDB($_GET['username']);
        header('Location: adminPage.php');
    }
    if($_POST['checked'] == 'true') {
        updateTrue($_POST['username']);
    }
    if ($_POST['checked'] == 'false') {
        updateFalse($_POST['username']);
    }
    
    function deleteDB($user) {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'root';
        $delete =   new PDO("mysql:host=$hostname;dbname=project2", $username, $password);
                
        $command = $delete->prepare("DELETE FROM `project2`.`users` WHERE `users`.`username` = :user");
        $command->bindParam(':user', $user);
        $command->execute();
    }
    
    function updateTrue($user) {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'root';

        $update =   new PDO("mysql:host=$hostname;dbname=project2", $username, $password);
        $command = $update->prepare("UPDATE `project2`.`users` SET `user_type` = 'admin' WHERE `users`.`username` = :user;");
        $command->bindParam(':user', $user);
        $command->execute();                   
    }
    
    function updateFalse($user) {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'root';
        $id = $title;

        $update =   new PDO("mysql:host=$hostname;dbname=project2", $username, $password);
        $command = $update->prepare("UPDATE `project2`.`users` SET `user_type` = 'user' WHERE `users`.`username` = :user;");
        $command->bindParam(':user', $user );
        $command->execute();    
    }
