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
if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cnfpassword = mysqli_real_escape_string($conn, $_POST['cnfpassword']);

    $emailquery = "SELECT * FROM users WHERE email='$email'";
    $getemail = mysqli_query($conn,$emailquery);

    if (mysqli_num_rows($getemail) > 0) {
        echo 'email already exists';
    } else {
            $namequery = "SELECT * FROM users WHERE username='$username'";
            $getname = mysqli_query($conn,$namequery);
            if (mysqli_num_rows($getname) > 0) {
                echo 'username already taken';
            } else {
                if($password === $cnfpassword) {
                    $pass = password_hash($password, PASSWORD_BCRYPT);
                    $cnfpass = password_hash($cnfpassword, PASSWORD_BCRYPT);
                    $userquery = "INSERT INTO users (username, email, password, cnfpassword, created_at) VALUES ('$username','$email','$pass','$cnfpass',CURRENT_TIMESTAMP)";
                    mysqli_query($conn,$userquery) or die(mysqli_error($conn));
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'user';
                    header("Location:hello.php");
                } else {
                    echo 'passwords don\'t match';
                }
            }
        } 
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $emailquery = "SELECT * FROM users WHERE email='$email'";
    $getemail = mysqli_query($conn,$emailquery);
    $emaildb = "";
    $passworddb = "";
    $usernamedb = "";
    $useriddb = "";
    if ($getemail->num_rows == 1) {
        while($row = $getemail->fetch_assoc()) {
          $emaildb = $row["email"];
          $passworddb = $row["password"];
          $usernamedb = $row["username"];
          $role = $row["role"];
          $useriddb = $row["id"];
        }
        if (password_verify($password, $passworddb)) {
            $_SESSION['username'] = $usernamedb;
            $_SESSION['userid'] = $useriddb;
            echo $_SESSION['role'] = $role; 
            header("Location:hello.php");
        }
    } else {
        echo 'email doesn\'t exist';
    }
}

if (isset($_POST['newadmin'])) {
    $adminname = mysqli_real_escape_string($conn, $_POST['adminname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cnfpassword = mysqli_real_escape_string($conn, $_POST['cnfpassword']);

    $emailquery = "SELECT * FROM users WHERE email='$email'";
    $getemail = mysqli_query($conn,$emailquery);

    if (mysqli_num_rows($getemail) > 0) {
        echo 'email already exists';
    } 
    else {
        $namequery = "SELECT * FROM users WHERE username='$username'";
        $getname = mysqli_query($conn,$namequery);
        if (mysqli_num_rows($getname) > 0) {
            echo 'username already taken';
        } 
        else {
            if($password === $cnfpassword) {
                $pass = password_hash($password, PASSWORD_BCRYPT);
                $cnfpass = password_hash($cnfpassword, PASSWORD_BCRYPT);
                $userquery = "INSERT INTO users (role, username, email, password, cnfpassword, created_at) VALUES ('admin', '$adminname','$email','$pass','$cnfpass',CURRENT_TIMESTAMP)";
                mysqli_query($conn,$userquery) or die(mysqli_error($conn));
                echo "successfully created new admin";
            } 
            else {
                echo 'passwords don\'t match';
            }
        }
    }  
}

if(isset($_POST['updateadmin'])) {

       if ($_POST['manage'] == 'admin') {
        $sql = "UPDATE users SET role ='admin' WHERE email ='$_POST[admin_email]'";
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
       }
       if ($_POST['manage'] == 'user') {
        $sql = "UPDATE users SET role ='user' WHERE email ='$_POST[admin_email]'";
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
       }
   }


?>