<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <title>Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
 
<body>
    <div id="header">
        Welcome to my app!
    </div>
    <hr>
    <?php
    if(isset($_SESSION['valid'])) {            
        include("connection.php");  
        $mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);                  
        $result = mysqli_query($mysqli, "SELECT * FROM login");
    ?>                
        Welcome <?php echo $_SESSION['name'] ?> !
        <br><br>
        <a href='view.php'>View and Add Courses</a>
        <br/><br/>
        <a href='logout.php'>Logout</a>
        <br/>
       
    <?php    
    } else {
        echo "Please sign in to visit the app.<br/>";
        echo "<a href='login.php'>Login</a><br> <br>";
        echo "Are you knew to the app, please register below. <br>";
        echo "<a href='register.php'>Register</a>";
    }
    ?>

</body>
</html>