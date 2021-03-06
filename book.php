<?php 
$serverName = "localhost";
$userName = "root";
$password = "Artadam@3@007";
$dbName = "library";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if ($conn->connect_error) {
  die ("connection failed" .$conn->connect_error);
}
$id = $_SERVER['QUERY_STRING'];

$sql = "SELECT name, author, description, cover_image FROM books WHERE"." ".$id;
$result = $conn->query($sql);

$bookName = " ";
$authorName = " ";
$description = " ";
$bookurl = " ";
$bookId = " ";
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $bookName = $row["name"];
    $authorName = $row["author"];
    $description = $row["description"];
    $bookurl = $row["cover_image"];
    $bookID = $row["id"];
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<?php include 'header.php'?>
    <?php include 'navbar.html' ?>
    <div class="container"> <?php echo
        "<div class='row' style='margin-top:5rem'>
            <div class='col s12 m4'>
                <img src='$bookurl'
                 alt='nature-image'
                 class= 'responsive-img'>  
            </div>
            <div class='col s12 m8'>
            <form class='col s12'>
                <div class='row'>
                    <div class='input-field col s12'>
                        <input id='name' type='text' class='validate' value = '$bookName' disabled>
                        <label for='name'>Book Name</label>
                    </div>
                    <div class='input-field col s12'>
                        <input id='Author' type='text' class='validate' value = '$authorName' disabled>
                        <label for='Author'>Author</label>
                    </div>
                    <div class='input-field col s12'>
                        <textarea id='textarea1' class='materialize-textarea' disabled >'$description'</textarea>
                        <label for='textarea1'>Description</label>
                    </div>
                    <div class='input-field col s12'>
                        <input type='text' id='fileurl' name='filename' value = '$bookurl' disabled >
                        <label for= 'fileurl'>Book url</label>
                    </div>
                </div>
            </form>
        </div>" ?>
    </div>
</body>
</html>