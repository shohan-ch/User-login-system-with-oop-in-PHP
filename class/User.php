<?php
include_once ("Session.php");
include ("Dbh.php");

class User{

    public $conn;
    public function __construct()
    {
        $this->conn  = new Dbh();
    }
    public function setRegister($data){
        $name =  $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $status  =  $data['status'];
        $emailCheck = $this->emailCheck($email);

        if(empty($name) or empty($email) or empty($password) or empty($status)){
             $error = "All Field is require";
             return $error;
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

            $error = "Invalid Email";
            return $error;
        }
        elseif(strlen($password)<6){
            return "Password should be more than 6 character";
            
        }
        elseif(!preg_match("/^[a-zA-Z]{4,5}$/",$status)){
            $error = "Status should be admin or user";
            return $error;

        }
        elseif($emailCheck==true){
            $error = "Email id is exsits.Please choose new email";
            return $error;
        }
        $sql = "INSERT INTO user(name,email,password,status)VALUES(?,?,?,?);";
        $stmt =  $this->conn->conn->prepare($sql);
        $result  = $stmt->execute([$name,$email,$password,$status]);
        if($result == true){
        return "Registered Successfully";  
        }else{
            return "Registered Error";  
        } 
    }

    private function emailCheck($email){
        $sql = "SELECT email FROM user WHERE email =?";
        $stmt =  $this->conn->conn->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }else{

            return false;
        }


    }
    public function getUser(){
        $sql = "SELECT * FROM user ORDER BY id DESC";
        $stmt =  $this->conn->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;       
    }

    public function registerView($id){
        $sql = "SELECT * FROM user WHERE id =?";
        $stmt =  $this->conn->conn->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }



    public function updateRegister($id,$data){
        $name =  $data['name'];
        $email = $data['email'];
        $status  =  $data['status'];
        $checkEmail = $this->emailCheck($email);

        if(empty($name) or empty($email) or empty($status)){
            $error = "All Field is require";
            return $error;
       }
       elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

           $error = "Invalid Email";
           return $error;
       }

       elseif($checkEmail == true){
           return "Email is exists. Choose another email!";

       }
       $sql = "UPDATE user SET name = ?, email = ?, status = ? WHERE id = ? ;";
       $stmt =  $this->conn->conn->prepare($sql);
       $result  = $stmt->execute([$name,$email,$status,$id]);
       if($result == true){
       Session::int();
       Session::set("success","<p class='bg-dark p-2 text-center text-light'>Update succesfully!</p>");
       header("Location:index.php");
    
       }else{
           return "Update Error";  
       } 

    }


    public function loginUser($data){
        $email = $data['email'];
        $password = $data['password'];
        $checkEmail = $this->emailCheck($email);
        if(empty($email) or empty($password)){
            $error = "All Field is require";
            return $error;
       }
       elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           $error = "Invalid Email";
           return $error;
       }
       elseif($checkEmail==false){
           return"Email doesn't match";

       }
        $sql = "SELECT * FROM user WHERE email =? And password = ?";
        $stmt =  $this->conn->conn->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if($result){
        Session::int();
        Session::set("login",true);
        Session::set("userEmail",$email);
        Session::set("userName",$result->name);
        Session::set("loginId",$result->id);
        header("Location:index.php");
        exit();
        }else{
            return "Invalid username or password";

        }
           
    }

    public function passChange($id,$data){
        $oldPass = $data['old-password'];
        $newPass = $data['new-password'];
        $conPass = $data['c-password'];
        $checkPass =  $this->passMatch($id,$oldPass);

       if(empty($oldPass) or empty($newPass)  or empty($conPass)){
        return "<p class='bg-dark p-2 text-center text-light'>Password field should not be empty.</p>";

       }
       if($checkPass==false){
           return "<p class='bg-dark p-2 text-center text-light'>Old password does not match</p>";
       }
       if(strlen($newPass) < 6){
        return "<p class='bg-dark p-2 text-center text-light'>Password must be 6 characters.</p>";

       }
       if($newPass !== $conPass){
        return "<p class='bg-dark p-2 text-center text-light'>Password Does not match.</p>";
       }
       $sql = "UPDATE user SET password = ? WHERE id = ? ;";
       $stmt =  $this->conn->conn->prepare($sql);
       $result  = $stmt->execute([$conPass,$id]);
       if($result){
           return "<p class='bg-dark p-2 text-center text-light'>Password update successfully</p>";
           
       }




    }
    
    private function passMatch($id,$oldPass){

        $sql =  "SELECT password FROM user WHERE id =? AND password = ?";
        $stmt = $this->conn->conn->prepare($sql);
        $stmt->execute([$id,$oldPass]);     
        if($stmt->rowCount()>0){
            return true;
        }else{
            return false;
        }

    }







 
}


