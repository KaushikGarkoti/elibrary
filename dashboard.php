<?php session_start(); ?>
<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<div id="flipbook">
  <div class="hard"></div> 
  <div class="hard"></div>
  <div> Page 1 </div>
  <div> Page 2 </div>
  <div> Page 3 </div>
  <div> Page 4 </div>
  <div class="hard"></div>
  <div class="hard"></div>
</div>

<script>

  $("#flipbook").turn({
    width: 400,
    height: 300,
    autoCenter: true
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.js" 
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
crossorigin="anonymous">
</script>
<script src="./scripts/turn.min.js"></script>
<link rel="stylesheet" type="text/css" href="./css/book.css">

  </body>
  </html>
