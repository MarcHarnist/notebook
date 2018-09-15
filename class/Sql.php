<?php
/*******************************************************************************************************/
/** OBJECT ORIENTED PROGRAMMING LANGAGE                                                               **/
/*******************************************************************************************************/
/** CLASS Sql                                                                                         **/
/*******************************************************************************************************/
/** AUTHOR: Marc L. Harnist                                                                           **/
/*******************************************************************************************************/
/** CREATION: 23/03/2018                                                                              **/
/*******************************************************************************************************/
/** UPDATED: 23/03/2018                                                                               **/
/*******************************************************************************************************/
/** FILE USING THIS CLASS: root/controllers/__sql.php                                                 **/
/**                                                                                                   **/
/*******************************************************************************************************/
/** FUNCTION INSIDE: __construct, constructor of the object                                           **/
/**                                                                                                   **/
/*******************************************************************************************************/
class Sql extends Database {
	
	
	public $path;
	public $savedFile;

	// Constructer
	public function __construct(){
		parent::__construct();
		// $this->download();
	}
	
	public function download(){
		
		// Constants from models/config
		$MYSQLhost = $this->db_host;
		$MYSQLuid  = $this->db_username;
		$MYSQLpwd  = $this->db_password;
		$MYSQLdb   = $this->db_name;

		$date_string   = date("Y-m-d-");
		$time = time();
		$date_string .= $time;

		// Ensemble des tables éventuelles à exclure complètement
		$excludedTables = array(
		'tlb_topsecret',
		);
		// Ensemble des tables éventuelles dont on ne veut sauvegarder que la structure
		$onlyStructureTables = array(
		'tlb_historique',
		);
		// On spécifie le chemin absolu où le script stockera les sorties .gz
		$this->path = 'backups/sql/';

		// On démarre la connexion
		$conn = new PDO("mysql:host=$MYSQLhost;dbname=$MYSQLdb", $MYSQLuid, $MYSQLpwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

		// On liste d’abord l’ensemble des tables
		$result = $conn->query("SHOW TABLES");
		$tables = array();
		// On exclut éventuellement les tables indiquées
		while ($row = $result->fetch()) {
			if (!in_array($row[0], $excludedTables)) {
			$tables[] = $row[0];
			}
		}
		// La variable $return contiendra le script de sauvegarde.
		// On englobe le script de backup dans une transaction
		// et on désactive les contraintes de clés étrangères
		$return = '--
		-- Hôte : ' . $MYSQLhost . '
		-- Date et heure : ' . date('d/m/Y à H:i:s') . '
		-- Base de données : `' . $MYSQLdb . '`
		--
		SET FOREIGN_KEY_CHECKS=0;
		SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
		SET AUTOCOMMIT=0;
		START TRANSACTION;
		';
		// On boucle sur l’ensemble des tables à sauvegarder
		foreach ($tables as $table) {
			// On ajoute une instruction pour supprimer la table si elle existe déjà
			$return .= "DROP TABLE IF EXISTS `$table`;\n";
			// On génère ensuite la structure de la table
			$result = $conn->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
			$return .= $result['Create Table'] . ";\n\n";
			// Si la table n’est pas marquée à sauver en tant que "structure seule"
			if (!in_array($table, $onlyStructureTables)) {
			$result = $conn->query("SELECT * FROM `$table`");
			// On boucle sur l’ensemble des enregistrements de la table
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$return .= "INSERT INTO `$table` VALUES(";
				// On boucle sur l’ensemble des champs de l’enregistrement
				foreach ($row as $fieldValue) {
				// On purifie la valeur du champ
				$fieldValue = addslashes($fieldValue);
				$fieldValue = preg_replace("/\r\n/", "\\r\\n", $fieldValue);
				$return .= '"' . $fieldValue . '", ' ;
				}
				// On supprime la virgule à la fin de la requête INSERT
				$return = mb_substr($return, 0, -2) . ");\n";
			}
			$return .= "\n";
			}
		}
		// On valide la transaction
		// et on réactive les contraintes de clés étrangères
		$return .= 'SET FOREIGN_KEY_CHECKS=1;
		COMMIT;';
		$conn = null;
		// On enregistre maintenant le script SQL dans un fichier au format gzip
		$this->savedFile = 'BKP-' . date('d-m-Y_H-i-s') . '-' . md5(implode(',', $tables)) . '.sql.gz';
		$gz = gzopen($this->path . $this->savedFile, 'w9');
		gzwrite($gz, $return);
		gzclose($gz);
	}
	
	public function supprimer($table){

		try{
			$mysq_request = 'DROP TABLE ' . $table;
			$stmt = $this->db->query($mysq_request);
			$stmt->execute();
		}
		catch(Exception $e){
			return $e;
		}
		return True;
	}	

	public function charger_db($base_name){
		try{
		$mysq_request = '';
		$stmt = $this->db->query($mysq_request);
		$stmt->execute();
		}
		catch(Exception $e){
			return $e;
		}
		return True;
	}

	public function creer_db(){
		try{
		$mysq_request = '';
		$stmt = $this->db->query($mysq_request);
		$stmt->execute();
		}
		catch(Exception $e){
			return $e;
		}
		return True;
	}
}