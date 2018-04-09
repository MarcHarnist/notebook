<section>
	<header class="row bg-light p-3	">
		<h2 class="row ml-0 text-muted">
			N° <?=$page['id']?> - <?=$page['title']?><br />
			 <em><small><small>&nbsp;- Le <?=$page['date'];?> Catégorie: <?=$page['category'];?></small></small></em>	
		</h2> 
	</header>
	<!-- Display only one page, choosen in pages-index -->
	<!-- M.Harnist 07/03/2018 (created 02 octobre 2017 for the pages -->
	<p><?=$page['text'];?></p>
	<p class="icon">
		<?php
		if (isset($editor) && $editor == True){
			// $editor == True? (see pages-all.php in controller directory...
			// The visitor has enough permissions, display the edition-link
			include_once(VIEW.'__menu-edition.php');
		}
		?>
	</p>
</section>

