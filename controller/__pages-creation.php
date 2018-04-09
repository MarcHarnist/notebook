<?php

//  SYSTEME DE NEWS	 13/08/2017 Marc L. Harnist
	$today = date("d/m/Y"); 
	$date_default = $today;

	include_once USER2; // This page reserved for level 1 & 2 users
	
	
/**   On se connecte à la base de donnée grâce à la classe root/class/ReadDatabasePages qui 
/*    elle-même utilise la classe mère Database pour récupérer les identifiants de connexion
/*    On récupère toutes les donnés de la table "light_pages" et on les place dans un array $lire
*/
$lire = new DatabaseRead;	// Traduction: DatabaseReadPges = BaseDeDonnéeLirePages
$lire = $lire->read_database();

$liste=[];
foreach($lire as $categorie){$liste[] = $categorie['category'];}            

$categories = array_unique($liste); // array_unique supprime les doublons dans un array!
