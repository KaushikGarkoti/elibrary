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

if (isset($_POST['post2db'])) {
    $name = $_POST['name'];
    $Author = $_POST['Author'];
    $textarea1 = $_POST['textarea1'];
    $fileurl =  $_POST['fileurl'];
}

$sqlquery = "INSERT INTO books (name, author, description, cover_image) VALUES ('$name',  '$Author', ' $textarea1',  '$fileurl')";
/* 3306*/
if(mysqli_query($db, $sqlquery)){
    $result = mysqli_query($db, "SELECT id FROM books WHERE id=(SELECT max(id) FROM books)");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $bookID = $row["id"];
        }
    }
    header("Location: ./bookadded.php?id=$bookID"); /* Redirect browser */
  exit();
} else{
    echo "ERROR: Could not able to execute $sqlquery. " . mysqli_error($db);
}
?>
