<?php
class Session{

    public static function int(){
        session_start();

    }
    public static function set($name,$value){
        $_SESSION[$name] = $value;
    }

    public static function get($name){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }else{
            return false;
        }
    }
    public static function checkSession($name){
        $session = self::get($name);
        if(!$session){
            header("location:login.php");
        }
    }
    public static function loginPageSession($name){
        $session = self::get($name);
        if($session){
            header("Location:index.php");
        }
            
    }
    public static function destroy(){
        session_destroy();
        session_unset();
        header("Location:login.php");
    }




}
