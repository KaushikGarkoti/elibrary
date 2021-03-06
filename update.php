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
$sqlquery = "";

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $Author = $_POST['author'];
    $textarea1 = $_POST['description'];
    $fileurl =  $_POST['bookurl'];
    $id = $_POST['bookid'];
    $sqlquery = "UPDATE `books` SET `name` = '$name',`author` = '$Author', `description` = '$textarea1' WHERE `id`='$id'";
}

if (isset($_POST['delete'])) {
    $id = $_POST['bookid'];
    $sqlquery = "DELETE FROM `books` WHERE `id`='$id'";
}


if(mysqli_query($db, $sqlquery) && isset($_POST['update'])){
    echo "Records updated successfully.";
    header("Location: ./bookadded.php?id=$bookID"); /* Redirect browser */
    exit();
} else if (mysqli_query($db, $sqlquery) && isset($_POST['delete'])){
    header("Location: ./hello.php?id=$bookID&opr=del"); /* Redirect browser */
    exit();
} else 
    echo "ERROR: Could not able to execute $sqlquery. " . mysqli_error($db);

?>