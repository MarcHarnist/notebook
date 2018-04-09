<?php

	if( !empty($message) && $upload == False) {
		?>
        <p>
			<?=$message;?> <a href="<?=PAGE_URL;?>__uploader">Recommencer</a>
		</p>
		<?php
	}
	elseif ($upload) {
		?>
		<p>Voici mon image: <?=$nomImage;?><br />
			<a href="<?=IMG_URL . $nomImage;?>" title="">
				<img style="height:150px; width:150px;" 
                     src="<?=IMG_URL . $nomImage;?>" alt="Mon image">
			</a>
			<a href="<?=PAGE_URL . $page_d_origine;?>&image=<?=$nomImage;?>#<?=$id;?>" title="Retour à la page d'origine">Insérer cette image dans ma page <?=$page_d_origine;?>.</a>
		</p>
		<?php
	}
	else {
		
    ?>
	<p>
	Choisissez une image de taille maxi <?=MAX_SIZE;?> pixels.</p>
	<form enctype="multipart/form-data" action="" method="post">
          <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <input name="fichier" type="file" id="fichier_a_uploader" /><br />
            <input type="submit" name="submit" value="Enregistrer" />
          </p>
    </form>
	<?php
	}
