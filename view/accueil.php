<article>
	<header class="bg-light p-3">
		<h2 class="row text-muted">Accueil</h2>
		<h3 class="h4 text-muted ml-3">Bienvenue sur <?=$website::NAME;?></h3>
	</header>	
		
	<div class="col-sm-12">
		<h3 class="row h4 text-muted">Dernières nouvelles</h3>
		
		<?php
		// Display the N° (id), the title, the author and the date of the new choosen in a link to this new.
			?>
			<h4 class="h5 text-muted"><a href="<?= $website->page_url . 'page-from-pages-index&id='. $page_en_cours_de_lecture['id'] . '&titre=' . $page_en_cours_de_lecture['url'];?>"><?=$page_en_cours_de_lecture['title'];?></a></h4>
			
			<p>
				<small>
					<em>
						<?php
						if(isset($member) && $member->level <= 2){
						
							// The user has enough permissions, display the edition-link
							// Le menu d'édition, de création de pages ou de suppression
							include('view/__menu-edition.php');
						}
						?>
						Le <?=$page_en_cours_de_lecture['date'];?>
					</em> <?php if($page_en_cours_de_lecture['author'] != "") echo "Auteur: " . $page_en_cours_de_lecture['author'];?>
				</small>
			</p>		

			<?=$page_en_cours_de_lecture['texte_entier']; // 10 000 000 chars = texte en entier. 
			// On pourrait utiliser aussi: $page_en_cours_de_lecture['texte_entier'];?>
			
			<!-- Warning! install no space or tab in the link below. It creates an w3c error -->
			
			<?php
				if($page_en_cours_de_lecture['link'] == True) echo '
			<a href="' . $website->page_url . 'page-from-pages-index&id='. $page_en_cours_de_lecture['id'] . '&titre=' . $page_en_cours_de_lecture['url']. '">
			Lire la suite
			</a>';
			?>
			<br />
			<?php
			if(isset($member) && $member->level <= 2){
				// The visitor has enough permissions, display the edition-link
			include_once('view/__menu-edition.php');
			}
		?>
		
	</div>
</article>

<article class="col-sm p-3 pt-3">
	<h4 class="row text-muted">Catégories</h4>
	<div class="col-sm-12">
		<ul>
						<?php
			foreach($categories as $categorie){
						?>
					<li>
						<a href="<?= $website->page_url;?>pages-index&categorie=<?=$categorie;?>"><?=ucfirst($categorie);?></a>
					</li>
						<?php
			}
						?>
		</ul>
	</div>
</article>
