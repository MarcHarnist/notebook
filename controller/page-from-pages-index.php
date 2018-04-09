<?php
include_once('model/get-one-page.php');

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($pages as $page)
{
    $page['title'] = htmlspecialchars($page['title']);
    $page['text'] = nl2br($page['text']);
    $page['date'] = date(('d/m/Y'),($page['date']));
}

//Title for the head
$title = cleanPageName($page['title']); // function in model/page.php

// include_once USER;

if(isset($_SESSION['member']) && isset($level)) {
	if($level > 2) {
		$editor = False;
	} else $editor = True;
}
