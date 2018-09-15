<!-- Delete one rule
									M.Harnist 02 octobre 2017 Update 16/08/18
-->

<h3 class="text-danger">Etes-vous sur de vouloir supprimer la règle ci-dessous:</h3>
<h4 class="text-danger">Attention ! Cette suppression sera définitive.</h4>

<div class="m-2 p-2 border border-primary rounded">
<h3>
	N° <?=$rules['id']?> - de - <?=$rules['auteur']?>
</h3>
	
<p><?=$rules['rule'];?></p>

</div>

 <form class="float-left mr-2"  method="post" action="#">
	<input type="hidden" name="id-deleted" value="<?= $rules['id'];?>" />
	<input type="hidden" name="id" value="<?= $rules['id'];?>" />
	<input class="btn btn-danger text-white" type="submit" value="Oui, je confirme la suppression." />
</form>

 <form method="post" action="<?= $website->page_url . 'budget-rules';?>">
	<p>
		<input type="hidden" name="id" value="<?= $id;?>" />
		<input class="btn btn-success rounded text-white" type="submit" value="Annuler" />
	</p>
</form>
