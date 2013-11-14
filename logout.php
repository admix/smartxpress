<?php 
               session_destroy();
               setcookie("PHPSESSID", "", time() - 61200,"/");
               unset($_SESSION);
               Header('Location:login.php'); 
?>