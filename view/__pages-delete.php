
<!-- Delete one page, choosen in pages-index or in page-from-pages-index
									M.Harnist 02 octobre 2017 -->

<h3>Etes-vous sur de vouloir supprimer l'entrée suivante:</h3>
<h4 class="warning">Attention ! Cette suppression sera définitive.</h4>

<h3>
	N° <?=$page['id']?> - <?=$page['title']?><br />
	<em>Le <?=$page['date'];?></em>
</h3>
	
<p><?=$page['text'];?></p>

 <form method="post" action="">
	<input type="hidden" name="id" value="<?= $id;?>" />
	<input type="submit" value="Oui, je confirme la suppression." />
</form>

<p>
	<a href="<?= PAGE_URL . 'pages-index&categorie=' . $page['category'];?>">Non, j'annule la suppression.</a> 
</p>
