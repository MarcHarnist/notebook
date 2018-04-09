<!-- Affichage des pages à éditer dans la vue le 13/08/2017 ML-Harnist -->
<section>
	<p>
		<a href="<?=PAGE_URL;?>__sql">Sauvegarder les données avant d'éditer.</a> - 
		<a href="<?=PAGE_URL;?>__pages-creation">Création</a>
	</p>
	<?php
	foreach($pages as $pages) {
		//foreach display all pages here
		?>
		<form method="post" action="<?=PAGE_URL;?>__pages-update">
			<p id="<?=$pages['id'];?>">
				Page n° <input type="text" size="1" name="page_id" value="<?=$pages['id'];?>" />
				<!-- on sauve la valeur de l'ancien N°-->
				<input type="hidden" name="N°" value="<?=$pages['id'];?>" />
				du <input type="text" size="8" name="date" value="<?=$pages['date'];?>" /> 
				<i>(Format date:jj/mm/aaaa)</i><br>
				Auteur <input class = "w-80" type="text" name="auteur" value="<?=$pages['author'];?>"><br> 
			<p>
				Titre:<input class="title" type="text" size="76" name="title" 
				value="<?=$pages['title'];?>" />
			</p>
			<p>
				<input class="w-100" type="text" name="category_new" value="" placeholder="Créer une nouvelle catégorie">
			</p>	
			<p>Déplacer la page dans une autre catégorie: 
				<!-- Un foreach va lister les catégories de la base de donnée (table "light_pages") afin de pouvoir choisir l'une d'elle dans un menu déroulant 	-->
				<select class="custom-select" name="category">
				  <option selected><?=$pages['category'];?></option>
							<?php
						foreach($categories as $categorie){
							?>
				  <option value="<?=$categorie;?>"><?=$categorie;?></option>
							<?php	
						}
							?>
				</select>
			</p>
			
			<p><a href="<?=PAGE_URL;?>__uploader&page_d_origine=__pages-edition&id=<?=$pages['id'];?>" title="Cliquez pour charger une image">Insérer une image.</a></p>

			<p> 
				<input type="submit" value="Enregistrer" /><br>
				<textarea class="left" cols="79" rows="12" name="text"><?=$pages['text'];?>
					<?php // Une image a été chargée via __uploader?
					if(isset($image)) echo $image;
					?>
				</textarea>
			</p>
				<input type="hidden" name="operation" value="update" />
				<input type="submit" value="Enregistrer" />
			</p>
		</form>
	<?php
	} // ferme foreach
	?>
</section>