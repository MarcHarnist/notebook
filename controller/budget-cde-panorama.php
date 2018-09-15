<?php
              //////////////////////////////////
             //                              //
            //  Coup d'oeil sur le compte   //
           //   09/08/2017  Marc Harnist   //
          //                              //
         //////////////////////////////////
		 
/*  Mise à jour: 16/08/18 suppression du rooter inclu
*   au bas du fichier index.php
*
*   Réservé au webmaster (permission 1 cf: classe Website)
*/  $website->membersPermissions(1, $member);
    $save_pseudo = $name = $level = '';
	$count=1;
	$ancre=0;
	$size=5;
	$dateInputSize = 7;

	$authorization = True;
	
	$database = new Database;
	$panorama = $database->read_table('budget_cde_panorama');
