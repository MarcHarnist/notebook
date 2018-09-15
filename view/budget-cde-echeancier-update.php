<?php

//  J'AI FRABRIQUE UNE PAGE POUR TRAITER L'OBJET DU BUDGET EN LANGAGE PHP
//  M. Harnist 14 Juillet 2017 

$operation = $id = $new_id = $day = $acteur = $poste = $montant_sem = $montant_mois = $montant_annee = 0; 

// Je récupère les données du formulaire

//$operation: creation? Updating? Delete?
if(ISSET($_POST['operation'])){
  $operation=htmlspecialchars($_POST['operation']);
  // var_dump($operation);die;
}
if(ISSET($_POST['id'])){
  $id=htmlspecialchars($_POST['id']);
}
if(ISSET($_POST['new_id'])){
$new_id=htmlspecialchars($_POST['new_id']);
}
if(ISSET($_POST['day'])){
$day=htmlspecialchars($_POST['day']);
}
if(ISSET($_POST['acteur'])){
$acteur=htmlspecialchars($_POST['acteur']);
}
if(ISSET($_POST['poste'])){
$poste=htmlspecialchars($_POST['poste']);
}
if(ISSET($_POST['montant_sem'])){
$montant_sem=htmlspecialchars($_POST['montant_sem']);
}
if(ISSET($_POST['montant_mois'])){
$montant_mois=htmlspecialchars($_POST['montant_mois']);
}
if(ISSET($_POST['montant_annee'])){
$montant_annee=htmlspecialchars($_POST['montant_annee']);
}



// UPDATES
if($operation == 'update'){
  // It's an update (mise à jour)
    // var_dump($operation);die;

  $req = $db->prepare('UPDATE budget_cde_echeancier SET id = :new_id, day = :day, acteur = :acteur, poste = :poste, montant_sem = :montant_sem, montant_mois = :montant_mois, montant_annee = :montant_annee WHERE id = :id');
  $req->execute(array(
   'new_id' => $new_id,
   'day' => $day,
   'acteur' => $acteur,
   'poste' => $poste,
   'montant_sem' => $montant_sem,
   'montant_mois' => $montant_mois,
   'montant_annee' => $montant_annee,
   'id' => $id,
   ));
} // Close: if($operation == "update"){ // C'est une modification? (Line 39)

	
// CREATIONS
elseif($operation == "creation"){
  $req = $db->prepare('INSERT INTO budget_cde_echeancier(day, acteur, poste, montant_sem, montant_mois, montant_annee) VALUE(:day, :acteur, :poste, :montant_sem, :montant_mois, :montant_annee)');
  $req->execute(array(
    'day' => $day,
    'acteur' => $acteur,
    'poste' => $poste,
    'montant_sem' => $montant_sem,
    'montant_mois' => $montant_mois,
    'montant_annee' => $montant_annee,
    ));
}  

$url = $_SERVER['HTTP_REFERER']; // Car on peut venir de plusieurs endroit du site !
// echo "<a href=\"$url\">Return ! </a>";
header ("location:$url");
