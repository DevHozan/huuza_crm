<?php 

if(isset($_POST['login'])){

    $password=$_POST['Password'];
   
    $email=$_POST['Email'];

    

    !$usermanager->login($email, $password);
}
?>