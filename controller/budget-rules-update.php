<?php


//////////////////////////////////////////////////////////////////////////////////////////
//
//  J'AI FRABRIQUE UNE PAGE POUR TRAITER L'OBJET DU BUDGET EN LANGAGE PHP
//  M. Harnist 14 Juillet 2017 
//
//////////////////////////////////////////////////////////////////////////////////////////

/** 
*   MAJ: 16/08/18 POO
*/

$website->membersPermissions(1, $member);

$operation = $id = $rule_id = $date = $auteur = $rule = 0; 

// Je récupère les données du formulaire

//$operation: creation? Updating? Delete?
if(ISSET($_POST['operation'])){
  $operation=htmlspecialchars($_POST['operation']);
}
// Je récupère les données du formulaire
if(ISSET($_POST['ancre']))
{//L'ancre pour le lien de retour à la ligne.
  $ancre=$_POST['ancre']-5;
}
if(ISSET($_POST['id'])){
  $id=htmlspecialchars($_POST['id']);
}
if(ISSET($_POST['rule_id'])){
$rule_id=htmlspecialchars($_POST['rule_id']);
}
if(ISSET($_POST['date'])){
$date=htmlspecialchars($_POST['date']);
}
if(ISSET($_POST['auteur'])){
$auteur=htmlspecialchars($_POST['auteur']);
}
if(ISSET($_POST['rule'])){
// $rule=htmlspecialchars($_POST['rule']);
$rule=($_POST['rule']);
}
  

// UPDATES
if($operation == "update"){
  // It's an update (mise à jour)
  $update = new Database;
  $update->update_table_rules('budget_rules', $rule_id, $date, $auteur, $rule, $id);
} // Close: if($operation == "update"){ // C'est une modification? (Line 39)

	
// CREATIONS
elseif($operation == "creation"){
	
	// It's a creation (création)
  $creation = new Database;
  $creation->create_in_table_budget_rules("budget_rules", $date, $auteur, $rule);
} 
$url = $_SERVER['HTTP_REFERER']; // Car on peut venir de plusieurs endroit du site !
$url.="#$ancre"; //$id est l'ancre de retour...
// echo "<a href=\"$url\">Return ! </a>";
header ("location:$url");

