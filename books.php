<?php 
$serverName = "localhost";
$userName = "root";
$password = "Artadam@3@007";
$dbName = "library";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if ($conn->connect_error) {
  die ("connection failed" .$conn->connect_error);
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
            <div class='col s12 m3' id=<?php echo $data[$i]['id'] ?>>
              <div class='card custom-card'>
                <div class='card-image'>
                  <img src= <?php echo $data[$i]['cover_image']?> style='height: 300px'>
                  <span class='card-title'> <?php echo $data[$i]['name']?></span>
                  <a href=<?php echo ('./editbook.php?id='.$data[$i]['id'])?> class='btn-floating halfway-fab waves-effect waves-light red'><i class='material-icons'>create</i></a>
                </div>
                <div class='card-action' style='background-color:#B7C9A9'>
                    <blockquote>

                <a class='card-font card-font-author'style="display:block; color: black" href='#'><?php echo $data[$i]['author']?></a>
                <a class='card-font'style="display:block; color: black" href= <?php echo ('./book.php?id='.$data[$i]['id'])?>>View Book</a> 
                    </blockquote>               
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

