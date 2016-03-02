<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php 
        session_start();
        if(isset($_SESSION['mainPage']) || isset($_SESSION['savePage'])) {
            echo "<h1>Welcome " .$_SESSION["username"]." to editor </h1>";
            $text = textShow();       
            if($text['user_type'] == 'admin')
            {
                header('Location: adminPage.php');
            }
        } else {
            header('Location: mainPage.php');
        }
        function textShow() {
            $hostname = 'localhost';
            $username = 'root';
            $password = 'root';
            
            $editor = new PDO("mysql:host=$hostname;dbname=project2", $username, $password);

            $statement = $editor->prepare("SELECT `textEditor`,`user_type` FROM `users` WHERE `users`.`username` = :username ");
            $statement->bindParam(':username', $_SESSION["username"]);
            $statement->execute();
            return $result = $statement->fetch();
        }
        ?>
        <form id="editorForm" method='POST' action='saveText.php'>
            <textarea name="editor" rows="10" cols="100"> <?php echo $text[0]; ?> </textarea><br><br>
        </form>
        <input type="submit" form='editorForm' name="saveBtn" value='Save'>
        <button type="button" name="logoutBtn" onclick="logoutBtn()">Log out</button>       
       
        <script type="text/javascript">
            function logoutBtn() {
                window.location.href = "redirectMainPage.php";
            }
        </script>
    </body>
</html>