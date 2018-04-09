	<article>
		<header class="row bg-light p-3">
			<h2 class="row ml-0 text-muted">Accueil</h2>
		</header>	
			
		<div class="col-sm-12">

			<h3 class="h4">Bienvenue sur <?=WEBSITE_NAME;?>

			<h4 class="h5"><?=$page['title'];?></h4>
			<p>Date: <?=$page['date']; if($page['author'] != "") echo " - Auteur: " . $page['author'];?><br>
			<?=$page['text']; ?>
			<!-- Warning! install no space or tab in the link below.It create an w3c error -->
			<?php if($link == True) echo '
			<a href="' . PAGE_URL . 'page-from-pages-index&amp;id='. $page['id'] . '&amp;titre=' . $page['url']. '">
			Lire la suite
			</a>';
			?>
			<br />
			<?php
			if ($level <= 2){
				// The visitor has enough permissions, display the edition-link
			include_once(VIEW.'__menu-edition.php');
			}
			?>
			</p>
		</div>
	</article>

	<article class="col-sm p-3 pt-5">
		<h3 class="row">Contactez-moi!</h3>
		<div class="col-sm-12">
			<form action="<?=PAGE_URL . 'contact_verif';?>" method="post">
			  <div class="form-group">
				<label for="email">Email address *</label>
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