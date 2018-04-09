<?php

/*****************************************************
*  This fill is installed in "controller"  directory
*  Thanks for all reviews.  Marc Harnist 2017/10/08
*****************************************************/

include_once("model/get_member.php"); // include model/ludacm/get_member.php
$members = get_member(0,500);//500 = all members !

foreach($members as $cle => $member) {
	// controller-> security here
    $members[$cle]['id'] = nl2br(htmlspecialchars($member['id']));
    $members[$cle]['name'] = nl2br(htmlspecialchars($member['name']));
    $members[$cle]['password'] = htmlspecialchars($member['password']);
	$members[$cle]['level'] = htmlspecialchars($member['level']);
}
function chargerclass($classname) {
//enregistre l'autoload qui va charger les class
  require ROOT . 'class/' . $classname.'.php'; // names of each class
}
spl_autoload_register('chargerclass'); //maintenant les class sont chargées

$manager = new MembersManager($db); // Object created: Data base manager

if (isset($_SESSION['member'])){ // If session member exists, restore object
	$member = $_SESSION['member'];
	$member = $manager->get($member);//not forget "get"! else: db do not update
	$name_s = $member->name();
	$name = $member->name();
	$name = ucfirst($name);
	$level = $member->level();
}
