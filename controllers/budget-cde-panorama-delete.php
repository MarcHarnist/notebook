<?php
/**     Contrôleur Budget-cde-panorama-delete
*               Marc L. Harnist
*
* Date: 21/08/2018
* Particularité: Prépare l'affichage du panorama de la caisse
* d'épargne.
*
*       MISES A JOURS
*   16/08/18 suppression rooter
*   17/08/18 new object Database */

/** Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

/** Connexion à la base de donnée
*/  $database = new Database;

/** Déclaration des variables
*/  $ancre = $confirm = $id = "";

// Je récupère les données du formulaire
if(isset($_POST['confirm'])) $confirm = $_POST['confirm'];

// Have we confirm delete ?
if($confirm == "oui") {
	$database = $database->budget_cde_panorama("delete", $_POST);
	$url= $website->page_url . 'budget-cde-panorama#' . $database['ancre']; //$id est l'ancre de retour...
	header("Location:$url");
}
else {
	$database = $database->budget_cde_panorama("select", $_POST);
	$id = $database['id'];
	$date = $database['date'];
	$ancre = $database['ancre'];
	$url_de_retour_en_arriere = $website->page_url . 'budget-cde-panorama#' . $ancre;
} // Close else on line 41.