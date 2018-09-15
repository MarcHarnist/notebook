<?php
/**          Contrôleur budget-cde-cheques.php
*                    Marc L. Harnist
*                         2017
*
*   Mises à jour: 03/08/18, 16/08/18
*   
*   PARTICULARITE
*   Fichier qui récupère les chèques de la Caisse d'Epargne
*   depuis la base de donnée.
*
*   Autorisation limitée au webmaster (cf classe Website)
*/  $website->membersPermissions(1, $member);

$total    = 0;
$database = new Database;//Consultation de la base de donnée
$liste    = $database->read_table('budget_cde_cheques');