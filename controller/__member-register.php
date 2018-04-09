<?php

include_once USER1;

$save_pseudo = '';
$message = new Message();// My first class self made ! 08/2017 MarcL.Harnist

if (isset($_POST['creer']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['level'])) {
	// Si on a voulu créer un membre
	include_once("model/get_member.php"); // include model/ludacm/get_member.php
	$members = get_member(0,500);//500 = all members !

	// On effectue du traitement sur les données (contrôleur)
	// Ici, on doit surtout sécuriser l'affichage
	foreach($members as $cle => $member) {
		// id, name, password, level
		$members[$cle]['id'] = nl2br(htmlspecialchars($member['id']));
		$members[$cle]['name'] = nl2br(htmlspecialchars($member['name']));
		//register autoload which will load the class
	}

	// Create OOP objects
	$manager = new MembersManager($db); // Object created: Data base manager
	$save_pseudo=($_POST['name']);// To conserve the value in form
	$member = new Member(['name' => $_POST['name']]); // On crée un nouveau membernnage.
	$new_member_level = $_POST['level'];
	$password = $_POST['password'];
	$member->setPassword($password);
	$hash = hash('ripemd160',$password);// the password is crypted for security!
	if (!$member->nameValide()) {
		// cannot be empty
		$message->setRed("La case pseudo est vide: choisissez un pseudo.");
		unset($member);
	}
	elseif ($manager->exists($member->name())) {
		// go read in the dbtable if name is free
		$message->setRed("Le nom du membre est déjà pris. Merci de choisir un autre nom.");
		unset($member);
	}
	elseif(!$member->passwordValide()) {
	// cannot be empty
		$message->setRed("Vous avez oublié de choisir un mot de passe.");
		unset($member);
	}
	else { 
		// Everythings are ok.The member can be registered
		$member->setPassword($hash);// hashed password registered in data base member
		$member->setLevel($new_member_level);
		$manager->add($member); // The name is free: create a new member in data base
		$creation = True;
		$new_member_name = htmlspecialchars($member->name());
		$new_member_level = htmlspecialchars($member->level());
	}
}
if(isset($member)){
	$level = $member->level();
	$name = $member->name();
}
