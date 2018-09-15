<?php
/**           budget-echeancier.php
*
*    Auteur: Marc L. Harnist
*    Mise à jour: 03/08/2018
*    Particularité: <nav> of header & footer: display: none
*    dans css/budget-echeancier.css
*
*    Autorisation limitée au webmaster
*/   $website->membersPermissions(1, $member);

$database = new Database;
$echeancier  = $database->read_table("budget_echeancier");