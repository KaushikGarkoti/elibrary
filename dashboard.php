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
  <h3>Dashboard</h3>
  <div class='row'>
    <div class='col s12'>
      <ul class='tabs'>
          <li class='tab col s3'><a href='#read'>Completed</a></li>
          <li class='tab col s3 active'><a href='#reading'> Reading</a></li>
          <li class='tab col s3'><a href='#wishlist'>Wishlist</a></li>
          <li class='tab col s3'><a href='#request'>Requested</a></li>
      </ul>
    </div>
    
    <div id='read' class='col s12'>
      <p class='responsive-text'><h5>Books You've marked completed</h5></p>
      <div class='carousel carousel-slider center'>         
        <div class='carousel-fixed-item'></div>
        <?php
        $i = 0; 
          while($i < count($data)) {
            if($data[$i]['user_id'] == $_SESSION['userid']) { ?>
            <div class='carousel-item' href='#<?php echo"$i"; ?>!'>  
                <a href="#"><img class="img-responsive" src="<?php echo $data[$i]['cover_image'];?>" style="width:400px;height:400px"></a>
                <h4><?php echo $data[$i]['name'] ?></h4>
                <div class="description">
                  <?php echo $data[$i]['description']?>
                </div>
            </div>
          <?php } else echo "" ?>
          <?php $i++;
          } 
        ?>
      </div>
    </div>

    <div id='reading' class='col s12'>
      <p class='responsive-text'><h5>Book You're reading</h5></p>
      <div class='carousel carousel-slider center'>         
        <div class='carousel-fixed-item'></div>
        <?php 
          while($i < count($data)) {
            if($data[$i]['user_id'] == $_SESSION['userid']) { ?>
            <div class='carousel-item' href='#<?php echo"$i"; ?>!'>  
                <a href="#"><img class="img-responsive" src="<?php echo $data[$i]['cover_image'];?>" style="width:400px;height: 400px"></a>
                <h4><?php echo $data[$i]['name'] ?></h4>
                <div class="description">
                  <?php echo $data[$i]['description']?>
                </div>
            </div>
          <?php } else echo "" ?>
          <?php $i++;
          } 
        ?>
      </div>
    </div>

    <div id='wishlist' class='col s12'>
      <p class='responsive-text'><h5>Book You're reading</h5></p>
      <div class='carousel carousel-slider center'>         
        <div class='carousel-fixed-item'></div>
        <?php 
          while($i < count($data)) {
            if($data[$i]['user_id'] == $_SESSION['userid']) { ?>
            <div class='carousel-item' href='#<?php echo"$i"; ?>!'>  
                <a href="#"><img class="img-responsive" src="<?php echo $data[$i]['cover_image'];?>" style="width:400px;height: 400px"></a>
                <h4><?php echo $data[$i]['name'] ?></h4>
                <div class="description">
                  <?php echo $data[$i]['description']?>
                </div>
            </div>
          <?php } else echo "" ?>
          <?php $i++;
          } 
        ?>
      </div>
    </div>

    <div id='request' class='col s12'>
      <p class='responsive-text'><h5>Book You're reading</h5></p>
      <div class='carousel carousel-slider center'>         
        <div class='carousel-fixed-item'></div>
        <?php 
          while($i < count($data)) {
            if($data[$i]['user_id'] == $_SESSION['userid']) { ?>
            <div class='carousel-item' href='#<?php echo"$i"; ?>!'>  
                <a href="#"><img class="img-responsive" src="<?php echo $data[$i]['cover_image'];?>" style="width:400px;height: 400px"></a>
                <h4><?php echo $data[$i]['name'] ?></h4>
                <div class="description">
                  <?php echo $data[$i]['description']?>
                </div>
            </div>
          <?php } else echo "" ?>
          <?php $i++;
          } 
        ?>
      </div>
    </div>
</div>
<script>
 document.addEventListener('DOMContentLoaded', () => {
    const el = document.querySelector('.tabs')
    const instance1 = M.Tabs.init(el, {});
    const elems = document.querySelectorAll('.carousel');
    const instance = M.Carousel.init(elems, {
      fullWidth: true,
      indicators: true
    });
  });
</script>
</body>
</html>
