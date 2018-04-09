<?php

/*******************************************************************************************************/
/** OBJECT ORIENTED PROGRAMMING LANGAGE                                                               **/
/*******************************************************************************************************/
/** CLASS FormManager                                                                                 **/
/*******************************************************************************************************/
/** NAME: FormManager                                                                                 **/
/*******************************************************************************************************/
/** AUTHOR: Marc L. Harnist                                                                           **/
/*******************************************************************************************************/
/** CREATION: 23/03/2018                                                                              **/
/*******************************************************************************************************/
/** UPDATED: 23/03/2018                                                                               **/
/*******************************************************************************************************/
/** FILE USING THIS CLASS: http://marcharnist.fr/zoo/controller/depart.php                            **/
/**                                                                                                   **/
/*******************************************************************************************************/
/** FUNCTION INSIDE: __construct, constructor of the object                                           **/
/**                                                                                                   **/
/*******************************************************************************************************/
class FormManager {

	public $form = array();
	public $id = 0;
	
	// Constructer
	public function __construct($post){
		$id = $this->id;
		$this->form = $this->manager($post);
	}
	
	
	// On récupère les données d'un formulaire
  	public function manager($post){
		foreach($post as $label => $value)//Traitement du formulaire dans une boucle!
		{
			$form[$this->id] = [0 => htmlspecialchars($label), 1 => htmlspecialchars($value)];
			$this->id++;
		}
		
		$liste = ""; //liste de la commande des animaux qui sera affichée après le foreach
		foreach($form as $id => $animal) //$zoo['form']= données du formulaire, key = id, $animal = espèce et nombre
		{
			
			$row = implode(";", $animal);
			$row = $id . ";" . $row;
			
			//le nombre d'animaux achetés pour chaque espèce et le nom de l'espèce sont mis en mémoire dans $liste
			$liste .= $row . "\n"; //
			
			$id++; // pour commencer à 1 au lieu de 0
			
		}
		// var_dump($liste);
		$content = new Database($liste); // prepare a content for database
		$content->create_database($liste); //register the content in database
		return $form;
	}

	/**********************************************************************************************/
	/****** Nom : accorder_pluriels                                                          ******/
	/**********************************************************************************************/
	/****** Description : rajoute un s, un x ou rien (ex: rhinoceros a déjà un s)            ******/
	/******               et le colle dans un tableau qu'elle retourne                       ******/
	/******                                                		                             ******/
	/**********************************************************************************************/
	/****** Paramètres : [string] substentif à accorder au pluriel                           ******/
	/******              [int]    nombre                                                     ******/
	/**********************************************************************************************/
	/****** Valeurs retournées : [string] avec une lettre en plus ou rien en plus            ******/
	/**********************************************************************************************/
	/****** Auteur : Marc L. Harnist                                                         ******/
	/**********************************************************************************************/
	/****** Version : 1.0                                                                    ******/
	/**********************************************************************************************/
	/****** Créée le : 25/03/2018                                                            ******/
	/**********************************************************************************************/
	/****** Modifiée le : 25/03/2018                                                         ******/	/**********************************************************************************************/
  	public static function accorder_pluriels($mot, $nombre){
		if($nombre>1){
			if($mot == "chameau"){
				$mot .= "x";
			}
			elseif($mot == "rhinoceros"){
				$mot = $mot;
			}
			else {
				$mot .= "s";
			}
		}
		return $mot;
	}
	
	
	/**********************************************************************************************/
	/****** Nom : cleaner                                                                    ******/
	/**********************************************************************************************/
	/****** Description : nettoie les noms de caractères spéciaux                            ******/
	/******                                                		                             ******/
	/**********************************************************************************************/
	/****** Paramètres : [string] chaîne à nettoyer                                          ******/
	/******              [string] caractère à ôter                                           ******/
	/**********************************************************************************************/
	/****** Valeurs retournées : [string] avec une lettre en plus ou rien en plus            ******/
	/**********************************************************************************************/
	/****** Auteur : Marc L. Harnist                                                         ******/
	/**********************************************************************************************/
	/****** Version : 1.0                                                                    ******/
	/**********************************************************************************************/
	/****** Créée le : 25/03/2018                                                            ******/
	/**********************************************************************************************/
	/****** Modifiée le : 25/03/2018                                                         ******/	/**********************************************************************************************/
  	public static function cleaner($mot, $caractere){
		$mot = str_replace($caractere, " ", $mot);
		return $mot;
	}
	
	/* Getter function  */
	public function getForm(){
		$form = $this->form;
		return $form;
	}
}  
  
