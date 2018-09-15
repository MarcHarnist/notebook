<?php
/**         CONTROLEUR
*
*        budget-cheques.php
*
*          Marc L. Harnist
*
*   Création: 2017
*   Mises à jour: 03/08/18, 16/08/18
*   
*          PARTICULARITE
*   <nav> of header & footer: display: none dans fichier css
*   budget-cheques.css
*   Fichier qui récupère les chèques de la BNP depuis la base
*   de donnée.
*
*   Autorisation limitée au webmaster (cf classe Website)
*/  $website->membersPermissions(1, $member);

    $total = 0;
	$database = new Database;
	$liste = $database->read_table('budget_cheques');