<?php
include_once('library.php');

session_start();
head("main");
body();
menu();

if ($_SESSION['username']) { ?>
<div class="hint">
<p> To search all the empty fields - type "empty" is search field. </p>
<p> To search the exact entry - check off the checkbox. </p>
<p> To search the approximate entry - enter any possible combinations. </p>
<p> To search all the entries - just press enter on empty search field. </p>
</div>
<?php 
footer();
}

else header('Location: login.php');

?>