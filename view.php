<?php

session_start();

if ($_SESSION['username']) {


include_once 'library.php';  //include common code for all the pages
include_once 'search.php';

$db = new Db_link ("cfconcrcom_smart"); 

head("main");
body();
menu(); //call head function from library.php
 //call body function from library.php
?>
<a class="trick" href=""></a>
<div class="search">               
<table>  <!-- SEARCH FIELD-->
<form method="post" action="">
<tr>
<td></td>
<td></td>
<td></td>
<td>Search by:</td>
</tr>
<tr>
<td>Strict search:</td>
<td><input type="checkbox" name="strict" value="yes" <?php if ($_POST['strict']=="yes") { echo "checked"; } ?> ></td>
<td></td>
<td><select class="src" name="columns">
	<option value="any" <?php if ($column=="any") { echo 'SELECTED'; } ?> >Any</option>
	<option value="name" <?php if ($column=="name") { echo 'SELECTED'; } ?> >Item</option>
	<option value="description" <?php if ($column=="description") { echo 'SELECTED'; } ?> >Description</option>
	<option value="category" <?php if ($column=="category") { echo 'SELECTED'; } ?> >Category</option>
	<option value="model" <?php if ($column=="model") { echo 'SELECTED'; } ?> >Model</option>
	<option value="pack" <?php if ($column=="pack") { echo 'SELECTED'; } ?> >Package</option>
	<option value="qty" <?php if ($column=="qty") { echo 'SELECTED'; } ?> >Quantity</option>
	<option value="supplier" <?php if ($column=="supplier") { echo 'SELECTED'; } ?> >Supplier</option>
	<option value="bar" <?php if ($column=="bar") { echo 'SELECTED'; } ?> >Barcode</option>
	<option value="po" <?php if ($column=="po") { echo 'SELECTED'; } ?> >P.O.</option>
</select></td>
<td><input class="line" type="search" name="search" size="80" value="<?php echo $request; ?>"></td>
</tr>
</form></table>
</div>


<!--ENTRIES TABLE-->

<?php if ($_POST || $_GET) { ?>


<div class="view">
<table id="myTable" class="zebra">
<br>
<thead> 
<tr>
   <th><div><?php if ($_GET['order']=="name_desc") { echo '<a href="view.php?order=name_asc">'; } else  { echo '<a href="view.php?order=name_desc">'; } ?> Item</div></th>
   <th><div><?php if ($_GET['order']=="description_desc") { echo '<a href="view.php?order=description_asc">'; } else  { echo '<a href="view.php?order=description_desc">'; } ?> Description</div></th>
   <th><div><?php if ($_GET['order']=="category_desc") { echo '<a href="view.php?order=category_asc">'; } else  { echo '<a href="view.php?order=category_desc">'; } ?> Category</div></th>
   <th><div><?php if ($_GET['order']=="model_desc") { echo '<a href="view.php?order=model_asc">'; } else  { echo '<a href="view.php?order=model_desc">'; } ?> Model</div></th>
   <th><div><?php if ($_GET['order']=="pack_desc") { echo '<a href="view.php?order=pack_asc">'; } else  { echo '<a href="view.php?order=pack_desc">'; } ?> Package</div></th>
   <th><div><?php if ($_GET['order']=="qty_desc") { echo '<a href="view.php?order=qty_asc">'; } else  { echo '<a href="view.php?order=qty_desc">'; } ?> Quantity</div></th>
   <th><div><?php if ($_GET['order']=="supplier_desc") { echo '<a href="view.php?order=supplier_asc">'; } else  { echo '<a href="view.php?order=supplier_desc">'; } ?> Supplier</div></th>
   <th><div><?php if ($_GET['order']=="bar_desc") { echo '<a href="view.php?order=bar_asc">'; } else  { echo '<a href="view.php?order=bar_desc">'; } ?> Barcode</div></th>
   <th><div><?php if ($_GET['order']=="po_desc") { echo '<a href="view.php?order=po_asc">'; } else  { echo '<a href="view.php?order=po_desc">'; } ?> P.O.</div></th>
   <th><div><a href="#">Action</a></th>
</tr>
</thead> 

<?php
 

if ($_POST['qty']) { 
$sql_query="UPDATE inventory SET qty=".$_POST['qty']." WHERE number=".$_GET['number']."";
$result=$db -> query($sql_query);
$sql_query=$_SESSION['query']; }

if ($_GET['edit']=='qty') {
$sql_query=$_SESSION['query'];
} 

if ($_GET['del'] && !$_POST) {

	$sql_query="DELETE FROM inventory WHERE number=".$_GET['del'].";";
	$result=$db -> query($sql_query);
    $sql_query=$_SESSION['query'];
}

//echo $sql_query."<br>";
//echo $_SESSION['query'];
$result=$db -> query($sql_query);


$numrows=mysqli_num_rows($result);

?> <p align='center'><?php echo $numrows;?> entries found.</p><br><br>

<?php /* echo $sql_query; */

if ($_GET['edit']=='qty' && !$_POST) {

?> <form method="post" action="" name="edit"> <tbody><?php
 
while($row = mysqli_fetch_assoc($result))  //retrieve database entries and put it to a table
 	{ ?>
	    <tr>
		<td><div><?php echo $row['name']; ?></div></td>
		<td><div><?php echo $row['description']; ?></div></td>
		<td><div><?php echo $row['category']; ?></div></td>
        <td><div><?php echo $row['model']; ?></div></td>
		<td><div><?php echo $row['pack']; ?></div></td>
		<td><div><?php if ($row['number']==$_GET['number']) {?> <input type="text" id="qty" name="qty" value=<?php echo $row['qty']; ?>></td> <?php } 
		else { ?><a href="view.php?edit=qty&number=<?php echo $row['number']; ?>"><?php echo $row['qty']; ?></a></td> <?php } ?> </div>
		<td><div><?php echo $row['supplier']; ?></div></td>
		<td><div><?php echo $row['bar']; ?></div></td>
		<td><div><?php echo $row['po']; ?></div></td>
		<?php if ($_GET['todel']==$row['number']) {?>
		<td><div><a href="view.php?del=<?php echo $row['number']; ?>">Are you sure?</a><br>
	 <?php } else { ?>
		<td><div><a class="option" href="view.php?todel=<?php echo $row['number']; ?>&order=<?php echo $_GET['order']; ?>">Delete<br></a><br>
		<a class="edit" href="form.php?edit=<?php echo $row['number']; ?>&order=<?php echo $_GET['order']; ?>">Edit</a></div></td> <?php } ?>
		</tr> 
 	<?php } ?>
 	
 	 
 	 </form>
 	 

<?php }

else {
 
while($row = mysqli_fetch_assoc($result))  //retrieve database entries and put it to a table
 	{ ?>
	    <tr>
		<td><div><?php echo $row['name']; ?></div></td>
		<td><div><?php echo $row['description']; ?></div></td>
		<td><div><?php echo $row['category']; ?></div></td>
        <td><div><?php echo $row['model']; ?></div></td>
		<td><div><?php echo $row['pack']; ?></div></td>
		<td><div><a href="view.php?edit=qty&number=<?php echo $row['number']; ?>&order=<?php echo $_GET['order']; ?>"><?php echo $row['qty']; ?></a><div></td>
		<td><div><?php echo $row['supplier']; ?></div></td>
		<td><div><?php echo $row['bar']; ?></div></td>
		<td><div><?php echo $row['po']; ?></div></td>
		<?php if ($_GET['todel']==$row['number']) {?>
        <td><div><a href="view.php?del=<?php echo $row['number']; ?>">Are you sure?</a><br>
	 <?php } else { ?>
		<td><div><a class="option" href="view.php?todel=<?php echo $row['number']; ?>&order=<?php echo $_GET['order']; ?>">Delete<br></a></div><br>
		<a class="edit" href="form.php?edit=<?php echo $row['number']; ?>&order=<?php echo $_GET['order']; ?>">Edit</a><div></td> <?php } ?>
		</tr> 
 	<?php } 
 	
 	}
?>
</tbody>
</table>
</div>
<div class="footer"></div>
<?php
}  
footer(); //call footer function from library.php

}

else header('Location: login.php');

?>
