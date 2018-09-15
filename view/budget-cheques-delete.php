<?php include "inc/budget-menu.php";?>



<h3 class="text-danger">Attention ! Cette suppression sera définitive.</h3>

<div class="m-2 p-2 border border-primary rounded">
	<p>Etes-vous sur de vouloir supprimer le chèque  <strong>n°<?=$id?> </strong> du  <strong><?=$date;?> </strong> à l'ordre de  <strong>"<?=$ordre;?>"</strong> d'un montant de <strong><?=$montant?></strong> €?</p>
</div>

<form method="post" action="#">
	<p><input type="hidden" name="confirm" value="oui" />
	<input type="hidden" name="id" value="<?php echo $id;?>" />
	<input type="hidden" name="ancre" value="<?php echo $ancre;?>" />
	<input class="btn btn-danger text-white"  type="submit" value="Oui, je confirme la suppression." /></p>
</form>

<form method="post" action="<?php echo $url_de_retour_en_arriere;?>">
	<p><input class="btn btn-success rounded text-white" class="nombre"	type="submit" value="ANNULER"></p>
</form>

<p><a href="<?= $website->page_url;?>__sql-index">Cliquez ici pour Sauvegarder la db</a></p>