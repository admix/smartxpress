<?php


session_start();


if ($_SESSION['username']) {

header ('location: view.php'); }

else {

include 'library.php';
$db = new Db_link ("cfconcrcom_smart"); 
head("login");
body();
 

 if ($_POST['login']) { // check login and password matches with db

$access=false;
$enabled=false;

$sql_query = "SELECT * FROM users";

$result=$db -> query($sql_query);

while($row = mysqli_fetch_assoc($result))  
 	{   
           	
           $salt=substr($row['password'], 0, 11);
           if ($row['username']==$_POST['login']) {
                if ($row['password']==crypt($_POST['pass'], $salt)) {
                     $access=true; $role=$row['role'];
                     if ($access==true && $row['status']==1) {
                           $enabled=true;
                     }
                } 
            }   

     } 

if ($enabled==true) { //execute user session if credentials are valid
            
            setcookie('role',"$role", time()+60*60*24);
		    $_SESSION['username']=$_POST['login'];		
	        header('Location: view.php'); }

 }  ?>  

<div id="container">
<div id="logo"><img src="images/logo.jpg"></div>
	<form method="POST" action="">

			<label for="name">Username:</label>
			<input type="name" id="login" name="login" value="<?php echo $_POST['login']; ?>">
			
		    <label for="pass">Password:</label>
            <p><a href="#">Forgot your password?</a></p>
			<td><input type="password"  id="pass" name="pass" value="<?php echo $_POST['pass']; ?>"></td>

		    <div id="lower">
		    	<div id="message">
		    	<?php
		    	      if ($_POST && $access==true && $enabled==false) { ?> Your account is disabled.<?php }
                      if ($_POST && $access==false) { ?> Login or password is invalid!<?php } ?>
              </div>
		 	<input type="submit" value="login">
		    </div>
		

		    	
                     
</form>
</div>

<?php footer(); }?>
