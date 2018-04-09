<?php

// On demande toutes les pages qui ont une categorie "new"
include_once('model/get-pages-by-categories.php');
include_once('model/clean-url.php'); // On demande les 1000 derniers pages (modèle)

$category = "news"; // default value: fonction default value doesn't work

// $_GET comes from inc/header/<nav>links</nav>
if(isset($_GET['categorie'])) $category = htmlspecialchars($_GET['categorie']);

// model/get-pages-by-categories function called above
$pages = getPagesByCategories($category, "");
$ugly = [' ', "'", "_"];

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($pages as $cle => $entry)
{
    $pages[$cle]['titre'] = htmlspecialchars($entry['title']);
    $pages[$cle]['text'] = nl2br(htmlspecialchars($entry['text']));
	$texte_entier = $pages[$cle]['text'];
    $pages[$cle]['text'] = substr($entry['text'], 0, 200);
	$pages[$cle]['link'] = False;
	if($texte_entier !== $pages[$cle]['text']) $pages[$cle]['link'] = true;
    $pages[$cle]['date'] = date(('d/m/Y'),($entry['date']));
	$pages[$cle]['url'] = cleanUrl($entry['title']);// function in model/clean-url.php
}