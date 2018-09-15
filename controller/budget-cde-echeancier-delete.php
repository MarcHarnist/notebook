<?php
/**     Controller budget-cde-echeancier-delete
*                  Marc L. Harnist
*                    17/08/2018
*
*   MAJ 27/08/18 correction des redirections
*   $member = objet avec tous les attributs du membre connecté
*   1 = Accès limité au webmaster ($member->level() = 1
*/  $website->membersPermissions(1, $member);

/** Connexion à la base de donnée avec accès à toutes les méthodes utiles
*
*/  $database = new Database;

// Have we confirm delete ?
if(isset($_POST['confirm'])) {
	$database = $database->budget_cde_echeancier("delete", $_POST);
	$url= $website->page_url . 'budget-cde-echeancier#' . $database['ancre'];
	header("Location:$url");}
else {
	$database = $database->budget_cde_echeancier("select", $_POST);
	$url_de_retour_en_arriere = $website->page_url . 'budget-cde-echeancier#' . $database['ancre'];}