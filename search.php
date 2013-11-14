<?php 

if (!$_GET) {

	$_SESSION["request"]="";
	$_SESSION["column"]="";
	
	} 

if ($_POST) { 
$request=$_POST['search'];
}



if ($_POST['columns']=='number' || $_POST['columns']=='qty') { // search conditions

	if ($_POST['strict']=='yes') { $condition="= ".$request.""; }

	else $condition="LIKE '".$request."'"; 

}



else {

	if ($_POST['strict']=='yes') { $condition="= '".$request."'"; }

	else $condition="LIKE '%".$request."%'";

}  // end of search conditions

if ($_POST['columns']) { $column=$_POST['columns']; }

//else $column="number";

$where="WHERE ".$column."";

if ($_POST['columns']=='any' && $request!="" || $column=='any' && $request!="") {

$where="WHERE concat(name,description,category,model,pack,qty,supplier,bar,po)";
	
}

//$order="ORDER BY number ASC";

 if ($_POST) {

$_SESSION["condition"]=$condition;
$_SESSION["where"]=$where;
$_SESSION["request"]=$request;
$_SESSION["column"]=$column;

} 

if ($_GET && !$_POST) {


$condition=$_SESSION["condition"];

$where=$_SESSION["where"];

$request=$_SESSION["request"];

$column=$_SESSION["column"];

if ($_GET["order"]) { $key = explode("_", $_GET["order"]);

$order="ORDER BY ".$key[0]." ".$key[1].""; } 

} 

if ($_POST['search']) {

$order="";
} 

//echo $where;
//echo $condition;

if ($request=="") { $condition=""; $where=""; } // if request is empty, then no conditions


$sql_query="SELECT * FROM inventory ".$where." ".$condition." ".$order."";

//echo $sql_query;

if ($request=="empty") { $sql_query = "SELECT * FROM inventory ".$where." IS NULL ORDER BY number ASC";}
if ($request=="unique") { $sql_query = "SELECT DISTINCT ".$column." FROM inventory;";}

if ($_POST['search'] || $_GET['order']) { $_SESSION["query"]=$sql_query; }





?>
