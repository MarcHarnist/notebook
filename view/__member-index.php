<?php
if (isset($member)){
	// If a member is connected:display informations
	?>
<section>
	<header class="row bg-light p-3	">
		<h2 class="row ml-0 text-muted">Bonjour <?=$name;?>, bienvenue sur votre profil</h2> 
	</header>
		<fieldset class = "fieldset_profil"> 	
			<legend><?= $name;?></legend>
			<p>Vous êtes connecté. Votre niveau: <?=$level;?></p>
			<?php
			if($level <= 2){
				?>
				<ul>
					<li>Gérer les pages
						<ul>
							<li>
										<a href="<?= PAGE_URL;?>__pages-creation" alt="Cliquez ici pour créer un page">
								Créer une page
										</a>
							</li>
							<li>
										<a href="<?= PAGE_URL;?>__pages-edition" alt="Cliquez ici pour éditer les pages">
								Editer les pages
										</a>
							</li>
							<li>
								<a title = "Modifier l'entête, le pied de page, le menu" href="<?=PAGE_URL;?>pages-index&amp;categorie=includes">
									Gérer les en-tête, pied-de page, menus...
								 </a>
							</li>		 
						</ul>
					</li>
				<?php
			}
			if($level == 1){
				?>
					<li>
						<a href="<?= PAGE_URL;?>__member-register" alt="Cliquez ici pour ajouter un membre">
							Gérer les Membres
						</a>
					</li>
					<li>
						<a href="<?= PAGE_URL;?>__sql-index" alt="Cliquez ici sauver sql db">
							Sauvegarder la base de donnée
						</a>
					</li>
					
				</ul>
				<?php
			}
			?>
		</fieldset>
	</section>
	<?php
} else header('Location: ' . PAGE_URL . 'member-connection');