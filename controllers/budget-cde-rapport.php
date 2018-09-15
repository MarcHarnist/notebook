<?php
/**           Controller budget-cde-rapport.php
*                       Marc L. Harnist
*                         31/08/2018
*
*    MAJ:
*/   $website->membersPermissions(1, $member);

/** CREATION DE L'OBJET RAPPORT
*   Pourquoi? 
*     - réunir toutes les fonctions dans le fichier
*       classes/Methodes.php notamment la fonction qui ajoute un 
*       séparateur de milliers (en français: un espace)
*     - clarifier la liste des variables dans une classe
*/  

/** On récupère la dernière entrée dans le panorama pour l'afficher
*   dans un tableau dans la vue.
*/  $panorama_last_entry = new PanoramaCde;

/** CONSULTATION DES CHEQUES A ENCAISSER
*
*/  $cheques = new Cheques; // !
	$montant_des_cheques_a_venir = $cheques->cheques('budget_cde_cheques');

//  MISE EN MEMOIRE DE LA BASE DE DONNEE DE L'ECHEANCIER
	$database = new Database;
	$echeancier  = $database->read_table("budget_cde_echeancier");

// Echéancier mensuel calculé
	//Déclaration des variables
	$courses_alimentaires = "Courses alimentaires";//Sensible à la casse
	$carburant = "Carburant";//sensible à la casse
	
	
	// On met à zéro la calculatrice
	$total_sem = $total_mois = $total_annee = $calcul_mois = 0;
	$calcul_annee = $total_entrees= $total_sorties = $budget_courses_alimentaires_restant = 0;
	$budget_courses_alimentaires_used_today = $carburant_restant = $carburant_used_today = 0;
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

		if($poste == $courses_alimentaires)
			$budget_courses_alimentaires = - $affiche_mois;
		elseif($poste == $carburant)
			$budget_carburant = - $affiche_mois;

		// RECHERCHE DU SOLDE THEORIQUE DU JOUR
		// Premier passage $compteur_solde_du_jour_connu = 1
		if($day <= date('d'))
			$solde_theorique_du_jour = $total_mois;
			$compteur_solde_du_jour_connu--;

		$affiche_sem = $affiche_mois = $affiche_annee = 0;
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
$depenses_theoriques = 0;//sera affiché dans la vue dans le premier tableau

//   ALIMENTATION  
if(isset($budget_courses_alimentaires)){
    $budget_courses_alimentaires_journalier = round(($budget_courses_alimentaires/$nombre_de_jours_dans_le_mois),2);
    $budget_courses_alimentaires_used_today = date('d') * $budget_courses_alimentaires_journalier;
    $budget_courses_alimentaires_restant = $budget_courses_alimentaires_journalier*$nombre_de_jours_restant_jusqu_a_la_fin_du_mois;
	
	$solde_theorique_du_jour_deduit -= $budget_courses_alimentaires_used_today;
	$depenses_theoriques += $budget_courses_alimentaires_used_today;
}
else
    echo $website->message("Erreur", "<p>Je n'ai pas trouvé le poste \"$courses_alimentaires\" dans l'échéancier. Vérifiez qu'il y a bien écrit, lettre par lettre \"$courses_alimentaires\" dans <a href=\"".$website->page_url."budget-cde-echeancier\">l'échéancier</a>.</p>", "pink");

// CARBURANT
if(isset($budget_carburant)){
	$budget_carburant_journalier = round(($budget_carburant/$nombre_de_jours_dans_le_mois),2);
	$budget_carburant_used_today = date('d') * $budget_carburant_journalier;
	$budget_carburant_restant = $budget_carburant_journalier*$nombre_de_jours_restant_jusqu_a_la_fin_du_mois;
	$solde_theorique_du_jour_deduit -= $budget_carburant_used_today;
	
	$depenses_theoriques += $budget_carburant_used_today;
}
else
	echo $website->message("Erreur", "<p>Je n'ai pas trouvé le poste \"$carburant\" dans <a href=\"".$website->page_url."budget-cde-echeancier\">l'échéancier</a>. Vérifiez qu'il y a bien écrit, lettre par lettre \"$carburant\" dans l'échéancier..</p>", "pink");
	
	$ecart = $panorama_last_entry->liquidite - $montant_des_cheques_a_venir - $solde_theorique_du_jour_deduit;
	$solde_moins_cheques_a_venir = $solde - $montant_des_cheques_a_venir;
	$total_restant = $budget_courses_alimentaires_restant + $budget_carburant_restant;
	$total_used = $budget_courses_alimentaires_used_today + $budget_carburant_used_today;