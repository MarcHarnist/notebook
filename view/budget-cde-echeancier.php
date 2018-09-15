<!--              Vue budget-cde-echeancier.php                 -->

<!--   view/budget-cde-echeancier.php  Marc L. Harnist 2017  -->

<h2>Echéancier de la Caisse d'Epargne (Marc)</h2>

<?php include "inc/budget-cde-menu.php";?>

<h3>Tableau avant calcul:</h3>

<table class="table table-striped">
	<tr>
		<th>Priorité</th><th>Jour</th><th>Acteur</th><th>Poste</th><th>Semaine</th><th>Mois</th><th>Année </th>
		<th colspan="2">Action </th>
	</tr>
	<?php
	$id_ancre=0;//Ancre: retour après suppression
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
		<tr id="<?=$id_ancre?>">
		<!-- id formulaire pas valid html5, form va quand même fonctionner... --> 
		<form method="post" action="<?= $website->page_url;?>budget-cde-echeancier-update">
			<td>
				<input type="text" size="1" 
				name="new_id" value="<?php echo $id;?>">
				<input type="hidden" 
				name="id" value="<?php echo $id;?>"><!-- on sauve la valeur de l'ancien id-->
			</td>
			<td>
				<input type="text" size="5" 
				name="day" value="<?=$day;?>">
			</td>
			<td>
				<input type="text" size="5" 
				name="acteur"value="<?php echo $acteur;?>">
			</td>
			<td>
				<input type="text" size="20" 
				name="poste" value="<?php echo $poste;?>">
			</td>
			<td>
				<input class="right" type="text" size="3" 
				name="montant_sem" value="<?php if($montant_sem !==''){ echo $montant_sem;} // si le montant_sem existe en ajoute "€" ?>">
			</td>
			<td>
				<input class="right"	type="text" size="3" 
				name="montant_mois" value="<?php if($montant_mois !==''){ echo $montant_mois;} // si le montant existe en ajoute "€" ?>">
			</td>
			<td>
				<input class="right"	type="text" size="7" 
				name="montant_annee" value="<?php if($montant_annee !==''){ echo $montant_annee;} // si le montant existe en ajoute "€" ?>">
			</td>
			<td class="center">
				<input type="hidden" name="operation" value="update">
				<input type="submit" value="Edit">
			</td>
		</form>
		<td class="center">
			<span class="center">
				<form 
					method="post" 
					action="<?= $website->page_url;?>budget-cde-echeancier-delete">
					<input type="hidden" name="id" value="<?php echo $id;?>"> 
					<input type="hidden" name="ancre" value="<?=$id_ancre;?>"> 
					<input type="submit" value="del">
				</form>
			</span>
		</td>

		<?php 
		$id_ancre++;//Ancre: retour après suppression
	}	 // ferme foreach
?>

<!--    FORMULAIRE POUR RAJOUTER UNE ENTREE                   -->
	<tr>
		<form method="post" action="<?= $website->page_url;?>budget-cde-echeancier-update">
				<!-- J'ai du supprimer les id du formulaire car leur doublement est non valide html5 --> 
			<td>
			</td><!-- sert juste à afficher un tableau complet -->
	<td>
		<input type="text" size="5" 
		name="day" value="">
	</td>
					<td>
			<input type="text" size="5" 
			name="acteur">
			</td>
			<td>
			<input type="text" size="20" 
			name="poste">
			</td>
			<td>
			<input class="right" type="text" size="3" 
			name="montant_sem">
			</td>
			<td>
			<input class="right"	type="text" size="3" 
			name="montant_mois">
			</td>
			<td>
			<input class="right"	type="text" size="7" 
			name="montant_annee">
			</td>
			<td colspan="2" class="center">
			<input type="hidden" name="operation" value="creation">	
			<input class="right"	type="submit" size="140" value="Create now">
			</td>
	</form>
</table>
<div class="breakafter"></div>

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

	foreach($echeancier as $donnees) {
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
		?>	
		<tr>
		<!-- J'ai du supprimer les id du formulaire: duplication non valide html5. --> 
		<form method="post" action="<?= $website->page_url;?>budget-update-calcul">
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
				if($poste == "Carburant")
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
		<td> 
		</td>
	</tr>
</table>
<?php include "inc/budget-cde-menu.php";?>
