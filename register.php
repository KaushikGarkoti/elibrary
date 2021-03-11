<?php session_start(); ?>
<?php include 'header.php';?>
<?php include 'navbar.php'?>

<div class='container'>
    <div class='row'>
        <h2>Welcome to Library</h2>
        <div class='col s12'>
            <h6 class='left-align'>Sign-up</h6>
            <form action="./userservice.php" method="POST">
                <div class='row custom-row'>
                <div class='col s12 input-field'>
                        <input type="text" id='username' name='username' placeholder='username'>
                        <label for='username'>Username</label>
                    </div>
                    <div class='col s12 input-field'>
                        <input type="text" id='email' name='email' placeholder='email'>
                        <label for='email'>Email</label>
                    </div>
                    <div class='col s12 input-field'>
                        <input type="password" id='password' name='password' placeholder='password'>
                        <label for='password'>password</label>
                    </div>
                    <div class='col s12 input-field'>
                        <input type="password" id='cnfpassword' name='cnfpassword' placeholder='confirm password'>
                        <label for='cnfpassword'>password</label>
                    </div>
                    <button type='submit' class='btn waves-effect waves-light' name='signup'>Sign-up</button>
                </div>
            </form>
        </div>
    </div>
</div>