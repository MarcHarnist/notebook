<?php
/**     Controller budget-echeancier-delete
*               Marc L. Harnist
*                 26/07/2017
*
*   MAJ 27/08/18 suppression déclaration variables (déjà dans la classe)
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

/** Connexion à la base de donnée
*
*/  $database = new Database;

// Have we confirm delete ?
if(isset($_POST['confirm'])) {
    $database = $database->budget_echeancier("delete", $_POST);
    $url= $website->page_url . 'budget-echeancier#' . $database['ancre'];
    header("Location:$url");}
else {
    $database = $database->budget_echeancier("select", $_POST);
    $url_de_retour_en_arriere = $website->page_url . 'budget-echeancier#' . $database['ancre'];}