<?php
/**                 Contrôleur budget-echeancier-update
*                           Marc L. Harnist
*						   
*   Date: 20/08/2018					
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

	$echeancier = new Database;
	$ancre = $echeancier->update_table_echeancier('budget_echeancier', $_POST);
	header ('Location: ' . $website->page_url . 'budget-echeancier#' . $ancre . '');