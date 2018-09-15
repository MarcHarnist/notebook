<?php
/**        Contrôleur budget-rules
*             Marc L. Harnist
*                  2017
*
*   MAJ: 16/08/18
*   Perfectionnement de la méthode read_table()
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

	$database = new Database;
	$rules = $database->read_table("budget_rules");
	
	// Security on datas: id, date, auteur, rule
	foreach($rules as $cle => $rule) {
		$rules[$cle]['auteur'] = htmlspecialchars($rule['auteur']);
		$rules[$cle]['rule'] = nl2br($rule['rule']);
	}