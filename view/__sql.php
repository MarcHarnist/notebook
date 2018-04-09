<section>
	
	<?php
	if (file_exists($path.$savedFile)) {
	?>	
	
	<h3>La base de donnée a été sauvegardés dans www/sql/</h3>

	<p>Le fichier de sauvegarde a bien été créé. Cliquez sur le lien ci-dessous pour le télécharger sur votre ordinateur et conservez-le précieusement afin de pouvoir restaurer votre base de donnée plus tard en cas de soucis...</p>
	
	<p><a href="<?= SQL_URL . $savedFile;?>"><?= $savedFile;?></a></p>
	
	<?php
	}
	else {
	?>	
	<p>Le fichier n'a pas pu être créé à cause d'un problème inconnu. Veuillez en informer le webmaster. Merci</p>	
	<?php	
	}
	?>
	
	
</section>
