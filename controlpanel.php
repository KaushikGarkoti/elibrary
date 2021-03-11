<?php session_start();?>
<?php 
if($_SESSION['role'] !== 'admin') {
  header("Location: HTTP/1.0 403 Forbidden");
  exit;
}
?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php 
$serverName = "localhost";
$userName = "root";
$password = "Artadam@3@007";
$dbName = "library";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if ($conn->connect_error) {
  die ("connection failed" .$conn->connect_error);
}
?>
<?php 
$name = "";
$Author = "";
$textarea1 = "";
$fileurl = "";

  
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$_SESSION['targetfile'] = $target_file;
$uploadOk = 1;

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);

if (isset($_POST['post2db'])) {
    $name = $_POST['name'];
    $Author = $_POST['Author'];
    $textarea1 = $_POST['textarea1'];
    $fileurl =  $_POST['fileurl'];


    $sqlquery = "INSERT INTO books (name, author, description, cover_image) VALUES ('$name',  '$Author', ' $textarea1',  '$_SESSION[targetfile]')";

    if(mysqli_query($conn, $sqlquery)){
        $result = mysqli_query($conn, "SELECT id FROM books WHERE id=(SELECT max(id) FROM books)")
        or die(mysqli_error($conn));
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $bookID = $row["id"];
            }
        }
        header("Location: ./bookadded.php?id=$bookID"); /* Redirect browser */
    exit();
    } else{
        echo "ERROR: Could not able to execute $sqlquery. " . mysqli_error($conn);
    }
  }
?>

<div class='row'>
    <div class='col s12'>
    <ul class='tabs'>
        <li class='tab col s3'><a href='#admins'>Admins</a></li>
        <li class='tab col s3 active'><a href='#users'> Users</a></li>
        <li class='tab col s3'><a href='#createadmin'>Manage</a></li>
        <li class='tab col s3'><a href='#addbook'>Add Book</a></li>
    </ul>
    </div>
    <div id='admins' class='col s12'>
    <table>
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>Since</th>
        </tr>
        <tr>
        <?php 
        $adminquery = "SELECT * FROM users WHERE role='admin'";
        $getadmin = mysqli_query($conn,$adminquery);
        $data = [];
        if ($getadmin->num_rows > 0) {
            while ($row = mysqli_fetch_array($getadmin)) {
                $data[] = $row;
            }
        
        } else {
            echo 'no record found';
        }
        for ($i = 0; $i < count($data); $i++) { ?>
            <td><?php echo $data[$i]['username']?></td>
            <td><?php echo $data[$i]['email']?></td>
            <td><?php echo $data[$i]['created_at']?></td>
        </tr> <?php } ?>
    
    </table> 

    </div>
    <div id='users' class='col s12'>
    <table>
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>Since</th>
        </tr>
        <tr>
        <?php
        $userquery = "SELECT * FROM users WHERE role='user'";
        $getuser = mysqli_query($conn,$userquery);
        $data = []; 
        if ($getuser->num_rows > 0) {
            while ($row = mysqli_fetch_array($getuser)) {
                $data[] = $row;
            }
        
        } else {
            echo 'no record found';
        }
        for ($i = 0; $i < count($data); $i++) { ?>
            <td><?php echo $data[$i]['username']?></td>
            <td><?php echo $data[$i]['email']?></td>
            <td><?php echo $data[$i]['created_at']?></td>
        </tr> <?php } ?>
    
    </table> 
    </div>
    <div id='createadmin' class='col s12'>
        <ul id="tabs-swipe-demo" class="tabs">
            <li class="tab col s3"><a class="active" href="#newadmin">Create Admin</a></li>
            <li class="tab col s3"><a href="#updateadmin">Update Admin</a></li>
        </ul>
        <div id="newadmin" class="col s12 ">
            <div class="container">
                    <div class="row center-align white custom-row">
                        <form class='col s12' action='./userservice.php' method='POST'>
                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input id='adminname' name = 'adminname' type='text' class='validate'>
                                    <label for='adminname'>Name</label>
                                </div>
                                <div class='input-field col s12'>
                                    <input id='email' name = 'email' type='text' class='validate'>
                                    <label for='email'>email</label>
                                </div>
                                <div class='col s12 input-field'>
                                    <input type="password" id='password' name='password' placeholder='password'>
                                    <label for='password'>password</label>
                                </div>
                                <div class='col s12 input-field'>
                                    <input type="password" id='cnfpassword' name='cnfpassword' placeholder='confirm password'>
                                    <label for='cnfpassword'>password</label>
                                </div>
                                <button class='waves-effect waves-light btn z-depth-3' name = 'newadmin' method='post' action='./userservice.php'> <span>Create Admin</span></button>
                            </div>
                        </form>
                    </div>
                </div> 
        </div>
        <div id="updateadmin" class="col s12">
            <div class="container">
                <div class="row center-align white custom-row">
                    <form class='col s12' action='./userservice.php' method='POST'>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input id='admin_name' name = 'admin_name' type='text' class='validate'>
                                <label for='admin_name'>Name</label>
                            </div>
                            <div class='input-field col s12'>
                                <input id='admin_email' name = 'admin_email' type='text' class='validate'>
                                <label for='admin_email'>email</label>
                            </div>
                            <div class='input-field col s12'>
                                <select id = 'manage' name = 'manage'>
                                    <option value="" disabled selected>Change Permissions</option>
                                    <option value="user">Make user</option>
                                    <option value="admin">Make admin</option>
                                </select>
                                <label>Change Permissions</label>
                            </div>
                            <button type = 'submit'class='waves-effect waves-light btn z-depth-3' name = 'updateadmin'> <span>update Permissions</span></button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <div id='addbook' class='col s12'>
    
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
                <img class='responsive-img' src='$_SESSION[targetfile]'></img>
                </div>

            </div>
        </div> 
    </div>
  </div>
<script>
  const instance = M.Tabs.init(document.querySelectorAll('.tabs'), {});
  document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelectorAll('select');
    const instances = M.FormSelect.init(elems, {});
  });

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