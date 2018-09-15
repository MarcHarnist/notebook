<!-- Affichage des pages à éditer dans la vue le 13/08/2017 ML-Harnist -->
<article class="bg-light w-100">
	<header class="row bg-light">
		<h2 class="row m-3 text-muted">Modifiez vous-mêmes les pages de votre site!</h2>
	</header>	

	<h3 class="h4">
		<!--<a href="<?//== $website->page_url;?>__sql">Sauvegarder les données avant d'éditer.</a> - -->
		<a href="<?= $website->page_url . 'page-from-pages-index&id=' . $pages['id'] . '&categorie=' . $pages['category'] . '&titre=' . $pages['title'];?>">Voir la publication</a> - <a href="<?= $website->page_url;?>__pages-creation">Nouvelle page</a> 
		
	</h3>
		<form class = "row p-3 bg-secondary m-3 rounded" method="post" action="<?= $website->page_url;?>__pages-save">
		
			<div class="col-lg-2">
				<label for="id" class="text-white" id="<?=$pages['id'];?>">Page n° </label>
					<input class="form-control" type="text" name="page_id" value="<?=$pages['id'];?>" id="id">
					<!-- on sauve la valeur de l'ancien N°-->
					<input type="hidden" name="N°" value="<?=$pages['id'];?>">
			</div>
			<div class="col-lg-3 ">
				<label for="date" class="text-white"> du (jj/mm/aaaa)</label>
					<input class="form-control" type="text" size="8" name="date" value="<?=$pages['date'];?>"  id="date"> 
			</div>
				
			<div class="col-lg-3 ">
				<label for="author" class="text-white"> Auteur</label>
					<input class="form-control" class = "w-80" type="text" name="author" value="<?=$pages['author'];?>" id="author">
			</div> 
			<div class="col-lg-12 pt-3">
				<label for="titre" class="text-white">Titre:
					<input class="form-control title" type="text" size="76" name="title" value="<?=$pages['title'];?>" id="titre">
			</div>
			
			<!-- Bloc des catégories: margin top 3 (mt-3) -->
			<div class="col-lg-12 pt-3">
				<div class="row">
					<p class="text-white col-lg-12">Catégorie: <i>"<?=$pages['category'];?>"</i></p>
					<div class="text-white col-lg-12">
					<div class="row">
						<p class="col-lg-5">Déplacer le fichier dans une autre catégorie:</p>		
						<select class="form-control col-lg-6" name="category">
						  <option selected><?=$pages['category'];?></option>
							<?php
								foreach($categories as $categorie){
								?>
								<option value="<?=$categorie;?>"><?=$categorie;?></option>
								<?php	
								}
								?>
						</select>
					</div>
					</div>
					<div class="col pt-3">
						<input class="form-control w-100" type="text" name="category_new" value="" placeholder="Créer une nouvelle catégorie">	
					</div>
				</div>
			</div>
			
			<p class="col-lg-12 pt-3"> 
				<input class="form-control w-25"  type="submit" value="Enregistrer" />
			</p>
			
			<!-- VOICI LE BB-CODE. La visualisation n'est pas terminée: il faut mettre à jour le fichier root/js/bb-code.js-->
			<p class="col-lg-12 pt-3"><a class="btn btn-light" href="<?= $website->page_url;?>__uploader&page_d_origine=__pages-edition&id=<?=$pages['id'];?>" title="Cliquez pour charger une image">Insérer une image.</a> <input type="button" class="btn btn-light" value="G" onclick="insertTag('&lt;strong&gt;', '&lt;/strong&gt;', 'textarea')" />
				<input type="button" class="btn btn-light" value="I" onclick="insertTag('&lt;i&gt;', '&lt;/i&gt;', 'textarea')" />
				<input type="button" class="btn btn-light" value="small" onclick="insertTag('&lt;small&gt;', '&lt;/small&gt;', 'textarea')" />
				<input type="button" class="btn btn-light" value="h3" onclick="insertTag('&lt;h3 class=&quot;&quot;&gt;', '&lt;/h3&gt;', 'textarea')" />
				<input type="button" class="btn btn-light" value="green" onclick="insertTag('&lt;span class=&quot;text-success&quot;&gt;', '&lt;/span&gt;', 'textarea')" />
				<input type="button" class="btn btn-light" value="blue" onclick="insertTag('&lt;span class=&quot;text-primary&quot;&gt;', '&lt;/span&gt;', 'textarea')" />
				<input type="button" class="btn btn-light" value="Lien" onclick="insertTag('', '', 'textarea', 'lien')" />
				<input type="button" class="btn btn-light" value="Citation" onclick="insertTag('', '', 'textarea', 'citation')" />
				
			<img src="http://users.teledisnet.be/web/mde28256/smiley/smile.gif" alt=":)" onclick="insertTag(':)', '', 'textarea');" />
			<img src="http://users.teledisnet.be/web/mde28256/smiley/unsure2.gif" alt=":euh:" onclick="insertTag(':euh:', '', 'textarea');" /><br>
			<!-- FIN DU BB-CODE  -->

			<input name="previsualisation" type="checkbox" id="previsualisation" value="previsualisation" />
				<label for="previsualisation"><span class="text-white">Pr&eacute;visualisation automatique</span></label>
			</p>

			<div class="col-lg-12 pt-3">
				<textarea class="form-control" rows="20" name="text" id="textarea"  onkeyup="preview(this, 'previewDiv');" onselect="preview(this, 'previewDiv');"><?=$pages['text'];/* Une image a été chargée via __uploader?*/if(isset($image)) echo $image;?></textarea>
				
			<div id="previewDiv"></div>
			<p>
				<input type="button" class="btn btn-light" value="Visualiser" onclick="view('textarea','viewDiv');" />
			</p>
			
			<div id="viewDiv"></div>
		
			<input type="hidden" name="operation" value="update">
				<input class="form-control w-25 mt-3"  type="submit" value="Enregistrer">
			</div>
		</form>
</article>