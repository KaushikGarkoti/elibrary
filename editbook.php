
  <?php include 'header.php'; ?>
  <?php include 'navbar.html'?>
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

$sql = "SELECT name, author, description, cover_image, id FROM books WHERE"." ".$id;
$result = mysqli_query($conn,$sql);

$bookName = " ";
$authorName = " ";
$description = " ";
$bookurl = " ";
$bookId = " ";
if ($result->num_rows > 0) {
  // output data of each row
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
?>
<div class="container">
<div class="row center-align white custom-row"
><?php echo
    "<form class='col s12' action='./update.php' method='POST'>
      <div class='row'>
        <div class='input-field col s12'>
          <input id='name' name = 'name' type='text' class='validate' value = '$bookName'>
          <label for='name'>Book Name</label>
        </div>
        <div class='input-field col s12'>
          <input id='Author' name = 'author' type='text' class='validate' value = '$authorName'>
          <label for='Author'>Author</label>
        </div>
        <div class='input-field col s12'>
          <textarea id='textarea1' name = 'description' class='materialize-textarea'>'$description'</textarea>
          <label for='textarea1'>Description</label>
        </div>
        <div class='input-field col s12'>
          <input type='text' id='fileurl' name='bookurl' value = '$bookurl'>
          <label for= 'fileurl'>Book url</label>
        </div>
        <div class='input-field col s12'>
          <input type='text' id='bookid' name='bookid' value = '$bookID' hidden>
        </div>
      <button class='waves-effect waves-light btn z-depth-3' name = 'update' method='post' action='./update.php?'> <span>update</span></button>
      <button data-target='modal1' class=' modal-trigger waves-effect waves-light btn red z-depth-3'> <i class='material-icons'>delete</i><span>delete book</span></button>
      <div id='modal1' class='modal bottom-sheet red lighten-3'>
          <div class='modal-content'>
            <h6>Are you sure you want to delete?</h6>
          </div>
    <div class='modal-footer'>
    <a href='#!' class='modal-close waves-effect waves-green btn-flat'>Cancel</a>

    <button class= 'waves-effect waves-light btn red z-depth-3' name = 'delete' method='post' action='./update.php?'> <i class='material-icons'>delete</i><span>delete book</span></button>
    </div>
  </div>
      </div>
    </form>" ?>
  </div>
</div> 
<script>

const elems = document.querySelectorAll('.modal');
    const instances = M.Modal.init(elems, {
        opacity: 0.5,
    });
</script>

</body>
</html> 

        