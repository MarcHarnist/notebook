<?php
/*************************************************** 
*	This file is installed in "controller"	directory
*	Marc Harnist 2017/10/08
*
*****************************************************/

$save_pseudo = "";
$message = new Message();// My first class self made ! 08/2017 MarcL.Harnist

if (isset($_POST['utiliser']) && isset($_POST['name']) && isset($_POST['password'])) // Si on a voulu utiliser se connecter.
	{
	include_once("model/get_member.php"); // include model/ludacm/get_player.php
	$members = get_member(0,500);//500 = all members !

	// Data processing (controller) and secure the display
	foreach($members as $cle => $member) {
		$members[$cle]['id'] = nl2br(htmlspecialchars($member['id']));
		$members[$cle]['name'] = nl2br(htmlspecialchars($member['name']));
		$members[$cle]['password'] = htmlspecialchars($member['password']);
		$members[$cle]['level'] = htmlspecialchars($member['level']);
	}

	$save_pseudo = ($_POST['name']);// To conserve the value in form
	$manager = new MembersManager($db); // New object with data base informations
	if(empty($_POST['name']))
	{
	$message->setRed("Choisissez un pseudo");
	unset($member);
	}
	elseif ($manager->exists($_POST['name'])) // Si celui-ci existe.
	{	
		if(empty($_POST['password'])) {
			$message->setRed("Vous avez oublié le mot de passe !");
			unset($member);	
		}
		else {
			$member = new Member(['name' => $_POST['name']]); // On crée un nouveau personnage.
			$password = $_POST['password'];
			$hash = hash('ripemd160',$password);
			$member = $manager->get($save_pseudo);
			$hash_db = $member->password();
			if($hash_db === $hash) {
				//the good password we continue - If the member had informe
				// THE MEMBER IS WELL CONNECTED	//	
				$member = $manager->get($_POST['name']);
				$name = $member->name();
				$member = $name;
				$_SESSION['member'] = $member;
				
				// header('Location: ' . PAGE_URL . 'membre-index');
				
			}
			else {
				$message->setRed("Mot de passe érroné...</h3>");
				unset($member);
				// exit();
			}
		}
	}
	else {
	$message->setRed("Erreur dans le nom. <a href=\" " . PAGE_URL . "contact\">Contactez-nous.</a>"); // S'il n'existe pas, on affichera ce message.
	}
}
if(isset($member)) {
	// var_dump($member);
	// $level = $member->level();
	// if($level == 1){
		// echo "L'administrateur est connecté.";
		// If connected, go to profil page
		header('Location: ' . PAGE_URL . '__member-index');
	// }
}
