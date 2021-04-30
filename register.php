<!doctype html>
<html>
<head>
    <title>Register</title>
</head>
 
<body>
    <a href="index.php">Home</a> <br />
    <?php
    include("connection.php");
 
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
 
        if($pass == "" || $name == "" || $email == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
            echo "<br/>";
            echo "<a href='register.php'>Go back</a>";
        } else
        {
            $mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);
            mysqli_query($mysqli, "INSERT INTO login (name, email, password) VALUES('$name', '$email', md5('$pass'))")
            or die("Could not execute the insert query.");
            
            echo "Registration successfully";
            echo "<br/>";
            echo "<a href='login.php'>Login</a>";
        }
    } else {                                                                                                                            
?>
        <p>Register</p>
        <form name="form1" method="post" action="">
            <div>
                <div>
                    <label>User Name</label>
                    <input type="text" name="name">
                </div>
                <br>
                <div>
                    <label>Email</label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    <input type="text" name="email">
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