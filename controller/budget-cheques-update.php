﻿<?php

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

	$update = new Database;
    $ancre = $update->update_table_budget_cheques('budget_cheques', $_POST);

	header ('Location: ' . $website->page_url . 'budget-cheques#' . $ancre . '');
