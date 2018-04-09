<?php

/****************************************************************
*
*		SYSTEME D'EDITION DE PAGES   13/08/2017 ML-Harnist
*
******************************************************************/

/** CE QU'ON POURRAIT AMELIORER...
*   Dans ce fichier, nous allons lire deux fois la base de donnée
*   1. grâce au root/model/get-all-pages.php
*   2. grâce à la root/class/DatabaseRead.php
*   N'utiliser que root/class/DatabaseRead.php serait idéal...
*/

include USER2;

include_once('model/get-all-pages.php'); // Get all pages
$pages = get_all_pages(); // All pages in $pages array

// Displaying in security: controller's job
foreach($pages as $cle => $page){
    $pages[$cle]['title'] = htmlspecialchars($page['title']);
    $pages[$cle]['date'] = date('d/m/Y', $page['date']);
}

/**   On se connecte à la base de donnée grâce à la classe root/class/ReadDatabasePages qui 
/*    elle-même utilise la classe mère Database pour récupérer les identifiants de connexion
/*    On récupère toutes les donnés de la table "light_pages" et on les place dans un array $lire
*/
$lire = new DatabaseRead;	// Traduction: DatabaseReadPges = BaseDeDonnéeLirePages
$lire = $lire->read_database();

$liste=[];
foreach($lire as $categorie){$liste[] = $categorie['category'];}            

$categories = array_unique($liste); // array_unique supprime les doublons dans un array!

					
// Si une image a été uploadé / if an image has been uploaded
if(isset($_GET['image'])){
	$image = $_GET['image'];
	$image = '<img src="' . IMG_URL . $image . '" alt="">';
}