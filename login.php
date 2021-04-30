<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <title>Login</title>
</head>
 
<body>
<a href="index.php">Welcome Page</a> <br />
<?php
include("connection.php");
 
if(isset($_POST['submit'])) {
    $mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);

    $user = mysqli_real_escape_string($mysqli, $_POST['name']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
 
    if($user == "" || $pass == "") {                                                                                                           
        echo "Either username or password field is empty.";
        echo "<br/>";
        echo "<a href='login.php'>Go back</a>";
    }
    else {
        $result = mysqli_query($mysqli, "SELECT * FROM login WHERE name='$user' AND password=md5('$pass')")
        or die("Could not execute the select query.");
        
        $row = mysqli_fetch_assoc($result);
        
        if(is_array($row) && !empty($row)) {
            $validuser = $row['name'];
            $_SESSION['valid'] = $validuser;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
        } else {
            echo "Invalid username or password.";
            echo "<br/>";
            echo "<a href='login.php'>Go back</a>";
        }
 
        if(isset($_SESSION['valid'])) {
            header('Location: index.php');            
        }
    }
} else {
?>
    <p class="login">Login</p>
    <form name="form1" method="post" action="">
        <div> 
           <div>
                <label>User Name</label>
                <input type="text" name="name">
            </div>
            <br>
            <div>
                <label>Password</label> &nbsp;
                <input type="password" name="password">
            </div>
            <br>
            <div>
                <label>&nbsp;</label>
                <input type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
<?php
}
?>
</body>
</html>