<article>
  <header class="row bg-light p-3 ">
    <h2 class="row ml-0 text-muted">PANORAMA DE LA CAISSE D'EPARGNE</h2>
  </header>   
  <?php include "inc/budget-cde-menu.php";?>
  <div class="col-sm-12 mt-3">
	<p>	  
		Solde = liquidité + épargne;
		Previsio = à venir + épargne;
		Total général = à venir + solde;
	</p>

<!-- ************************ AFFICHAGE UPDATE ******************* -->
	<table class="table table-striped"><!-- Bootstrap class -->
	  <tr>
		<th>Id </th>
		<th>Date</th>
		<th>Liquidité </th>
		<th>Epargne </th>
		<th>Solde </th>
		<th>CB à venir </th>
		<th>Prévisio </th>
		<th>Total général </th>
		<th>Action </th>
	  </tr>
	  <?php
	  // Langage moderne en POO avec paanaim Nekudetaïm (::) et FETCH_ASSOC 
	  foreach($panorama as $data){
		  // Chaque entrée sera récupérée et placée dans un array.
		  $id = $data['id'];
		  $date = $data['date'];
		  $liquidite = $data['liquidite'];
		  $epargne = $data['epargne'];
		  $avenir = $data['avenir'];
		  
		  $solde = $liquidite + $epargne;
		  $previsio = $avenir + $liquidite;
		  $total_general = $avenir + $solde;
		?>  
		  <tr id="<?php $ancre=$count; echo $ancre; $count++;?>">
		  
		  <!-- id du formulaire supprimés: leur duplication != valid html5 --> 
		  
		  <form method="post" action="<?= $website->page_url;?>budget-cde-panorama-update">
		  
		  <td>
			<input class="right" type="text" size="1" name="new_id" value="<?php echo $id;?>">
			<input type="hidden" name="id" value="<?php echo $id;?>"><!-- on sauve la valeur de l'ancien id-->
		  </td>
		  <td>
			<input class="right" type="text" size="<?=$dateInputSize;?>" name="date" value="<?php echo $date;?>">
		  </td>
		  <td>
			<input class="right" type="text" size="<?php echo $size;?>" name="liquidite" value="<?php echo $liquidite;?>">
		  </td>
		  <td class="center">
			<input class="right"  type="text" size="<?php echo $size;?>" name="epargne"value="<?php echo $epargne;?>">
		  </td>
		  <td>
		  <!--<input class="right" type="text" size="<?php //echo $size;?>" name="solde" value="<?php //echo $solde; ?>">-->
			<p class="right"><?php echo $solde; ?></p>
		  </td>
		  <td>
			<input class="right"  type="text" size="<?php echo $size;?>" name="avenir" value="<?php echo $avenir;?>">
		  </td>
		  <td>
			<p class="right"><?php echo $previsio; ?></p>
		  </td>
		  <td>
		<p class="right"><?php echo $total_general; ?></p>
	  </td>
	  <td class="center">
		<input type="hidden" name="ancre" value="<?php echo $ancre;?>">
		<input type="hidden" name="operation" value="update">
		<input type="submit" value="Edit">
	  </td>
	  
	  </form>
		  
		  <td class="center"><span class="center">
			<form method="post" action="<?= $website->page_url;?>budget-cde-panorama-delete">
			  <input type="hidden" name="id" value="<?php echo $id;?>">
			  <input type="hidden" name="ancre" value="<?php echo $ancre;?>">
			  <input type="hidden" name="operation" value="delete">
			  <input type="submit" value="del">
			</form>
		  </td>
		<?php 
	  }// Ferme foreach($datas as $data)
	?>
	
	
	
	
	
<!-- ******************* CREATION ******************* -->
	<table class="table table-striped">
	  <tr>
		<th>Date</th>
		<th>Liquidité </th>
		<th>Epargne </th>
		<th>CB à venir </th>
		<th>Action </th>
	  </tr>

	  <tr>
		<form method="post" action="<?= $website->page_url;?>budget-cde-panorama-update">
		  <!-- id du formulaire supprimés: 2 id != valid html5 --> 
		  <!-- Td suivant sert à afficher un tableau complet -->
		  <td>
			<input class="right" type="text" size="<?php echo $dateInputSize;?>" name="date" value="<?=date('d/m/Y');?>"/>
		  </td>
		  <td>
			<input class="right" type="text" size="<?php echo $size;?>" 
			name="liquidite"  value = "<?=$liquidite;?>">
		  </td>
		  <td>
			<input class="right" type="text" size="<?php echo $size;?>" name="epargne"  value = "<?=$epargne;?>">
		  </td>
		  <td>
			<input class="right" type="text" size="<?php echo $size;?>" name="avenir"  value = "<?=$avenir;?>">
		  </td>
		  <td class="center">
			<input type="hidden" name="ancre" value="<?php echo $ancre;?>">
			<input type="hidden" name="operation" value="creation">
			<input class="right"  type="submit" size="140" value="Creation">
		  </td>
		</form>
	</table>
	<section>
	<p><a href="https://mabanque.bnpparibas/fr/connexion" target="_blank">
				BNP</a> - 
		<a href="<?= $website->page_url;?>__sql" alt="Cliquez ici sauver sql db">
		Sauvez la base de donnée!
		</a>
	</p>
	<p>	  
		Solde = liquidité + épargne;
		Previsio = à venir + épargne;
		Total général = à venir + solde;
	</p>
  </div>
</article><?php include "inc/budget-cde-menu.php";?>