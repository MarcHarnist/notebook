<?php
/**                    Contrôleur budget-calcul.php
*
*  Auteur: Marc L. Harnist
*  Date: 29-07-2018
*  MAJ:  16-08-2018
*  Enregistrement des modifications d'un fichier ouvert en écriture
*/

$website->membersPermissions(1, $member);
	// Réservés aux utilisateurs de niveau 2 et 1 (propriétaire du site et webmaster)
include_once('models/get_echeancier_entries.php');
$datas = get_echeancier_entries();