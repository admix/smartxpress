<?php  

session_start();

if ($_SESSION['username']=='su') {

include_once 'library.php';
$db = new Db_link ("cfconcrcom_smart");
	
head("main");
body();
menu();	
?>

<div class="admin">
<form method="post" action="">
<table>
<tr><td>New user:</td><td><input type="text" name="login"></td></tr>
<tr><td>New password:</td><td><input type="password" name="new_pass"></td></tr>
<tr><td>Confirm password:</td><td><input type="password" name="conf_pass"></td></tr>
<tr><td>A hint:</td><td><input type="text" name="hint"></td></tr>
<tr><td></td><td><input type="submit"></td></tr>
</table>
</form>
</div>

<?php
footer();


if ($_POST) {

if ($_POST['new_pass']!='' && $_POST['new_pass']==$_POST['conf_pass']) {

$pass=crypt($_POST['new_pass']);

$sql_query="INSERT INTO users VALUES('".$_POST['login']."','".$pass."','user','".$_POST['hint']."');";

$result=$db -> query($sql_query); }

else {?> <div class="hint">Password doesn't match!</div> <?php } 

}

}

else header('location: login.php'); 

?>