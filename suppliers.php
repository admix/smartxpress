<?php 

session_start();

if ($_SESSION['username']) {

include_once 'library.php';
$db = new Db_link ("cfconcrcom_smart"); 
head("main");
body();
menu(); 

?>

<div class="add">
<table> 
<form method="post" action="">
<tr>
<td>Name a supplier:</td>
<td><input type="text" name="sup_name"></td>
</tr>
<tr>
<td>Add contacts:</td>
<td><input type="text" name="sup_con"></td>
</tr>
<tr>
<td>Add notes:</td>
<td><textarea name="sup_notes" cols=15 rows=5></textarea></td>
</tr>
<tr>
<td><input type="submit"></td>
</tr>
</form>
</table>


<?php if ($_POST['sup_name']) { $sql_query="INSERT INTO suppliers values('".$_POST['sup_name']."', '".$_POST['sup_con']."', '".$_POST['sup_notes']."');";

$result=$db -> query($sql_query); }

if ($_POST['del']) { $sql_query="DELETE FROM suppliers WHERE name='".$_POST['del']."';";

$result=$db -> query($sql_query); }

$sql_query="SELECT * FROM suppliers ORDER BY name ASC;";

$result=$db -> query($sql_query);


?>  <br><br><table class="style">
    <form method="post" action=""> 
<?php  $row=array();
$row = mysqli_fetch_array($result);
 for($rows=0; $rows < 15; $rows++) {
 	?> <tr> <?php
 	for($cols=0; $cols < 6; $cols+=10) { ?>
     <td class="style"><input type="radio" name="del" value="<?php echo $row[$rows+$cols]; ?>"></td><td class="style"><?php echo $row[$rows+$cols]; ?><td>
 	}
 	?> </tr>
 <?php }
  ?>
   </table>
   <br><br>
   <input type="submit" value="delete"> 
   </div>
   </form>
<?php 

footer();
   
 } else  header("Location: login.php"); 
 
 ?>