<article class="mb-5">
  <header class="row bg-light p-3 ">
    <h2 class="row ml-0 text-muted">BUDGET PAS A PAS</h2>
  </header>
  <!-- Si une mise a jour a eu lieu (update) on propose l'ajout 
	   d'un chèque si besoin... -->
  <?php if(isset($update)){
	  ?>
	  <header class="row bg-light p-3">
	    <h3 class="text-muted">Souhaitez-vous enregistrer un nouveau chèque émis?</h3>
	  </header>
	  <div class="row">
		  <div class="col-lg-1">
			 <form method="post" action="<?=$website->page_url?>budget-cheques">
				<input class="btn" type="submit" value="Oui">
			</form>
			</div>
		  <div class="col-lg-1">
			 <form method="post" action="<?= $website->page_url . 'budget-rapport';?>">
					<input class="btn" type="submit" value="Non" />
			</form>
			</div>
		</div>
	  <?php
  }
  else
  {
  ?>
	<form class="col-lg-3" method="post" action="#">
	  <div class="form-group">
		<label for="date">Date </label>
     	<input id="date" type="text" name="date" value="<?=date('d/m/Y');?>"/>
	  </div>
	  <div class="form-group">
		<label for="liquidite">Entrez le solde du compte courant</label>
		<input type="number" step="0.01" class="form-control" id="liquidite" name="liquidite"  value="<?=round($panorama_last_entry->liquidite, 2);?>">
	  </div>
	  <div class="form-group">
		<label for="epargne">Livret</label>
		<input type="number" step="0.01" class="form-control" id="epargne" name="epargne" value="<?=$panorama_last_entry->epargne?>">
	  </div>
	  <div class="form-group">
		<label for="credit">Crédit immobilier</label>
		<input type="number" step="0.01" class="form-control" id="credit" name="credit" value="<?=$panorama_last_entry->credit?>">
	  </div>
	  <div class="form-group">
		<label for="avenir">A venir</label>
		<input type="number" class="form-control" id="avenir" name="avenir" value="0"  value="<?=$panorama_last_entry->avenir?>">
	  </div>
	  <button type="submit" step="0.01" class="btn btn-primary" name="operation" value="creation">Continuer</button>
	</form>
	<?php
    }
	?>
</article>
<nav>
<?php include "inc/budget-menu.php";?>
</nav>