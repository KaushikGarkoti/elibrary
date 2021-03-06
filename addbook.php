
  <?php include 'header.php'; ?>
  <?php include 'navbar.html'?>
<div class="container">
<div class="row custom-row center-align white">
    <form class="col s12" id="bookform" action="connect.php" method="POST">
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
          <input type="text" id="fileurl" name="fileurl">
          <label for= "fileurl">Book url</label>
        </div>
      <button data-target = "modal2" class="waves-effect waves-light btn z-depth-3 modal-trigger"> <span>Add Book</span></button>
      <div id="modal2" class= "modal bottom-sheet green lighten-3" >
        <div class="modal-content">
          <h6>Confirm add Book operation</h6>
        </div>
        <div class="modal-footer">
        <a href='#!' class='modal-close waves-effect waves-green btn-flat'>Cancel</a>
        <button class="waves-effect waves-light btn z-depth-3" type="submit" name="post2db" value= "1"> <span>Add Book</span></button>
        </div>
      </div>
      </div>
    </form>
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


        