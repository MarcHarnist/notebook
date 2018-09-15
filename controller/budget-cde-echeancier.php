<?php
/**           budget-cde-echeancier.php
*
*    Auteur: Marc L. Harnist
*    Mise à jour: 03/08/2018
*    Particularité: échéancier de la caisse d'épargne
*
*    Autorisation limitée au webmaster
*/   $website->membersPermissions(1, $member);

$database = new Database;
$echeancier  = $database->read_table("budget_cde_echeancier");