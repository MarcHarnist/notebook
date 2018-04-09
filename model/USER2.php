
<?php

// This file follows www/inc/user.php required in www/index.php

$editor = False;
// var_dump($_SESSION['member']);die;
// Redirect to home page if not enough permission (1 = webmaster, 2 = owner)
if(isset($_SESSION['member']) && isset($level)) {
	if($level > 2) {
		header('Location: '.WEBSITE_URL);// member online but not enough permission
	} else $editor = True;
} else header('Location: '.WEBSITE_URL); // No session open, no member online
