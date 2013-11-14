<!-- INT322B
   DMITRY YASTREMSKIY
   04.03.2013
   

  Student Declaration

  I declare that the attached assignment is my own work in accordance with Seneca Academic Policy.
  No part of this assignment has been copied manually or electronically from any other source
  (including web sites) or distributed to other students.

  DMITRY YASTREMSKIY
  ID: 066396110
-->


<?php

include 'library.php'; //include common code for all the pages

$id=$_GET['id'];

if ($_GET['act']=="del") //Check if sent command DELETE through the GET
{ 

    $sql_query = "UPDATE inventory SET deleted='y' WHERE id='$id'"; //change flag to y

    $result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));


    header ('Location: view.php');

}

if ($_GET['act']=="res")   //Check if sent command RESTORE through the GET 
{ 

    $sql_query = "UPDATE inventory SET deleted='n' WHERE id='$id'"; //change flag to n

    $result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));


    header ('Location: view.php');

}

?>