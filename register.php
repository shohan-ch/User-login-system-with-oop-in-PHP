<?php include ("class/User.php");?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navbar.php");?>

<?php 
 $user = new User();
 if(isset($_POST['register-btn'])){
     $userregister = $user->setRegister($_POST);


 }


?>

<div class="container mt-4">

    <form action="" method="POST"
        style="width: 650px;margin:0 auto;background-color: #6c757d;padding: 68px;color: #fff;">
        <?php
        if(isset($userregister)){
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $userregister;?>
        </div>
        <?php 
        }?>
        <h3>User Registration</h3>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" id="name">
            <small class="text-danger"></small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email Id" id="email">
            <small class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" id="password">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" placeholder="Status" id="status">
        </div>

        <button type="submit" name="register-btn" class="btn btn-primary">Register</button>

    </form>


</div>



<?php include ("includes/footer.php");?>