<?php
/** INDEX WHICH DISPLAY FILES OF DIRECTORY **/

// General title for all index
$title ="Index";

// Include header	
$www_real_path = "/home/marcharnss/www";   //for includes  
if($_SERVER['HTTP_HOST'] == 'localhost'){    // we are on WAMP
  $www_real_path = "C:\wamp64\www\marcharnist"; //for includes
}
include($www_real_path.'/private/inc/header.php');
?>
<!-- Fin de l'entête ---------->

<!-- PAGE -->
<?php

$file = $www_real_path.'/private/inc/motor_index.php';
if(file_exists($file)){
	include($file);
}	  
else {
	  echo '<h4>Le fichier "' . $file . '" est introuvable.</h4>';
}
?>
<!-- Pied de page ------------------------------>
<?php include($www_real_path.'/private/inc/footer.php');?>