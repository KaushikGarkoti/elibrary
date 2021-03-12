<?php session_start(); ?>
<?php include 'header.php' ?>
<?php include 'navbar.php' ?>
<?php 
$serverName = "localhost";
$userName = "root";
$password = "Artadam@3@007";
$dbName = "library";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if ($conn->connect_error) {
  die ("connection failed" .$conn->connect_error);
} ?>

<?php 
$q = "SELECT * FROM has_book JOIN books ON books.id = has_book.book_id";
$response = mysqli_query($conn,$q)or die(mysqli_error($conn));
$data = [];
if($response->num_rows > 0) {
  while($row = mysqli_fetch_array($response)) {
      $data[] = $row;
  }
}

?>
<div class='container'>
  <div class='carousel carousel-slider center'>
  <?php 
    while($i < count($data)) {
      if($data[$i]['user_id'] == $_SESSION['userid']) { ?>
      <div class='carousel-item center' href='#<?php echo"$i"; ?>!'>  
            <img src="<?php echo $data[$i]['cover_image'];?>"style="width:600px; height: 600px">
        <h3><?php echo $data[$i]['name'] ?></h3>
        <div class="description">
           <?php echo $data[$i]['description']?>
        </div>
      </div>
    <?php } else echo "" ?>
  </div>
     <?php $i++;
    } 
    ?>   
  </div>

</div>



<script>
 document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelectorAll('.carousel');
    const instances = M.Carousel.init(elems, {
      fullWidth: true,
    indicators: true
    });
  });
</script>

  </body>
  </html>
