<?php

// On demande toutes les pages qui ont une categorie "new"
$category = "news"; // default value: fonction default value doesn't work

$editor_display = False;

// $_GET comes from inc/header/<nav>links</nav>
if(isset($_GET['categorie'])) $category = htmlspecialchars($_GET['categorie']);

$read = new Database;	// POO! $lire = array() qui contient toute la table des pages
	$pages = $read->getPagesByCategories($category, '', 300);
	// Méthode qui liste les catégories existantes dans les pages
	//     Paratmetres: catégorie, page (exemple: accueil), nombres de caractères pour l'extrait

//User rights for edition
if(isset($member) && $member->level <= 2)
	$editor_display = True; //User has enough permissions ?>

