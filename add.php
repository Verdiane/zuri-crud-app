<?php session_start(); ?>
 
<?php
if(!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
?>
<!doctype html>
<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("connection.php");
 
if(isset($_POST['Submit'])) {    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $loginId = $_SESSION['id'];
        
    // checking empty fields
    if(empty($title) || empty($description)) {                
        if(empty($title)) {
            echo "<font color='red'>Title field is empty.</font><br/>";
        }
        
        if(empty($description)) {
            echo "<font color='red'>Description field is empty.</font><br/>";
        }
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // if all the fields are filled (not empty)
        
        $mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database); 
        //insert data to database    
        $result = mysqli_query($mysqli, "INSERT INTO courses(title, description, login_id) VALUES('$title','$description', '$loginId')");
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='view.php'>View Result</a>";
    }
}
?>
</body>
</html>