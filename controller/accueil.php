<?php

//  15/09/2017 by Marc Harnist

// On demande la dernière page 
include_once('model/get-pages-by-categories.php');
include_once('model/clean-url.php'); // On demande les 1000 derniers pages (modèle)

$pages = getPagesByCategories("news","accueil");// news for home page 'accueil' order by desc

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($pages as $cle => $page) {
    // $pages[$cle]['date'] = nl2br(htmlspecialchars($page['date']));
    $page['title'] = $page['title'];
    $page['text'] = nl2br($page['text']);
	$texte_entier = $page['text'];
	$page['text'] = substr($page['text'], 0, 350); // first caracters only
	$link = False; if($texte_entier != $page['text']) $link = true;
    $page['date'] = date(('d/m/Y'),($page['date']));
	$page['url'] = cleanUrl($page['title']);// function in model/clean-url.php
}
