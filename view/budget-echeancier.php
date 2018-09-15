<!--               budget-echeancier.php                 -->

<!--   view/budget-echeancier.php  Marc L. Harnist 2017  -->

<!--   Il faudrait déplacer le php de l'échéancier vers le repertoire "controller" et utiliser foreach plutôt que while. Régler aussi les checkboxes pour cocher ce qui est payé afin que cela n'entre plus dans les calculs.
-->

<h2>Echéancier de la BNP (Isa)</h2>

<?php include "inc/budget-menu.php";?>

<h3>Echéancier mensuel calculé:</h3>

<table class="table table-striped">
	<tr>
		<th>Priorité</th><th>Jour</th><th>Acteur</th><th>Poste</th><th>Entrée</th><th>Sortie</th><th>Cumul</th>
	</tr>
	<?php
	// On met à zéro la calculatrice
	$total_sem = $total_mois = $total_annee = $calcul_mois = 0;
	$calcul_annee = $total_entrees= $total_sorties = 0;
	$count = 0; // on met le compteur de la ligne "Total" à zéro avant de commencer

	$solde_theorique_du_jour = "inconnu";
	$compteur_solde_du_jour_connu = 1; //Permet de mémoriser une seule fois le solde du jour dans while

	// Langage moderne en POO avec :: (paanaim Nekudetaïm = hébreu de deux fois double points) et FETCH_ASSOC 
	foreach($echeancier as $donnees){// Chaque entrée sera récupérée et placée dans un array.
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
		?>	
		<tr>
			<td class="center">
				<?php echo $id;?>
			</td>
			<td class="center">
				<?php echo $day;?>
			</td>
			<td class="left">
			    <?php echo $acteur;?>
			</td>
			<td class="left">
			    <?php echo $poste;
				if($poste == "Courses alimentaires")
					$budget_courses_alimentaires = - $affiche_mois;
				elseif($poste == "Noz")
					$Noz = - $affiche_mois;
				elseif($poste == "Shopping Web")
					$Shopping_Web = - $affiche_mois;
				elseif($poste == "Carburant")
					$Carburant = - $affiche_mois;
				?>
			</td>
			<td><!-- entrée -->
			    <?php if($affiche_mois > 0){echo $affiche_mois; $total_entrees += $affiche_mois;} ?>
				</td>
			<td><!-- sortie -->
			    <?php if($affiche_mois <= 0) { echo $affiche_mois; $total_sorties += $affiche_mois;}?>
				</td>
				
				<!-- cumul -->
			<td class="<?php if($day >= date('d')) echo 'text-danger';?>">
			    <?php 	echo $total_mois . "  €";
						
						// Premier passage $compteur_solde_du_jour_connu = 1
						if($compteur_solde_du_jour_connu < 1 && $day < date('d'))
							$solde_theorique_du_jour = $total_mois;
							$compteur_solde_du_jour_connu--;
				?>
				</td>
		</form>
		</tr>
		<?php 
		$affiche_sem = $affiche_mois = $affiche_annee = '';
	}	 // ferme "while($donnees=$reponse->fetch())" ci-dessus

	$total_sem = round($total_sem, 0); // on arrondit tout
	$total_mois = round($total_mois, 0);
	$total_annee = round($total_annee, 0);
	?>
	<tr class="total">
		<td>
			<p><?php echo $count;?></p>
		</td>
		<td>
			<p> </p>
		</td>
		<td>
			<p> </p>
		</td>
		<td><p class="right">Total</p>
			</td>
		<td><p class="right"><?= $total_entrees;?>  € </p>
			</td>
		<td><p class="right"><?= $total_sorties;?>  € </p>
			</td>
		<td><p class="right"><?php echo $total_mois;?>  €</p>
			</td>

	</tr>
</table>
<div class="breakafter"></div>

<table class="table table-striped">
	<tr>
		<th>Priorités</th><th>Jour</th><th>Acteur</th><th>Poste</th><th>Semaine</th><th>Mois</th><th>Année </th>
		<th colspan="2">Action </th>
	</tr>
	<?php
    $compteur = 0;//Compteur pour l'ancre (id)
	foreach($echeancier as $donnees) {
		// Chaque entrée sera récupérée et placée dans un array.
		$id=$donnees['id'];
		$day = $donnees['day'];
		$acteur=$donnees['acteur'];
		$poste=$donnees['poste'];
		$montant_sem=$donnees['montant_sem'];
		$montant_mois=$donnees['montant_mois'];
		$montant_annee=$donnees['montant_annee'];
		?>
		<tr id="<?=$compteur?>">
		<!-- id formulaire pas valid html5, form va quand même fonctionner... --> 
		<form method="post" action="<?= $website->page_url;?>budget-echeancier-update">
			<td>
				<input class="w-100" type="text" size="1" 
				name="new_id" value="<?php echo $id;?>" />
				<input class="w-100" type="hidden" 
				name="id" value="<?php echo $id;?>" /><!-- on sauve la valeur de l'ancien id-->
			</td>
			<td>
				<input class="w-100" type="text" size="5" 
				name="day" value="<?=$day;?>" />
			</td>
			<td>
				<input class="w-100" type="text" size="5" 
				name="acteur"value="<?php echo $acteur;?>" />
			</td>
			<td>
				<input class="w-100" type="text" size="20" 
				name="poste" value="<?php echo $poste;?>" />
			</td>
			<td>
				<input class="w-100" class="right" type="text" size="3" 
				name="montant_sem" value="<?php if($montant_sem !==''){ echo $montant_sem;} // si le montant_sem existe en ajoute "€" ?>" />
			</td>
			<td>
				<input class="w-100" class="right"	type="text" size="3" 
				name="montant_mois" value="<?php if($montant_mois !==''){ echo $montant_mois;} // si le montant existe en ajoute "€" ?>" />
			</td>
			<td>
				<input class="w-100" class="right"	type="text" size="7" 
				name="montant_annee" value="<?php if($montant_annee !==''){ echo $montant_annee;} // si le montant existe en ajoute "€" ?>" />
			</td>
			<td class="center">
				<input type="hidden" name="operation" value="update">
				<input type="hidden" name="ancre" value="<?=$id?>">
				<input class="w-100" type="submit" value="Edit">
			</td>
		</form>
		<td class="center">
			<span class="center">
				<form 
					method="post" 
					action="<?= $website->page_url;?>budget-echeancier-delete">
					<input type="hidden" name="id" value="<?php echo $id;?>" /> 
					<input type="hidden" name="ancre" value="<?php echo $compteur;?>" /> 
					<input class="w-100" type="submit" value="del" />
				</form>
			</span>
		</td>

		<?php 
		$compteur++;//compteur pour l'ancre (id)
	}	 // ferme "while($donnees=$reponse->fetch())" ci-dessus
?>

<!--    FORMULAIRE POUR RAJOUTER UNE ENTREE                   -->
	<tr>
		<form method="post" action="<?= $website->page_url;?>budget-echeancier-update">
				<!-- J'ai du supprimer les id du formulaire car leur doublement est non valide html5 --> 
			<td>
			</td><!-- sert juste à afficher un tableau complet -->
	<td>
		<input class="w-100" type="text" size="5" 
		name="day" value="" placeholder="jour">
	</td>
					<td>
			<input class="w-100" type="text" size="5" 
			name="acteur" placeholder="acteur">
			</td>
			<td>
			<input class="w-100" type="text" size="20" 
			name="poste" placeholder="poste">
			</td>
			<td>
			<input class="w-100" class="right" type="text" size="3" 
			name="montant_sem" placeholder="montant semaine">
			</td>
			<td>
			<input class="w-100" class="right"	type="text" size="3" 
			name="montant_mois" placeholder="montant mensuel">
			</td>
			<td>
			<input class="w-100" class="right"	type="text" size="7" 
			name="montant_annee" placeholder="montant annuel">
			</td>
			<td colspan="2" class="center">
			<input class="w-100" type="hidden" name="operation" value="creation">
			<input type="hidden" name="ancre" value="<?=$compteur?>">
			<input class="w-100" class="right"	type="submit" size="140" value="Create now">
			</td>
	</form>
</table>

<?php include "inc/budget-menu.php";?>