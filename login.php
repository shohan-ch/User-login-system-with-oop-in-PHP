<?php
 include_once ("class/Session.php");
 include ("class/User.php");
?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navbar.php");
Session::loginPageSession("userEmail");

?>

<?php 
$user =  new User();
if(isset($_POST["login-btn"])){
   $userLogin = $user->loginUser($_POST);
}


?>

<div class="container mt-4">

    <form action="" method="POST" style="width: 650px;margin:0 auto;background-color: #530c54;padding: 68px;color: #fff;">
    <h3>User Login</h3>
    <?php
        if(isset($userLogin)){
        ?>
        <div class="alert alert-danger" role="alert">
            <?php
             echo $userLogin;
           
             ?>
        </div>
        <?php 
        }?>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email Id" id="email">
        <small class="text-danger"></small>
    </div>
    <div class="form-group">
    <label for="password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" id="password">
    </div>
   
     <button type="submit" name="login-btn" class="btn btn-primary">Login</button>

    </form> 


</div>



<?php include ("includes/footer.php");?>