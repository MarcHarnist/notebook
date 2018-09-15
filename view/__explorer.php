<article>
	<header class="bg-light p-3">
		<h2 class="row text-muted">Fichiers du site</h2>
	</header>	
	<h3>Dossier des images</h3>
	<form class="row was-validated" method="post" action="">
		<?php
			foreach($images as $image_name){
				?>
				<div class="form-group col-lg-2">
					<img class="rounded w-100" src="<?=$repertory.$image_name;?>.jpg" alt="<?=$image_name;?>">
					<select class="custom-select w-100 mt-1" name="<?=$image_name;?>" required>
						<option value="renommer">Renommer</option>
						<option value="Supprimer">Supprimer</option>
						<option value="Deplacer">Déplacer</option>
					</select>
				</div>
				<?php
			}
		?>
	</form>
	<hr>
<p>Explorer: <?=$explorer;?></p>

<form method="post" action="#">
<p>Choisissez un autre repertoire: <input type="text" name="other_dir"> <input type="submit" name="envoyer">

</p>
</form>
	<hr>
<p><strong>Important:Pour les suppressions: Seules les copies sont supprimées, si nom du fichier contient "copie"</strong></p>
<table class="table table-striped">	
	<?php
	foreach($explorateur as $line){
		if($line["type"] == "dir"){ 
			if($line["file_name"] == "."){
			$line['file_name'] == "Dossier parent";
			?>
<tr><td><a href="./<?=$line["url"];?>"><img src="img/dir.png"> <?=$line["dir"];?></a></td></tr>
			<?php
			}
			if($line['file_name'] == ".."){
				$line['file_name'] == "Dossier parent";
			?>
<tr><td><a href="./<?=$line["url"];?>"><img src="img/dossier-parent.png"> Dossier parent</a></td></td>
			<?php
			}
		}
		else {
			?>
<tr>
	<td><img src="img/<?=$line["extension"];?>.png"> <?=$line["file_name"];?></a><td>
	<td><a class="text-success" href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" . $line['dir'] . "/" . $line['file_name'];?>">Editer!</a></td>
	<td> <a href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" .  $line['dir'] . "/" . $line['file_name'];?>&operation=supprimer">Supprimer</a> 
</tr>
			<?php
		}
	}
	?>
</table>

				<?php
				if(isset($new_dir) && is_dir($new_dir)){ ?>
<p style="background-color: pink; padding:20px;"><i>"Intelligence artificielle en marche: le chemin du repertoire a été corrigé de <span style="color:red; font-size:25px;">"<?=strtolower($first_dir_name);?>"</span> en <span style="color:green; font-size:25px;">"<?=$new_dir;?>"</span>!" Le programme a trouvé tout seul le bon chemin du répertoire à explorer.</i></p>
				<?php
				}
				?>
</article>
