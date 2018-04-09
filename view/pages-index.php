<section>
	<header class="row bg-light p-3	">
		<h2 class="row ml-0 text-muted">Index des pages de la catégorie "<?=$category;?>"</h2> 
	</header>

	<?php
		// Display the N° (id), the title and the date of the new choosen in a link to this new.
		foreach($pages as $page) {
			?>
			<section>
				<h3 id="<?=$page['id'];?>">
					<?php echo $page['title']; ?><br />
					<em><small><small>Le <?=$page['date'];?></em> <?php if($page['author'] != "") echo "Auteur: " . $page['author'];?> Catégorie: <?=$page['category'];?></small></small>
				</h3>
				
				<p>
					<?=$page['text'];?>
					<?php if($page['link'] == True) echo '...
					<a href="' . PAGE_URL . 'page-from-pages-index&amp;id='. $page['id'] . '&amp;titre=' . $page['url']. '">
					Lire la suite
					</a>';
					?>
				<br />
					<?php
					if ($level <= 2){
						// The user has enough permissions, display the edition-link
						include(VIEW.'__menu-edition.php');
					}
					?>
				</p>
			</section>
			<?php
		}
	?>
</section>