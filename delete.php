<?php
$server = "localhost";
$username = "root";
$password = "Artadam@3@007";
$dbname = "library";

$db = new mysqli($server, $username,$password, $dbname);
if ($db-> connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}

$name = "";
$Author = "";
$textarea1 = "";
$fileurl = "";

if (isset($_POST['update'])) {
    echo $_POST['bookid'];
    
    
    $name = $_POST['name'];
    $Author = $_POST['author'];
    $textarea1 = $_POST['description'];
    $fileurl =  $_POST['bookurl'];
    $id = $_POST['bookid'];
}

$sqlquery = "DELETE FROM `books` WHERE `id`='$id'";
;


if(mysqli_query($db, $sqlquery)){
    echo "Records Deleted successfully.";
    echo $name;
    echo $id;
    echo $Author;
} else{
    echo "ERROR: Could not able to execute $sqlquery. " . mysqli_error($db);
}
?>