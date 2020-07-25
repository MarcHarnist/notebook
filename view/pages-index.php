<?php
	isset($category) ? '': exit("root/view/page-index Erreur: contrôleur absent?");//Vérifie que $category existe, sinon affiche un message d'erreur.
?>
<header>
	<h2 class="text-secondary bg-white mt-3">Index des pages de la catégorie "<?=$category;?>"</h2> 
</header>

<?php
// Display the N° (id), the title, the author and the date of the new choosen in a link to this new.
foreach($pages as $page_en_cours_de_lecture)
{
	?>
	<article>
		<header>
			<h3
				class = "bg-white text-secondary"
				id="<?=$page_en_cours_de_lecture['id'];?>">
				<?php echo '<a href="' . $website->page_url . 'page-from-pages-index&amp;id='. $page_en_cours_de_lecture['id'] . '&amp;titre=' . $page_en_cours_de_lecture['url']. '" target="_blank">'.$page_en_cours_de_lecture['title'].'</a>';
				?>
				<em><small><small>
				<?php 
				if ($editor_display) include("view/".'__menu-edition.php'); ?>
				<br />
				<?php if(BLOG_DATE_DISPLAY === "yes"): ?>
				Le <?=$page_en_cours_de_lecture['date'];?></em> 
				<?php endif;?>
				
				<?php if(BLOG_AUTHOR_DISPLAY === "yes" && $page_en_cours_de_lecture['author'] != "") echo "Auteur: " . $page_en_cours_de_lecture['author'];?></small></small>
			</h3>
		</header>
		<section>
			<?=$page_en_cours_de_lecture['text'];?>
		</section>
					<?php if($editor_display):?>
		<p class="icon"><?php include_once("view/".'__menu-edition.php');?></p>
					<?php endif; ?>
	</article>
	<?php
}