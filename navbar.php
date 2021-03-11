<?php 
session_start();
?>
<header>
    <nav>
        <div class="nav-wrapper custom-nav center-align" style = "background-color: #B6C9A3">
            <div class="hide-on-med-and-down" style="margin-left:1rem">
                <a href = "hello.php" class="left">HOME</a>
            </div>
            <a href="hello.php" class="brand-logo">E-library</a>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php 
                    
                    if(!isset($_SESSION['username'])) {
                        echo "
                        <li><a href='login.php'>Login</a></li>
                        <li><a href='register.php'>Sign-up</a></li>";
                    }
                    
                    if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
                        echo "<li><a href='logout.php'>Logout</a></li>
                        <li><a href='controlpanel.php'>Control Panel</a></li>";
                    } else if (isset($_SESSION['username']) && $_SESSION['role'] == 'user') {
                        echo "<li><a href='logout.php'>Logout</a></li>";
                    }
                       
                    ?>
            </ul>
            </div>
            <ul id="slide-out" class="sidenav">
                <li>
                    <div class="user-view">
                        <div class="background">
                        <img src="images/kourosh-qaffari-RrhhzitYizg-unsplash.jpg">
                        </div>
                        <a href="#user"><img class="circle" src="images/IMG_20201011_164851_4.jpg"></a>
                        <a href="#name"><span class="name"><?php echo $_SESSION['username'] ?></span></a>
                        <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
                    </div>  
                </li>
                <li><a href="logout.php"><i class="material-icons">logout</i>Logout</a></li>
                <li><a href="hello.php"><i class="material-icons">books</i>Home</a></li>
                <li><div class="divider"></div></li>
                <? if($_SESSION['role'] == 'admin') { 
                echo "<li><a class='subheader'>Admin Options</a></li>
                <li><a href='./controlpanel.php'><i class='material-icons'>admin_panel_settings</i>Control Panel</a></li>"; }?>
            </ul>
        </div>
    </nav>
</header>