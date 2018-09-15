<!--               Vue budget-rapport.php

    Isa voudrait un mail non pas quotidien mais uniquement lorsque quelque chose s'est passé sur le compte (entrée ou sortie) qui dise: il te reste tant pour shopping...
	Path: view/budget-echeancier.php  Marc L. Harnist 2017
-->
<article>
  <header class="row bg-light p-3 ">
    <h2 class="row ml-0 text-muted">RAPPORT SUR LE BUDGET...</h2>
  </header>   
	<section class="row">
		<?php include "inc/budget-menu.php";?>
		<!-- Avertissement: attention, separateur() (methode de Methods
			 transforme int en string.
			 A utiliser uniquement pour l'affichage final dans la vue et une
			 seule fois sur le même nombre, sinon il y aura un bug -->
	    <div class="col-lg-5">
			<table  id="bilan" class="table table-striped">
				<tr><th colspan="2">CALCULS</th>
				<tr>
					<td class="left">Nombre de jours dans le mois</td>
					<td><?=date("t")?></td>
				</tr>
				<tr>
					<td class="left">Nombre de jours restant</td>
					<td><?=$nombre_de_jours_restant_jusqu_a_la_fin_du_mois?></td>
				</tr>
				<tr><td class="left">Date du "<a href="<?= $website->page_url?>budget-panorama">panorama</a>"  
					<?php 
					if($message_update_panorama == True){
						?>
						<span style="color:green"> (Panorama du budget à jour)</span>
						<?php
					}
					else {
						?>
						<strong><span style="color:red"> (Nous sommes le <?=date('d/m/Y')?>. <a href="<?= $website->page_url?>budget-panorama">Mettre à jour le "panorama"</a>...)</span></strong>
						<?php
						}
					?>
					</td>
					<td><?=$panorama_last_entry->date?></td>
				</tr>
				<tr><td class="left">Solde réel du compte courant à la <a href="https://mabanque.bnpparibas/fr/connexion" target="_blank">
					BNP</a></td>
					<td><?=$cheques->separateur($panorama_last_entry->liquidite);?> €</td>
				</tr>
				<tr><td class="left">Solde réel (<?=$cheques->separateur($panorama_last_entry->liquidite);?> €) - <a href="<?= $website->page_url;?>budget-cheques">chèques</a> à venir (<?php if($montant_des_cheques_a_venir > 0 ) echo "<span class = \"warning\">"; echo $cheques->separateur($montant_des_cheques_a_venir);?> € </span>)</td>
					<td><?=$cheques->separateur($panorama_last_entry->liquidite-$montant_des_cheques_a_venir);?> €</td>
				</tr>
				
				<!--  ########### Solde prévu par l'échéancier à cette date ########## -->
				<tr><td class="left">Solde prévu par <a href="<?= $website->page_url;?>budget-echeancier">l'échéancier</a> à cette date</td>
					<td><?=$cheques->separateur($solde_theorique_du_jour);?> €</td>
				</tr>
				<tr><td class="left">Echéancier (<?=$cheques->separateur($solde_theorique_du_jour);?> €) - dépenses éstimées (<?=round($depenses_theoriques,0);?> €)</td>
					<td><?=$cheques->separateur($solde_theorique_du_jour_deduit);?> €</td>
				</tr>
				<!-- Eh non! il ne faut pas ôter les chèques de l'échéancier: ils ne sont pas prévus! 
				<tr><td class="left">Echéancier (<?=$cheques->separateur($solde_theorique_du_jour_deduit);?> €) - chèques à venir (<?php if($montant_des_cheques_a_venir > 0 ) echo "<span class = \"warning\">"; echo $cheques->separateur($montant_des_cheques_a_venir);?> €</span>)</td>
					<td><?=$cheques->separateur($solde_theorique_du_jour_deduit-$montant_des_cheques_a_venir);?> €</td>
				</tr>
				-->
				<tr><td class="left">Solde réel (<?=$cheques->separateur($panorama_last_entry->liquidite-$montant_des_cheques_a_venir);?> €) - échéancier (<?=$cheques->separateur($solde_theorique_du_jour_deduit);?> €)</td>
					<td><?php if($ecart < 0) echo "<span class = \"warning\">";
							  else           echo "<span class = \"green\">";
					echo $cheques->separateur($ecart);?> €</span></td>
				</tr>
			</table>
		</div>
		<div class="col-lg-5">
			<table class="table table-striped">
				<tr><th colspan="2">DONNES DU PANORAMA</th>
				<tr><td class="left">Id</td><td> <?= $panorama_last_entry->id;?></td>
				</tr>
				<tr><td class="left">Date</td><td> <?=$panorama_last_entry->date;?></td>
				</tr>
				<tr><td class="left">Liquidité</td><td> <?=$cheques->separateur($panorama_last_entry->liquidite);?> €</td>
				</tr>
				<tr><td class="left">A venir</td><td> <?=$cheques->separateur($panorama_last_entry->avenir);?> €</td>
				</tr>
				<tr><td class="left">Prévisionnel </td><td> <?=$cheques->separateur($panorama_last_entry->previsionnel);?> €</td>
				</tr>
				<tr><td class="left">Epargne</td><td> <?=$cheques->separateur($panorama_last_entry->epargne);?> €</td>
				</tr>
				<tr><td class="left">Solde</td><td> <?=$cheques->separateur($panorama_last_entry->solde);?> €</td>
				</tr>
				<tr><td class="left">Crédit </td><td> <?=$cheques->separateur($panorama_last_entry->credit);?> €</td>
				</tr>
				<tr><td class="left">Solde général</td><td> <?=$cheques->separateur($panorama_last_entry->solde_general);?> €</td>
				</tr>
			</table>
		</div>



	</section>
	<?php
		if($ecart > 0)
		echo "<p><strong><span style=\"color:green\">
	Bravo! Vous êtes riche! Vous êtes excédentaire de " . $ecart . " €</span></strong></p>";
	elseif($solde_moins_cheques_a_venir == $solde_theorique_du_jour_deduit)
		echo "<p><strong><span style=\"color:green\">
	Bravo! Votre solde est parfaitement équilibré! Votre solde du jour est égale au solde prévu!</span></strong></p>";
	else {
		$budget_used_reel_journalier = ($budget_courses_alimentaires_used_today+$Noz_used_today+$shopping_web_used_today+$carburant_used_today - $ecart)/date('d');
		$budget_journalier_theorique = ($budget_courses_alimentaires + $Noz + $shopping_web + $carburant)/$nombre_de_jours_dans_le_mois;
		$difference_journaliere = $budget_journalier_theorique-$budget_used_reel_journalier;
		echo "<p><strong><span style=\"color:red\">
		Aïe! Vous avez dépensé " . $ecart. " € de trop depuis le début du mois. Vous avez dépensé " . round($budget_used_reel_journalier,2) . " € par jour au lieu de " . round($budget_journalier_theorique,2) . " € soit " . round($difference_journaliere,2) . " € de trop par jour.</span></strong></p>";

		}
	?>
	</p>
	<table class="table table-striped">
	<tr>
		<th class="left">POSTE</th><th>BUDGET</th><th>Hebdo</th><th>Jour</th><th>Utilisé</th><th>Reste</th><th>Ecart</th><th>Reste</th>
	<th>/jours</th></tr>
	<tr><td class="left">Alimentation</td>
		<td><?=$budget_courses_alimentaires;?> €</td>
		<td><?=round(($budget_courses_alimentaires*12/52),0);?> €</td>
		<td><?=round($budget_courses_alimentaires_journalier,0);?> €</td>
		<td><?=round($budget_courses_alimentaires_used_today,0);?> €</td>
		<td><?=round($budget_courses_alimentaires_restant,0);?> €</td>
		<td><?=round($ecart,0);?> €</td>
		<td><?=round($budget_courses_alimentaires_restant + $ecart,0);?> €</td>
		<td><?php if($nombre_de_jours_restant_jusqu_a_la_fin_du_mois > 0) echo round(($budget_courses_alimentaires_restant + $ecart)/$nombre_de_jours_restant_jusqu_a_la_fin_du_mois,0); else echo round($budget_courses_alimentaires_restant + $ecart);?> €</td>
	</tr>
	<tr><td class="left">Carburant</td>
		<td><?=$carburant;?> €</td>
		<td><?=round(($carburant*12/52),0);?> €</td>
		<td><?=round(($carburant/$nombre_de_jours_dans_le_mois),0);?> €</td>
		<td><?=round($carburant_used_today,0);?>  €</td>
		<td><?=round($carburant_restant,0);?>  €</td>
		<td></td>
		<td><?=round($carburant_restant,0);?>  €</td>
	</tr>
	<tr><td class="left">Noz</td>
		<td><?=$Noz;?> €</td>
		<td><?=round(($Noz*12/52),0);?> €</td>
		<td><?=round($Noz/$nombre_de_jours_dans_le_mois,0);?> €</td>
		<td><?=round($Noz_used_today,0);?>  €</td>
		<td><?=round($Noz_restant,0);?> €</td>
		<td></td>
		<td><?=round($Noz_restant,0);?> €</td>
	</tr>
	<tr><td class="left">Shopping Web</td>
		<td><?=$shopping_web;?> €</td>
		<td><?=round(($shopping_web*12/52),0);?> €</td>
		<td><?=round($shopping_web/$nombre_de_jours_dans_le_mois,0);?> €</td>
		<td><?=round($shopping_web_used_today,0);?>  €</td>
		<td><?=round($shopping_web_restant,0);?> €</td>
		<td></td>
		<td><?=round($shopping_web_restant,0);?> €</td>
	</tr>
	<tr><td class="left">Total courses</td>
		<td> <?=$budget_courses_alimentaires+$Noz+$shopping_web+$carburant;?> € </td>
		<td><?=round((($budget_courses_alimentaires+$Noz+$shopping_web+$carburant)*12/52),0);?> €</td>
		<td> <?php echo round((($budget_courses_alimentaires+$Noz+$shopping_web+$carburant)/$nombre_de_jours_dans_le_mois), 0);?> € </td>
		<td><?=round($total_used,0);?> €</td>
		<td><?=round($total_restant,0);?> €</td>
		<td></td>
		<td><strong><?=round($total_restant + $ecart,0);?> €</strong></td>
	</tr>
	</table>
	<div style = "width:600px;border:2px solid lightgrey; margin:20px 20px 50px 20px; padding:20px;">
	<?php

	/** N'utilisez pas <p> mais uniquement des <br> qui seront transformés en \n pour le textarea  */
	$message = "
	<p>Coucou Isa!<br>
	Petit coup d'oeil sur le compte...<br>
	En comptant les écarts, il reste <strong>". round(($total_restant + $ecart),0) . " €</strong> pour toutes les courses et le carburant jusqu'à la fin de ce mois-ci détaillés  comme suit:</p>

	<ul>
		<li>pour les courses alimentaires " . round(($budget_courses_alimentaires_restant+$ecart),0) . " €</li>
		<li>pour le carburant " . round(($carburant_restant),0) . " €</li>
		<li>pour shopping Web " . round(($shopping_web_restant),0) . " €</li>
		<li>pour Noz " . round(($Noz_restant),0) . " €</li>
		<li><strong>Total: ". round(($total_restant + $ecart),0) . " €</strong></li>
	</ul>

	<p>Autres infos:<br>
	Epargne sur ton livret: " . $panorama_last_entry->epargne . " €<br>
	Crédit immobilier: " .  $cheques->separateur($panorama_last_entry->credit) . " €</p>

	<p>Plein de bisous,<br>
	Marco Del Fuego.</p>
	";

	// $message à envoyer par mail
	echo $message;
	?>

	<form method="post" action="<?= $website->page_url;?>budget-mail">
		<input type="hidden" value="<?=$message;?>" name="message_de_la_page_budget_rapport">
		<input class = "btn btn-primary" type="submit"  value="Envoyer par mail">

	</form>
	</div>
	<?php include "inc/budget-menu.php";?>
</article>