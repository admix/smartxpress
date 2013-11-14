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
<table class="zebra"> 
<form method="post" action="">
<tr>
<td>Name a category:</td>
<td><input type="text" name="cat_name"></td>
<td><input type="submit"></td>
</tr>
</form>
</table>


<?php if ($_POST['cat_name']) { $sql_query="INSERT INTO categories values('".$_POST['cat_name']."');";

$result=$db -> query($sql_query); }

if ($_POST['del']) { $sql_query="DELETE FROM categories WHERE name='".$_POST['del']."';";

$result=$db -> query($sql_query); }

$sql_query="SELECT * FROM categories;";

$result=$db -> query($sql_query);


?>  <br><br><table class="style">
    <form method="post" action=""> 
<?php while($row = mysqli_fetch_assoc($result)) {?>
   <tr><td class="style"><input type="radio" name="del" value="<?php echo $row['name']; ?>"></td><td class="style"><?php echo $row['name']; ?></td></tr>
   <?php } ?>
   </table>
   <br><br>
   <input type="submit" value="delete"> 
   </div>
   </form>
<?php 




footer();
   
 } else header('Location: login.php');
 
 ?>