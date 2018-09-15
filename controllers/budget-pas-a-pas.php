<?php

//////////////////////////////////////////////////////////////////////////////////////////
//
//  J'ai frabriqué une page pour traiter l'objet du budget en langage php
//  M. Harnist 14 Juillet 2017 
//
//////////////////////////////////////////////////////////////////////////////////////////

/**
*   MAJ: 16/08/18 suppression rooter
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

/** Récupération de la dernière entrée su panorama pour les afficher dans la vue.
*   Le crédit et l'épargne varient lentement.
*/  $panorama_last_entry = new Panorama;

if(isset($_POST['operation']) && $_POST['operation'] == "creation")//Security
{
  $update = new Database;
  $update->update_table_panorama('budget_panorama', $_POST);
}