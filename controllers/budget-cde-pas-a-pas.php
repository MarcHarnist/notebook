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

/** Récupération de la dernière entrée du panorama pour les afficher dans la vue.
*   Le crédit et l'épargne varient lentement.
*/  $panorama_last_entry = new PanoramaCde;

//Security
if(isset($_POST['operation']) && $_POST['operation'] == "creation"){
  $update = new Database;
  $update->update_table_cde_panorama('budget_cde_panorama', $_POST);
}