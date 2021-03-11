<?php session_start();?>
<?php
if (isset($_POST['imageup'])) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $_SESSION['targetfile'] = $target_file;
    $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
?>