<?php

include_once USER2;

$count = $count_sql = $count_dir = $count_php= 1;
$autres_fichiers = $repertoires = $fichiers_sql = $fichiers_php = "";
$dir = "./sql/";
//	si le dossier pointe existe
if (is_dir($dir)) {
	 // si il contient quelque chose
	 if ($dh = opendir($dir))
	 {
		// boucler tant que quelque chose est trouve
		while (($file = readdir($dh)) !== false) {
			// affiche le nom et le type si ce n'est pas un element du systeme
			$type = filetype($dir.$file);
			if( $file != '.' && $file != '..' && $file !== 'programme') {
				// Est-ce un repertoire ou un fichier? Si oui l'affichage sera différent
				if($type == 'dir') {
					$url = $file;
					$file = ucfirst($file);//On met une majuscule. Plus joli.
					$repertoires .= "<br />$count_dir. <a href=\"./$url\">$file</a> ";
					$count_dir++;
				}
				else {
					// Ce n'est pas un repertoire mais un fichier
					// Récupération de l'extension
					$extension = pathinfo($file, PATHINFO_EXTENSION);
					if($extension == 'sql') {
						$url = $file;
						$file = ucfirst($file);//On met une majuscule. Plus joli.
						$fichiers_sql .= "<br />$count_sql. <a href=\"./$url\">$file</a> ";
						$count_sql++;							
					}
					elseif($extension == 'php') {
					/* si le fichier ne contient pas __ on l'afiche dans le menu.*/
					$url = $file;
					$file = ucfirst($file);//On met une majuscule. Plus joli.
					$fichiers_php .= "<br />$count_php. <a href=\"./$url\">$file</a> ";
					$count_php++;
					}
					else {
						// tous les autres fichiers
						/* si le fichier ne contient pas __ on l'afiche dans le menu.*/
						$url = $file;
						$file = ucfirst($file);//On met une majuscule. Plus joli.
						$autres_fichiers .= "<br />$count. <a href=\"$dir$url\">$file</a><br /	> ";
						$count++;
					}
				}
			}
		}
		// on ferme la connection
		closedir($dh);
	}
}
