<?php

session_start();


if ($_SESSION['username']) {


include 'library.php'; //Including common code for all the pages
$db = new Db_link ("cfconcrcom_smart"); 


head("main");
body(); //call body function from library.php
menu(); //call head function from library.php

$DataValid = true; //set data valid by default

/*if ($_POST) //check if there any data send through the POST
{

    
         $pattern = '/^ *[a-z ]+ *$/i'; // regexp for letters and spaces only
         preg_match($pattern, trim($_POST['item']), $matches);

         if (!$matches) 
	 {
		$itemErr='Incorrect item';
		$dataValid=false;
	 }

	 if (trim($_POST['item']) == "")  
	 {
                $itemErr = "Error - you must enter the item";
                $dataValid = false;
         }
	 
	 $pattern = '/^ *[a-z -]* *$/i'; // regexp for letters, spaces, and dashes only
         preg_match($pattern, trim($_POST['supplier']), $matches);

         if (!$matches) 
	 {
		$supplierErr='Incorrect supplier';
		$dataValid=false;
         }

         if (trim($_POST['supplier']) == "") 
	 {
                $supplierErr = "Error - you must enter the supplier";
                $dataValid = false;
         }

	 $pattern = "/^ *[a-zA-Z0-9 .,'-]* *$/m";  //regexp for letters, digits, periods, commas, apostrophes, dashes and spaces only (may contain newlines since this is a multiline textarea
         preg_match($pattern, trim($_POST['desc']), $matches);

         if (!$matches) 
	 {
		$descErr='Incorrect description';
		$dataValid=false;
	 }

	 if (trim($_POST['desc']) == "") 
	 {
                $descErr = "Error - you must enter the description";
                $dataValid = false;
         }


         $pattern = '/^ *[0-9]* *$/'; //regexp for digits only
         preg_match($pattern, trim($_POST['onhand']), $matches);

         if (!$matches) 
	 {
		$onhandErr='Incorrect quantity';
		$dataValid=false;
         }

	 if (trim($_POST['onhand']) == "") 
	 {
                $onhandErr = "Error - you must enter the quantity";
                $dataValid = false;
         }


         $pattern = '/^ *[0-9]+ *$/';  //regexp for digits only
         preg_match($pattern, trim($_POST['reorder']), $matches);

         if (!$matches) 
	 {
		$reorderErr='Incorrect amount';
		$dataValid=false;
         }

	 if (trim($_POST['reorder']) == "") 
	 {
                $reorderErr = "Error - you must enter reorder";
                $dataValid = false;
         }
 
         $pattern = '/^ *[0-9]+\.[0-9]{2} *$/';  //regexp for monetary amounts only i.e. one or more digits, then a period, then two digits
         preg_match($pattern, trim($_POST['cost']), $matches);

         if (!$matches) 
         {
		$costErr='Incorrect cost';
		$dataValid=false;
	 } 

         if (trim($_POST['cost']) == "") 
	 {
                $costErr = "Error - you must enter cost";
                $dataValid = false;
         }
         
	 $pattern = '/^ *[0-9]+\.[0-9]{2} *$/'; //regexp for monetary amounts only i.e. one or more digits, then a period, then two digits
         preg_match($pattern, trim($_POST['sprice']), $matches);

         if (!$matches) 
	 {
		$spriceErr='Incorrect price';
		$dataValid=false;
	 }

	 if (trim($_POST['sprice']) == "") 
	 {
                $spriceErr = "Error - you must enter selling price";
                $dataValid = false;
         }

} */


if ($_GET['edit']) {  $sql_query ="SELECT * FROM inventory WHERE number=".$_GET['edit'].";";
  
    $result=$db -> query($sql_query);
    $row = mysqli_fetch_assoc($result);
 }

if ($_POST && $DataValid) //check if sent data through the POST and if data is valid

{
    echo '<div id="message">ITEM ADDED</div>';
    $item=$_POST['item'];
    $category=$_POST['category'];
    $desc=$_POST['desc'];
    $model=$_POST['model'];
    $pack=$_POST['pack'];
    $qty=$_POST['qty'];
    $suppliers=$_POST['suppliers'];
    $barcode=$_POST['barcode'];
    $po=$_POST['po'];


$sql_query = "INSERT INTO inventory VALUES ('', '". $item ."', '" . $desc . "', '" . $category . "', '". $model . "', '". $pack . "', '". $qty . "', '". $suppliers . "', '". $barcode ."', '".$po."')";


if ($_GET['edit']) { $sql_query = "UPDATE inventory SET name='".$item ."', description='".$desc."', category='".$category."', model='".$model."', pack='".$pack."', qty=".$qty.", supplier='".$suppliers."', bar='".$barcode."', po='".$po."'  WHERE number=".$_GET['id'].";"; } 
    echo $sql_query; 
    $result=$db -> query($sql_query);
    $row = mysqli_fetch_assoc($result);
    //header('Location: view.php'); //redirect to view.php after entry is done
}	
?>
<!-- create a form within a table -->
<div class="add">
<form  class="form" method="post" action="">
   <label for="item">Item name:</label><br>
   <input type="text" name="item" value="<?php if ($DataValid==false) echo $_POST['item']; else echo $row['name']; ?>"><br>

   <label for="desc">Description:</label><br>
   <textarea id="styled" name="desc" cols=15 rows=5><?php if ($DataValid==false) echo $_POST['desc']; else echo $row['description']; ?></textarea><br>
   <label for="category">Category:</label><br>
   <select class="form" name="category">
   <option value="choice">Choose...</option>
   <?php $sql_query="SELECT * FROM categories;";
         $result=$db -> query($sql_query);
   
   while($cat = mysqli_fetch_assoc($result)) {?> 
   
   <option value="<?php echo $cat['name'];?>" <?php if ($_POST['category']==$cat['category'] && $DataValid==false) echo 'selected'; else if ($row['category']==$cat['name']) echo 'selected'; ?>><?php echo $cat['name']; ?></option>
   
   <?php } ?>
   </select><br>
    <label for="model">Model:</label><br>
    <input type="text" name="model" value="<?php if ($DataValid==false) echo $_POST['model']; else echo $row['model']; ?>"><br>
  
    <label for="pack">Package type:</label><br>
    <input type="text" name="pack" value="<?php if ($DataValid==false) echo $_POST['pack']; else echo $row['pack']; ?>"><br>
    <label for="qty">Quantity:</label><br>
    <input type="text" name="qty" value="<?php if ($DataValid==false) echo $_POST['qty']; else echo $row['qty']; ?>"><br>
    <label for="suppliers">Supplier:</label><br>
    <select class="form" name="suppliers">
    <option value="choice">Choose...</option>
   
   <?php $sql_query="SELECT * FROM suppliers;";
         $result=$db -> query($sql_query);
   
   while($sup = mysqli_fetch_assoc($result)) {?>

   
   <option value="<?php echo $sup['name'];?>" <?php if ($_POST['suppliers']==$sup['supplier'] && $DataValid==false) echo 'selected'; else if ($row['supplier']==$sup['name']) echo 'selected'; ?>><?php echo $sup['name']; ?></option>
   
   <?php } ?>
   </select><br>
  
   <label for="po">P.O.:</label><br>
   <input type="text" name="po" value="<?php if ($DataValid==false) echo $_POST['po']; else echo $row['po']; ?>"><br>
   <label for="barcode">Barcode:</label><br>
   <input type="text" name="barcode" value="<?php if ($DataValid==false) echo $_POST['bar']; else echo $row['bar']; ?>">
<br>
<div id="!lower"> 
<input type="submit" value="Submit"><br>

</div>
</form></div> <?php 
footer(); //call footer function from library.php
echo $sql_query;


} else header('Location: login.php');

?>


