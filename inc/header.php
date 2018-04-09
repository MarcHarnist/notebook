<!doctype html>      <!-- www/inc/header  -->
<html lang="fr">
	<head>
	
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="viewport" content="width=device-width"/>
		<meta http-equiv="Content-Type" Content="text/html; charset=UTF-8">
		
		<title><?=WEBSITE_NAME . ' ' . $file['title'];?></title>
		
		<!-- If a css file exsits for this page -->
		<?=$file['css']; // Displays the css link here ?>

		<!-- Awesome font -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/v4-shims.js"></script>
		
		<!-- Bootstrap (look at the bootom too) -->
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		
		<style>
			 body {background: url('img/background.jpg') top no-repeat fixed; background-size: cover;}
			.container {background:white;} header, footer {background:#082543;}
		</style>
			
	</head>
	<body>
		<div class="container pb-5 bg-light">
			<header class="row p-2">
				<figure>
					<a href="<?=WEBSITE_URL;?>">
						<img
							class="rounded-circle" 
							src="img/logo.jpg" 
							alt="Logo: Avatar playmobile barbu avec chemise hawaïenne pour Marc Harnist"
							height="75">
					</a>
				</figure>
				<aside class="col-md-3 float-left">
					<h1><a href="<?=WEBSITE_URL;?>"><?=WEBSITE_NAME;?></a></h1>
					<h2 class="h6"><a href="<?=WEBSITE_URL;?>">Un CMS créé par Marc L. Harnist</a></h2>
				</aside>
				<nav class="nav col-md-8 h6 justify-content-end"><!-- New html5 element - by Marc L. Harnist -->
					<li class="nav-item">
						<a class="nav-link"  title = "Accueil" href="<?=WEBSITE_URL;?>">
						<i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i> 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link"  title = "Page contact" href="<?=PAGE_URL;?>contact">
						<i class="fa fa-envelope-o fa-fw fa-2x" aria-hidden="true"></i> 
						</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie: news" href="<?=PAGE_URL;?>pages-index&amp;categorie=news">
						 <i class="fas fa-newspaper fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie: versioning" href="<?=PAGE_URL;?>pages-index&amp;categorie=versioning">
						 <i class="fa fa-code-fork fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie: lexique" href="<?=PAGE_URL;?>pages-index&amp;categorie=lexicon">
						 <i class="fa fa-book fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  idées" href="<?=PAGE_URL;?>pages-index&amp;categorie=idees"><!-- IE no accent in url! -->
						 <i class="fa fa-lightbulb fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  outils" href="<?=PAGE_URL;?>pages-index&amp;categorie=tools">
						 <i class="fas fa-wrench fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  POO" href="<?=PAGE_URL;?>pages-index&amp;categorie=POO">
						 <i class="fab fa-php fa-2x"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  JS" href="<?=PAGE_URL;?>pages-index&amp;categorie=JS">
						 <i class="fab fa-js-square fa-2x"></i>
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Catégorie:  Symfony" href="<?=PAGE_URL;?>pages-index&amp;categorie=symfony">
						 sf
						 </a>
					</li>
					<li class="nav-item">
						 <a class="nav-link"  title = "Se connecter" href="<?=PAGE_URL;?>member-connection">
						 <i class="fa fa-user fa-2x" aria-hidden="true"></i>
						 </a>
					</li>
					<?php
						if(isset($_SESSION['member'])){
							?>
							<li class="nav-item">
								<a class="nav-link text-danger"  title = "Se déconnecter" href="<?=PAGE_URL;?>__member-deconnection"><i class="fa fa-power-off fa-2x text-danger" aria-hidden="true"></i>
								 </a>
							</li>
							<?php
						}
						?>
				</nav>
			</header>
