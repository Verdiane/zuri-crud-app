<?php session_start(); ?>
 
<?php
if(!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
?>
 
<?php
//including the database connection file
include_once("connection.php");
 
$mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);    
//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM courses WHERE login_id=".$_SESSION['id']." ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
    <title>Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
 
<body>
<a href="index.php">Welcome</a> | <a href="add.html">Add New Data</a> | <a href="logout.php">Logout</a>
<br/><br/><br>
    
<table >
    <tr >
        <th>Title</td>
        <th>Description</td>
        <th>Update</td>
    </tr>
    <?php
    $mysqli = new Mysqli($databaseHost, $databaseName, $databasePassword, $database);    
    while($res = mysqli_fetch_array($result)) {        
        echo "<tr>";
        echo "<td>".$res['title']."</td> &nbsp;";
        echo "<td>".$res['description']."</td> &nbsp;";   
        echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";    
        echo "<tr>";    
    }
    ?>
</table>    
</body>
</html>