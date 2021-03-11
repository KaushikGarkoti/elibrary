<?php session_start();?>
<?php 
if($_SESSION['role'] !== 'admin') {
  header("Location: HTTP/1.0 403 Forbidden");
  exit;
}
?>

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

  
$target_dir = "var/www/elib/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$_SESSION['targetfile'] = $target_file;
$uploadOk = 1;

if (isset($_POST['post2db'])) {
    $name = $_POST['name'];
    $Author = $_POST['Author'];
    $textarea1 = $_POST['textarea1'];
    $fileurl =  $_POST['fileurl'];


    $sqlquery = "INSERT INTO books (name, author, description, cover_image) VALUES ('$name',  '$Author', ' $textarea1',  '$_SESSION[targetfile]')";

    if(mysqli_query($db, $sqlquery)){
        $result = mysqli_query($db, "SELECT id FROM books WHERE id=(SELECT max(id) FROM books)")
        or die(mysqli_error($db));
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
  }
?>
<?php include 'header.php'; ?>
<?php include 'navbar.php';?>

<div class="container">
<div class="row custom-row center-align white">
    <form class="col s12 m8" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="bookform" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" class="validate" name = "name" required>
          <label for="name">Book Name</label>
        </div>
        <div class="input-field col s12">
          <input id="Author" type="text" class="validate" name = "Author" required>
          <label for="Author">Author</label>
        </div>
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea" name="textarea1"></textarea>
          <label for="textarea1">Description</label>
        </div>
        <div class="input-field col s12">
          <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
      <button data-target = "modal2" class="waves-effect waves-light btn z-depth-3 modal-trigger"> <span>Add Book</span></button>
      <div id="modal2" class= "modal bottom-sheet green lighten-3" >
        <div class="modal-content">
          <h6>Confirm add Book operation</h6>
        </div>
        <div class="modal-footer">
          <a href='#!' class='modal-close waves-effect waves-green btn-flat'>Cancel</a>
          <button class='waves-effect waves-light btn z-depth-3' type='submit' name='post2db' value= 1> <span>Add Book</span></button>
        </div>
      </div>
      </div>
    </form> 

      <div class='col s12 m4' id = 'bookupload'>
      <img class='responsive-img' src='$_SESSION[targetfile]'> </img>
      </div>

  </div>
</div> 
<script>

const inputfile = document.querySelector('#fileToUpload');
const imgcontainer = document.querySelector('#bookupload');
const img = imgcontainer.querySelector('.responsive-img');


inputfile.addEventListener('change', function () {
  const file = this.files[0];
  console.log(file);
  if (file) {
    const reader = new FileReader();
    reader.addEventListener('load', function () {
      console.log(this.result);
      img.setAttribute('src', this.result)
    });
    reader.readAsDataURL(file);
  }
});

const elems = document.querySelectorAll('.modal');
    const instances = M.Modal.init(elems, {
        opacity: 0.5,
    });
</script>
</body>
</html> 


        