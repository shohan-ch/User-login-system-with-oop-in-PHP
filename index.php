<?php 
 include_once ("class/Session.php");
 include ("class/User.php");
 include ("includes/header.php");
 include ("includes/navbar.php");
 Session::checkSession("userEmail");
?>

<?php 
$user = new User();

$result = $user->getUser();

?>

  <div class="container mt-4">
      <div>
      <h4 style="display: inline">User List</h4>
      <h4  class="float-right"> <?php echo Session::get("userName")?></h4>

      <?php
        $msg = Session::get("success");
        if(isset($msg)){
          echo $msg;
        }
        Session::set("success",null);

      ?>

      </div>
      
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $i = 0;
      
      foreach ($result as $row){
          $i++;
          ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['name'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <td><?php echo $row['status'] ?></td>
      <td><a href="view.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">View</a></td>
    </tr>
    <?php

}

?>
  </tbody>
</table>

  </div>














<?php 
include ("includes/footer.php");


?>