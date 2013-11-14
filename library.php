
<?php 

function head($page)  //Function to add header html tags
{ ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    
    <?php 
          if ($page=="main") { ?>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript" src="js/view.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script> <?php }

          if ($page=="login") { ?>

    <script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/login.css"> <?php } ?>
    
    <title>Inventory</title>
    </head>

<?php }


function body() //Function to add body common html tags
{  ?>

    <body>
    
<?php }

function menu() { ?>
<div class="fixed">
<ul class="menu">
<li><a href="form.php">Add items</a>
<ul>
<li><a href="#suppliers.php">Add supplier</a></li>
<li><a href="#categories.php">Add category</a></li>
</ul></li>
<li><a href="view.php">View Items</a></li>
<?php if ($_SESSION['username']=='admin') {?> <li><a href="admin.php">Admin Menu</a></li> <?php } ?>
<?php if ($_SESSION['username']=='su') {?> <li><a href="su.php">SU Menu</a></li> <?php } ?>
<li><a href="hints.php">Help</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<?php }



function footer() //Function to add footer html tags
{ ?>
    </body>
    </html>
<?php }


class Db_link {

  private $link;
  private $result;
  public function __construct ($database_name) {
   $link = mysqli_connect ("localhost", "cfconcrcom_smart", "Pass4smart", $database_name) or die('Could not connect: ' . mysqli_error($link));
   $this -> link = $link;
   }

public function query($sql_query) {

   $result = mysqli_query($this -> link, $sql_query) or die('query failed'. mysqli_error($this->link));
   return $result;
   }

public function prevent($request) {

   $request=mysqli_real_escape_string($this -> link, $request);
   $request=htmlentities($request);
   return $request;
   }

public  function __destruct() {
   mysqli_close ($this -> link);
   }

}
?>
