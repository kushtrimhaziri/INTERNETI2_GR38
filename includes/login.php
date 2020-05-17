
<?php session_start();
      include "db.php";
      include "../admin/functions.php";


    ?>
<?php
if (isset($_POST['login'])){

    login_user($_POST['username'],$_POST['password']);

    $username=$_POST['username'];
    $password=$_POST['password'];



}
















?>
