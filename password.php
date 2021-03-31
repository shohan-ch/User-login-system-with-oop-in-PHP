<?php 
 include_once ("class/Session.php");
 include ("class/User.php");
 include ("includes/header.php");
 include ("includes/navbar.php");
?>

<?php 
$id = Session::get("loginId");
$user = new User();
if(isset($_POST['password-btn'])){
    $passChng = $user->passChange($id,$_POST);

}


?>
<div class="container mt-3">
<form action="" method="POST" class="bg-info p-4 text-light" style="width: 500px; margin:0 auto;">
<?php
  if(isset( $passChng)){
   echo  $passChng;


}


?>
<div class="form-group">
    <label for="oldpassword">Old Password</label>
        <input type="password" name="old-password" class="form-control" placeholder="Old Password" id="oldpassword">
    </div>
    <div class="form-group">
    <label for="new-password">New Password</label>
        <input type="password" name="new-password" class="form-control" placeholder="New Password" id="new-password">
    </div>
    <div class="form-group">
    <label for="new-password">Confirm Password</label>
        <input type="password" name="c-password" class="form-control" placeholder="New Password" id="new-password">
    </div>
    <button type="submit" name="password-btn" class="btn btn-primary" >Submit</button>
</form>
</div>


<?php include ("includes/footer.php");?>