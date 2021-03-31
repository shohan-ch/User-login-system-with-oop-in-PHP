<?php
 include_once ("class/Session.php");
 include ("class/User.php");?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navbar.php");?>

<?php 

Session::checkSession("userEmail");
 $user = new User();
 $userid = $_GET['id'];
 if(isset($userid)){
     $result = $user->registerView($userid);
 }

 if(isset($_POST['update-btn'])){
     $userregister = $user->updateRegister($userid,$_POST);

 }


?>

<div class="container mt-4">

    <form action="" method="POST" style="width: 650px;margin:0 auto;background-color: #163e60;padding: 68px;color: #fff;">
        <?php
        if(isset($userregister)){
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $userregister;?>
        </div>
        <?php 
        }?>
        <h3>Update Registration</h3>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" id="name" value="<?php echo $result->name; ?>">
            <small class="text-danger"></small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email Id" id="email" value="<?php echo $result->email; ?>">
            <small class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" placeholder="Status" id="status" value="<?php echo $result->status; ?>">
        </div>
        <?php 
        if($userid==Session::get("loginId")){
            ?>
             <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" placeholder="Password" id="password" value="<?php echo $result->password; ?>">
        </div>
            <button type="submit" name="update-btn" class="btn btn-success float-right">Update</button>
            <a href="index.php" class="btn btn-danger">Cancel</a>
            <a href="password.php" name="update-btn" class="btn btn-success mt-3 d-block w-50">Change Password</a>
        <?php
        }else{
            ?>
    
        <a href="index.php" class="btn btn-danger">Cancel</a>

        <?php
        }  
        ?>
        

        
       
        


    </form>


</div>



<?php include ("includes/footer.php");?>