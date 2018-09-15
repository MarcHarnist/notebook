<?php
/**             Controlleur  __files-edition
*							
*	Système d'édition de fichiers
*	13/08/2017
*	ML-Harnist
*/  $website->membersPermissions(2, $member);

	if(isset($_GET['file']))
		$file = $_GET['file'];
	$fichier_en_cours = new Files;	// POO! $fichier_en_cours = objet qui ne contient rien pour l'instant
		// Function file_readers returns an array with file content
	$fichier_en_cours_de_lecture = $fichier_en_cours->file_reader($file);
	if($fichier_en_cours_de_lecture == False)
		exit("Le fichier: <span style=\"color:blue;\">\"$file\"</span> est introuvable.<br>Vérifiez le chemin! Il manque peut-être \"www/\" dans la vue \"__explorer\"");

	if(isset($_GET['operation']) && $_GET['operation'] == "supprimer"){
		$fichier_en_cours->supprimer_le_fichier($file);
		header("Location:  " . $website->redirection("__explorer#php") . "");
	}