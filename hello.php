<?php session_start(); ?>
<?php include 'header.php';?>
<?php include 'navbar.php';?>
<?php include 'userbooks.php';?>
<script>

const form = document.getElementById('radioform');
let radio;
form.addEventListener('click', (event) => {
  radio = event.target;
  radio.disabled = false;
})

// document.addEventListener('DOMContentLoaded', () => {
//     document.querySelectorAll("input[value=]");
// })


</script>
</body>
</html>