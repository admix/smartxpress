<?php  

session_start();

if ($_SESSION['username']=='su') {

include_once 'library.php';
$db = new Db_link ("cfconcrcom_smart");
	
head("main");
body();
menu();	


if ($_POST) {

if ($_POST['login']) {

if ($_POST['new_pass']!='' && $_POST['new_pass']==$_POST['conf_pass']) {

$pass=crypt($_POST['new_pass']);

$sql_query="INSERT INTO users VALUES('".$_POST['login']."','".$pass."','user','".$_POST['hint']."','1');";

$result=$db -> query($sql_query); }

else {?> <div class="hint">Password doesn't match!</div> <?php } 

}

if ($_POST['user']) {
       
		$sql_query="DELETE FROM users WHERE username='".$_POST['user']."';";
		$result=$db -> query($sql_query);
	}

}

$sql_query="SELECT * FROM users";
$result=$db -> query($sql_query);
  
?> 
<form method="post" style="position:absolute;margin-top: 100px;margin-left: 100px;text-align: right;">
<table border=1> 
   <tr><th>Pick:</th><th>User:</th><th>Role:</th><th>Status:</th></tr>
<?php 

while($row = mysqli_fetch_assoc($result))  //retrieve database entries and put it to a table
 	{ ?>
	    <tr>
	    <td><input type="radio" name="user" value="<?php echo $row['username']; ?>"></td>	
		<td><div><?php echo $row['username']; ?></div></td>
		<td><div><?php echo $row['role']; ?></div></td>
		<td><div><?php echo $row['status']; ?></div></td>
		</tr>

		<?php } ?>
</table>
<input type="submit" name="del" value="delete">
</form>


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



}

else header('location: login.php'); 

?>