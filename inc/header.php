<!doctype html>      <!-- www/inc/header  1.0 Hi!  -->
<html lang="fr">
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="viewport" content="width=device-width"/>
		<meta http-equiv="Content-Type" Content="text/html; charset=UTF-8">
		
					<!-- Title of the page -->
		<title>Marc Harnist Notebook</title>

		<!-- If a css file exists for this page -->
		<?=$page->css; // Displays the css link here ?>

		<!-- Awesome font -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/v4-shims.js"></script>
		
		<!-- Bootstrap (look at the bootom too) -->
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		
		
		<style>
			 body {background: url('img/background.jpg') top no-repeat fixed; background-size: cover;}
			.container {background:white;} header, footer {background:#082543;}
		</style>
			
	<body>
		<div class="container pb-5 bg-light">
			<header class="row p-2">
				<figure>
					<a href="<?=$website->website_url;?>">
						<img
							class="rounded-circle" 
							src="img/notebook_logo.png" 
							alt="Logo: Marc Harnist"
							height="75">
					</a>
				</figure>
				<aside class="col-md-3 float-left">
					<h1><a href="<?=$website->website_url;?>">Marc Harnist <i>Notebook</i></a></h1>
					
				</aside>
				<ul class="nav col-md-8 h6 justify-content-end"><!-- usefull to W3C-validator -->
					<li class="nav-item">
						<a class="nav-link"  title = "Accueil" href="<?=$website->website_url;?>">
						<i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link"  title = "Page contact" href="<?= $website->page_url;?>contact">
						<i class="fa fa-envelope-o fa-fw fa-2x" aria-hidden="true"></i> 
						</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie: news" href="<?= $website->page_url;?>pages-index&categorie=news">
						 <i class="fas fa-newspaper fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie: versioning" href="<?= $website->page_url;?>pages-index&categorie=versioning">
						 <i class="fa fa-code-fork fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie: lexique" href="<?= $website->page_url;?>pages-index&categorie=lexicon">
						 <i class="fa fa-book fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  idées" href="<?= $website->page_url;?>pages-index&categorie=idees"><!-- IE no accent in url! -->
						 <i class="fa fa-lightbulb fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  outils" href="<?= $website->page_url;?>pages-index&categorie=tools">
						 <i class="fas fa-wrench fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  PHP et POO" href="<?= $website->page_url;?>pages-index&categorie=PHP">
						 <i class="fab fa-php fa-2x"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  JS" href="<?= $website->page_url;?>pages-index&categorie=JS">
						 <i class="fab fa-js-square fa-2x"></i>
						 </a>
					</li>
					<li class="nav-item h2">
						<em>
							<a class="nav-link"  title = "Catégorie:  Symfony" href="<?= $website->page_url;?>pages-index&categorie=symfony">
							 Symfony
							<i class="icon-symfony"></i>
							</a>
						</em> 
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  JS" href="<?= $website->page_url;?>pages-index&categorie=Java">
						 <i class="fab fa-java fa-2x"></i>
						 </a>
					</li>					
					
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie: MySql" href="<?= $website->page_url;?>pages-index&categorie=MySql">
						 <i class="fas fa-database fa-2x"></i>
						 </a>
					</li>
					
					<li class="nav-item h2">
						<a class="nav-link"  title = "Tests" href="<?= $website->page_url;?>pages-index&categorie=tests">
						<i>Tests</i>
						</a>
					</li>
					
					<li class="nav-item">
						 <a class="nav-link"  title = "Se connecter" href="<?= $website->page_url;?>connexion">
						 <i class="fa fa-user fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
						<!-- ESPACE MEMBRE - BOUTONS DE CONNEXION -->
						<?php
							if(isset($_SESSION['member'])){
								// var_dump($_SESSION['member']);die();
						?>
					<li class="nav-item">
						<a class="nav-link text-danger"  title = "Se déconnecter" href="<?= $website->page_url;?>__member-deconnection"><i class="fa fa-power-off fa-2x text-danger" aria-hidden="true"></i>
						 </a>
					</li>
						<?php
							}
						?>
				</ul>
			</header>
