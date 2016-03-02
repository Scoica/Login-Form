<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 15px;
            }
        </style>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
       <?php 
        echo "<h1>Administrator Panel</h1>";

        $tasks = show();

        echo "<table>";
        echo "<tr><th>Username</th><th>Type</th><th>Commands</th></tr>";
        for($r = 0; $r < count($tasks); $r++) {
            echo "<tr>";

            $userType = $tasks[$r]->user_type;
            $username = $tasks[$r]->username;

            echo "<td>" .$username ."</td>";   
            if($userType == 'user') {
                echo "<td>" . "<input id='". $username ."' type='checkbox' onclick='validate(this)' name='checkbox' >" ."</td>";  
            } elseif($userType == 'admin') {
                echo "<td>" . "<input id='". $username ."' type='checkbox' onclick='validate(this)' name='checkbox' checked>" ."</td>";  
            }            
            echo "<td>" . "<p><input id='". $username ."' type='button' onclick='deleteBtn(this)' name='delete' value='delete'></p>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        function show() {
            $hostname = 'localhost';
            $username = 'root';
            $password = 'root';

            $conn = new PDO("mysql:host=$hostname;dbname=project2", $username, $password);

            $querry = $conn->query("SELECT * FROM `users`");
            $result = $querry->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
       ?>
        <p><button type="button" onclick="backBtn()">Logout</button></p>
        <script type="text/javascript">
            function validate(obj) {
                $.post( "user_type.php", { checked: obj.checked, username: obj.id });
            }
            function deleteBtn(obj) {
                //$.post( "user_action.php", { name: obj.name, title: obj.id });
                window.location.href = "user_type.php?name=delete&username=" + obj.id;
            }
            function backBtn() {
                window.location.href = "mainPage.php";
            }
        </script>
    </body>
</html>