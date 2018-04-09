
<h3>Petite erreur dans la date?</h3>

<?php
if($vide){
	?>
	<p>Une date doit être renseignée.</p>
	<?php
}

if($format){
	?>
	<p>Votre date "<?= $date;?>" n'est pas au bon format. Merci de renseigner la date au format jj/mm/aaaa.</p>
	<?php
}
?>

<p>
  <a href="#" onclick="history.go(-1);">J'y retourne en un clic !</a>
</p>
