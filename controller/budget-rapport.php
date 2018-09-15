<?php
/**           Controller budget-rapport.php
*
*    Auteur: Marc L. Harnist
*    Mise à jour: 14/08/2018
*    Particularité: <nav> of header & footer: display: none
*    dans css/budget-echeancier.css
*
*    MAJ: 16/08/18 suppression rooter
*    Autorisation limitée au webmaster
*/   $website->membersPermissions(1, $member);

/** CREATION DE L'OBJET RAPPORT
*   Pourquoi? 
*     - réunir toutes les fonctions dans le fichier
*       classes/Methodes.php notamment la fonction qui ajoute un 
*       séparateur de milliers (en français: un espace)
*     - clarifier la liste des variables dans une classe
*/  
$panorama_last_entry = new Panorama;

/** CONSULTATION DES CHEQUES A ENCAISSER
*
*/  $cheques = new Cheques; // !
	$montant_des_cheques_a_venir = $cheques->cheques();

// ECHEANCIER: mise en mémoire des données de la base64_decode
	$database = new Database;
	$echeancier  = $database->read_table("budget_echeancier");

// RECUPERATION DES DONNEES DE L'ECHEANCIER
	foreach($echeancier as $donnees){
		// Chaque entrée sera récupérée et placée dans un array.
		$id=$donnees['id'];
		$day = $donnees['day'];
		$acteur=$donnees['acteur'];
		$poste=$donnees['poste'];
		$montant_sem=$donnees['montant_sem'];
		$montant_mois=$donnees['montant_mois'];
		$montant_annee=$donnees['montant_annee'];
	}	 // ferme "while($donnees=$reponse->fetch())" ci-dessus


// Echéancier mensuel calculé
	// On met à zéro la calculatrice
	$total_sem = $total_mois = $total_annee = $calcul_mois = 0;
	$calcul_annee = $total_entrees= $total_sorties = 0;
	$count = 0; // on met le compteur de la ligne "Total" à zéro avant de commencer
	
	$solde_theorique_du_jour = "inconnu";
	$compteur_solde_du_jour_connu = 1; //Permet de mémoriser une seule fois le solde du jour dans while

	// Langage moderne en POO avec :: (paanaim Nekudetaïm = hébreu de deux fois double points) et FETCH_ASSOC 
	foreach($echeancier as $donnees){
		// Chaque entrée sera récupérée et placée dans un array.
		$id=$donnees['id'];
		$day=$donnees['day'];
		$acteur=$donnees['acteur'];
		$poste=$donnees['poste'];
		$montant_sem=$donnees['montant_sem'];
		$montant_mois=$donnees['montant_mois'];
		$montant_annee=$donnees['montant_annee'];

		if($montant_sem!="") {
			$calcul_annee = $montant_sem*52;
			$affiche_annee = $total_annee;
			$total_annee += $calcul_annee;
			
			$calcul_mois = $calcul_annee/12;
			$affiche_mois = round ($calcul_mois, 0); // arrondit 0 chiffres après virgule
			$total_mois += $calcul_mois;

			$affiche_sem = $montant_sem;
			$total_sem += $affiche_sem;
		}
		elseif($montant_mois !="") {
			$calcul_annee = $montant_mois*12;
			$affiche_annee = $calcul_annee;
			$total_annee += $calcul_annee;

			$calcul_sem = $calcul_annee/52;
			$affiche_sem = round($calcul_sem, 0);
			$total_sem += $affiche_sem;

			$affiche_mois = $montant_mois;
			$total_mois += $montant_mois;
		}
		elseif($montant_annee !="") {
			$affiche_annee = $montant_annee;
			$total_annee += $montant_annee;
			
			$calcul_mois = $montant_annee/12;
			$affiche_mois = round ($calcul_mois, 0); // arrondit 0 chiffres après virgule
			$total_mois += $calcul_mois;
			
			$calcul_sem = $montant_annee/52;
			$affiche_sem = round($calcul_sem, 0);
			$total_sem += $affiche_sem;
		}
		$count++;	// on compte les lignes
		$size = 7; //taille des inputs
		$total_mois = round($total_mois, 0);

		if($poste == "Courses alimentaires")
			$budget_courses_alimentaires = - $affiche_mois;
			elseif($poste == "Noz")
				$Noz = - $affiche_mois;
			elseif($poste == "Shopping Web")
				$shopping_web = - $affiche_mois;
			elseif($poste == "Carburant")
				$carburant = - $affiche_mois;

		// RECHERCHE DU SOLDE THEORIQUE DU JOUR
		// Premier passage $compteur_solde_du_jour_connu = 1
		if($compteur_solde_du_jour_connu < 1 && $day < date('d'))
			$solde_theorique_du_jour = $total_mois;
			$compteur_solde_du_jour_connu--;

		$affiche_sem = $affiche_mois = $affiche_annee = '';
	}	 // ferme "while($donnees=$reponse->fetch())" ci-dessus

	$total_sem = round($total_sem, 0); // on arrondit tout
	$total_mois = round($total_mois, 0);
	$total_annee = round($total_annee, 0);

$solde = $panorama_last_entry->solde;
$nombre_de_jours_dans_le_mois = date("t"); // Trouver formule php exacte?
$nombre_de_jours_restant_jusqu_a_la_fin_du_mois = $nombre_de_jours_dans_le_mois-date('d');

/** Ajout du 15/08/2018
*   Si la date du jour est supérieur à la dernière date du panorama 
*   on propose à l'utilisateur de mettre à jour panorama.
*/	$message_update_panorama = True;
	if(date('d/m/yyyy') > $panorama_last_entry->date)
      $message_update_panorama = False;

$solde_theorique_du_jour_deduit = $solde_theorique_du_jour;
$depenses_theoriques = "";//sera affiché dans la vue dans le premier tableau

//   ALIMENTATION  
if(isset($budget_courses_alimentaires)){
    $budget_courses_alimentaires_journalier = round(($budget_courses_alimentaires/$nombre_de_jours_dans_le_mois),2);
    $budget_courses_alimentaires_used_today = date('d') * $budget_courses_alimentaires_journalier;
    $budget_courses_alimentaires_restant = $budget_courses_alimentaires_journalier*$nombre_de_jours_restant_jusqu_a_la_fin_du_mois;
	
	$solde_theorique_du_jour_deduit -= $budget_courses_alimentaires_used_today;
	$depenses_theoriques += $budget_courses_alimentaires_used_today;
}
else
    echo "<p>Je n'ai pas trouvé le \$budget_courses_alimentaires ! Vérifiez qu'il y a bien écrit, lettre par lettre \"Courses alimentaires\" dans l'échéancier.</p>";


// NOZ
if(isset($Noz)){
    $Noz_journalier = round(($Noz/$nombre_de_jours_dans_le_mois),2);
    $Noz_used_today = date('d') * $Noz_journalier;
    $Noz_restant = $Noz_journalier*$nombre_de_jours_restant_jusqu_a_la_fin_du_mois;
	
	$solde_theorique_du_jour_deduit -= $Noz_used_today;
	$depenses_theoriques += $Noz_used_today;
}
else
    echo "<p>Je n'ai pas trouvé le \$Noz ! Vérifiez qu'il y a bien écrit, lettre par lettre \"Courses alimentaires\" dans l'échéancier.</p>";

// SHOPPING WEB
if(isset($shopping_web)){
	$shopping_web_journalier = round(($shopping_web/$nombre_de_jours_dans_le_mois),2);
	$shopping_web_used_today = date('d') * $shopping_web_journalier;
	$shopping_web_restant = $shopping_web_journalier*$nombre_de_jours_restant_jusqu_a_la_fin_du_mois;
	$solde_theorique_du_jour_deduit -= $shopping_web_used_today;
	
	$depenses_theoriques += $shopping_web_used_today;
}
else
	$rapport_shopping_web .= "<p>Je n'ai pas trouvé le budget Shopping_Web ! Vérifiez que \"Shopping Web\" existe bien dans un poste de l'échéancier en respectant bien la casse.</p>";

// CARBURANT
if(isset($carburant)){
	$carburant_journalier = round(($carburant/$nombre_de_jours_dans_le_mois),2);
	$carburant_used_today = date('d') * $carburant_journalier;
	$carburant_restant = $carburant_journalier*$nombre_de_jours_restant_jusqu_a_la_fin_du_mois;
	$solde_theorique_du_jour_deduit -= $carburant_used_today;
	
	$depenses_theoriques += $carburant_used_today;
}
else
	$rapport_carburant .= "<p>Je n'ai pas trouvé le budget \$carburant !</p>";
	
	$ecart = $panorama_last_entry->liquidite - $montant_des_cheques_a_venir - $solde_theorique_du_jour_deduit;
	$solde_moins_cheques_a_venir = $solde - $montant_des_cheques_a_venir;
	$total_restant = $budget_courses_alimentaires_restant + $carburant_restant + $Noz_restant + $shopping_web_restant;
	$total_used = $budget_courses_alimentaires_used_today + $carburant_used_today + $Noz_used_today + $shopping_web_used_today;