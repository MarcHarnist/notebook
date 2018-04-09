	<section>
		<h2>Se connecter</h2>
		<form action="#" method="post">
			<p>Votre pseudo
			<label>
			<input class="input_blanc" type="text" name="name" maxlength="50" autofocus>
			</p>
			</label>
			<p>Votre mot de passe 
			<input class = "input_blanc" type="password" name="password" maxlength="250"/><br />
			<input class = "submit" type="submit"  name="utiliser" value="Se connecter" />
			</p>
		</form>
	</section>
	<?php
	if(($message->Red()) != ""){
		?>
		<section>
			<p class = "messageRed">
			<?php echo $message->Red();?>
			</p>
		</section>
		<?php
	}
	elseif(($message->Green()) != ""){
		?>
		<section>
			<p class = "messageGreen">
			<?= $message->Green();?>
			</p>
		</section>
		<?php
	}