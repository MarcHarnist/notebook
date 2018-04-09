	<article>
		<header class="row bg-light p-3	">
			<h2 class="row ml-0 text-muted">Contactez-moi</h2>
		</header>	
		<div class="col-sm-12">
			<form action="<?=PAGE_URL . 'contact_verif';?>" method="post">
			  <div class="form-group">
				<label for="email">Email *</label>
				<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Entrez votre email" required>
				<small id="emailHelp" class="form-text text-muted">Nous ne communiquerons jamais votre mail à quelqu'un d'autre.</small>
			  </div>
			  <div class="form-group">
				<label for="message">Votre message *</label>
					<textarea name="message" class="form-control" id="message" rows="5" cols="30" placeholder="Votre message"></textarea>
			  </div>
			  <div class="form-group">
				<label for="capcha">Je ne suis pas un robot : </label>
					<?php $capcha = rand(1,5); 
					echo ' ' . $capcha;?> + 1 = <input class="rounded" id="capcha" name="capcha_reponse" size="3" />
					<input type="hidden" name="capcha" value="<?php $capcha++;
					echo $capcha;?>" />
			  </div>
			  <button type="submit" class="btn btn-dark">Envoyer</button>
			</form>
		</div>
	</article>

<!--
<section>
	<h2>Contactez-moi!</h2>
	<form action="<?//=PAGE_URL . 'contact_verif';?>" method="post">
		<p>
			Votre email : <br />
			<input size="30" name="email" type="text" />
		</p>
		<p>
			Votre message : <br />
			<textarea name="message" rows="5" cols="30"></textarea><br />
			Je ne suis pas un robot: <?php //$capcha = rand(1,5); 
			//echo $capcha;?> + 1 =<input name="capcha_reponse" size="3" />
			<input type="hidden" name="capcha" value="<?php //$capcha++;
			//echo $capcha;?>" />
		</p>
		<p>
			<input class="submit" type="submit" value="Envoyer" /> 
		</p>
	</form>
</section>
-->