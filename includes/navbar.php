<?php 
Session::int();
spl_autoload_register(function($classname){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(strpos($url,"includes") == true){
        $path = "../class/";
    include $path.$classname.".php";
    }
});

if(isset($_GET['action']) and $_GET['action'] == "logout"){
    Session::destroy();
}


?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid" style="padding: 0 200px;">
            <a class="navbar-brand" href="#">Login & Register (CRUD) Project</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                 
                <li class="nav-item active">
                    <?php
                    $userEmail =  Session::get('userEmail');
                    if($userEmail){?>
                   
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php?id=<?php echo Session::get("loginId")?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=logout">Logout</a>
                    </li>
                    <?php
                    }else{
                    ?>
                    
                      
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php
                    }
                    
                    ?>


                     
                  
                </ul>

            </div>
        </div>
    </nav>