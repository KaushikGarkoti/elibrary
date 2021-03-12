<?php session_start(); ?>
<?php 
$serverName = "localhost";
$userName = "root";
$password = "Artadam@3@007";
$dbName = "library";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if ($conn->connect_error) {
  die ("connection failed" .$conn->connect_error);
}

if (isset($_POST['res'])) {
  $answer = $_POST['group1'];

  // check if value already exists in database.

  $check = "SELECT user_id, book_id FROM has_book WHERE user_id = (SELECT id FROM users WHERE 'username' = '$_SESSION[username]')";
  $result = mysqli_query($conn, $check);
  $q = "";
  $infomsg = "";
  // check if user has ever submitted response before;  
  
if ($result->num_rows > 0 ) {    
    if ($_POST['group1'] === 'request') {
      // If user selects request option, check if user has marked previous book as read.
      $checkbook = "SELECT
      user_id, book_id
    FROM
      has_book
    WHERE
      'user_id' = (
        SELECT
          id
        FROM
          users
        WHERE
          username = '$_SESSION[username]'
      )
      AND book_id = '$_POST[bid]' AND action='reading'";

      $ans = mysqli_query($conn, $checkbook) or die (mysqli_error($conn));
      if (count($ans) < 1) {
        $q = "INSERT INTO has_book (user_id, book_id, action) VALUES ((SELECT id FROM users WHERE 'username' = '$_SESSION[username]'), '$_POST[bid]', 'request') ON DUPLICATE KEY UPDATE    
        action='request'"; 
        $query = mysqli_query($conn, $q) or die (mysqli_error($conn));
      } 
      else {
        $infomsg = "You must mark the previous book as read before you can request another one";
        echo $infomsg;
      }
    }
    else {
      $q = "INSERT INTO has_book (user_id, book_id, action) VALUES ((SELECT id FROM users WHERE 'username' = '$_SESSION[username]'), '$_POST[bid]', '$answer') ON DUPLICATE KEY UPDATE    
        action='$answer'";
      $query = mysqli_query($conn, $q) or die (mysqli_error($conn));
    }
  } 
  else {
    if ($_POST['group1'] === 'request') {
      // If user selects request option, check if user has marked previous book as read.
      $checkbook = "SELECT
      user_id, book_id
    FROM
      has_book
    WHERE
      'user_id' = (
        SELECT
          id
        FROM
          users
        WHERE
          username = '$_SESSION[username]'
      )
      AND book_id = '$_POST[bid]' AND action='reading'";

      $ans = mysqli_query($conn, $checkbook) or die (mysqli_error($conn));
      if (count($ans) < 1) {
        $q = "INSERT INTO has_book (user_id, book_id, action) VALUES ((SELECT id FROM users WHERE 'username' = '$_SESSION[username]'), '$_POST[bid]', 'request') ON DUPLICATE KEY UPDATE    
        action='request'"; 
        $query = mysqli_query($conn, $q) or die (mysqli_error($conn));
      } 
      else {
        $infomsg = "You must mark the previous book as read before you can request another one";
        echo $infomsg;
      }
    }
    else {
      echo $_SESSION['username'];
      $q = "INSERT INTO has_book (user_id, book_id, action) VALUES ((SELECT id FROM users WHERE username = '$_SESSION[username]'), '$_POST[bid]', '$answer') ON DUPLICATE KEY UPDATE    
      action='$answer'"; 
      $query = mysqli_query($conn, $q) or die (mysqli_error($conn));
    }
  }
}

$sql = "SELECT name, author, description, cover_image, id FROM books";
$result = mysqli_query($conn,$sql);
$data = [];

if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
  }

  $i = 0;
  echo "<div id = container>";
  while ($i < count($data)) {
    $col = 0;
?>

        <div class='row' style='background-color:#FFFFFF'>
          <?php while($col < 4 && $i < count($data)) { ?>
            <div class='col s12 m3' id=<?php echo $data[$i]['id']?>>
              <div class='card custom-card'>
                <div class='card-image'>
                  <img src= <?php echo $data[$i]['cover_image']?> style='height: 300px'>
                  <span class='card-title'> <?php echo $data[$i]['name']?></span>
                    <?php if ($_SESSION['role']=='admin') { ?> 
                    <a href= <?php echo ('./editbook.php?id='.$data[$i]['id'])?>
                    class='btn-floating halfway-fab waves-effect waves-light red'>
                    <i class='material-icons'>create</i></a>
                  <?php }
                  ?>
                </div>
                <div class='card-action' style='background-color:#B7C9A9'>
                    <blockquote>

                <a class='card-font card-font-author'style="display:block; color: black" href='#'><?php echo $data[$i]['author']?></a>
                <a class='card-font'style='display:block; color: black' href= <?php echo ('./book.php?id='.$data[$i]['id'])?>>View Book</a> 
                    </blockquote>
                    <form action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method='POST' id = 'radioform'>
                    <?php 
                    
                      if(isset($_SESSION['role'])) { ?>                        
                        <p>
                        <label>
                            <input type='radio' name = 'group1' value = 'read' id = 'radio'>
                            <span class='black-text'>finished reading</span>
                        </label>
                        </p>  
                        <p>
                            <label>
                                <input type='radio' name = 'group1' value = 'reading' disabled>
                                <span class='black-text'>reading</span>
                            </label>
                        </p>     
                        <p>
                            <label>
                                <input type='radio' name = 'group1' value = 'wishlist'>
                                <span class='black-text'>wishlist</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type='radio' name = 'group1' value = 'request'>
                                <span class='black-text'>request</span>
                            </label>
                        </p>
                    <input type="text" name = 'bid' value = <?php echo $data[$i]['id']?> hidden>
                    <button type='submit' data-target="#modal1" name = 'res' class='waves-effect waves-light btn z-depth-3 center modal-trigger'> <span>submit</span></button>
                    <button class='waves-effect waves-light btn z-depth-3 center'> <span>Read Book</span></button>
                    </form>
                    <?php }
                   ?> 
                   <?php
                    echo "<div id='modal1' class='modal'>
                        <div class='modal-content'>
                          <h4 class='black-text'>Success</h4>
                          <p>A bunch of text</p>
                        </div>
                        <div class='modal-footer'>
                          <a href='#!'class='modal-close waves-effect waves-green btn-flat'>OK</a>
                        </div>
                      </div>";
                    ?>
                </div>
              </div>
            </div>
    <?php 
      $col++;
      $i++;
    } 
}?>
      </div> 
    </div>
  <?php } else {
  echo "0 results";
}
?>
<script>



document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelectorAll('.modal');
    const instances = M.Modal.init(elems, {});
  });




</script>

