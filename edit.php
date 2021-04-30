<?php session_start(); ?>
 
<?php
if(!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
?>
 
<?php
// including the database connection file
include_once("connection.php");
 
if(isset($_POST['update']))
{    
    $id =  $_SESSION['id'];
    
    $title = $_POST['title'];
    $description = $_POST['description']; 
    
    // checking empty fields
    if(empty($name) || empty($description)) {                
        if(empty($title)) {
            echo "<font color='red'>Title field is empty.</font><br/>";
        }
        
        if(empty($description)) {
            echo "<font color='red'>Description field is empty.</font><br/>";
        }
               
    } else {    
        //updating the table
        $mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);    
        $result = mysqli_query($mysqli, "UPDATE courses SET name='$title', description='$description', WHERE id=$id");
        
        //redirectig to the display page. In our case, it is view.php
        header("Location: view.php");
    }
}
?>
<?php
//getting id from url
$mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);   

$id = isset($_GET['id']) ? $_GET['id'] : '';
 
$mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);    
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM courses WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $title = $res['title'];
    $description = $res['description'];
}

?>

<!doctype html>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    <a href="index.php">Home</a> | <a href="view.php">View Courses</a> | <a href="logout.php">Logout</a>
    <br/><br/>
    
    <form name="form1" method="post" action="edit.php">
        <div>
            <div>
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $title;?>">
            </div>
            <div>
                <label>Description</label>
                <input type="text" name="description" value="<?php echo $description;?>">
            </div>
            <div>
                <input type="hidden" name="id" value= "<?php echo intval($_GET['id']);?>" >
                <input type="submit" name="update" value="Update">
            <div>
        </div>
    </form>
</body>
</html>