
  <?php include 'header.php'; ?>
  <?php include 'navbar.html'?>
<div class="container">
<div class="row center-align white" style="position: relative;
width: 53.563%;
height: 30.938%;
margin-top: 4rem;
border-radius: 3rem;
">
    <form class="col s12" id="bookform" action="connect.php" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" class="validate" name = "name">
          <label for="name">Book Name</label>
        </div>
        <div class="input-field col s12">
          <input id="Author" type="text" class="validate" name = "Author">
          <label for="Author">Author</label>
        </div>
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea" name="textarea1"></textarea>
          <label for="textarea1">Description</label>
        </div>
        <div class="input-field col s12">
          <input type="text" id="fileurl" name="fileurl">
          <label for= "fileurl">Book url</label>
        </div>
      <button class="waves-effect waves-light btn z-depth-3" type="submit" name="post2db" value= "1"> <span>Add Book</span></button>
      </div>
    </form>
  </div>
</div> 
</body>
</html> 


        