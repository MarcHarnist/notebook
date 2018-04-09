<?php
if (isset($creation)){
	// if $creation = True, new member
	?>
	<section>
		<p>
			Le membre: <?=$new_member_name;?> de niveau <?=$new_member_level;?> a bien été renregistré!
		</p>
	</section>
	<?php
}
else { 		// Connect
	?>
	<section>
		<h2>Enregistrer un membre</h2>	
		 
		<p>Bienvenue <?=$name;?>. Vous pouvez rajouter un membre ici.</p>

		<form action="#" method="post">
			<p>
			Choisissez un pseudo:<br />
			<input class = "input_blanc" type="text" name="name" maxlength="50" value="<?=$save_pseudo;?>" />
			</p>
			<p>
			Puis un mot de passe:<input class = "input_blanc" type="password" name="password" maxlength="250" />
			</p>
			<p>
			Et un niveau:<br />
			<input class = "input_blanc"	type="radio" name = "level" value="1">1 Webmaster - Il peut ajouter des membres - tout faire</input> <br />
			<input class = "input_blanc"	type="radio" name = "level" value="2">2 Propriétaire - Il peut modifier les pages du blog!</input> <br />
			<input class = "input_blanc"	type="radio" name = "level" value="3">3 Modérateur</input> <br />
			<input class = "input_blanc"	type="radio" name = "level" value="4">4 Membre</input> <br />
			<input class = "submit"	type="submit" value="Enregistrer" name="creer" />
			</p>
		</form>
	</section>
	<?php
}
if(($message->Red()) != ""){
	?>	
	<section>
		<p class = "messageRed">
		<?php echo $message->Red();?>
		</p>
	</section>
	<?php
}
if(($message->Green()) != ""){
	?>
	<section>
		<p class = "messageGreen">
			<?php echo $message->Green();?>
		</p>
	</section>
	<?php
}
?>