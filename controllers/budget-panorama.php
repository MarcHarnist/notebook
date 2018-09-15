<?php
              //////////////////////////////////
             //                              //
            //  Coup d'oeil sur le compte   //
           //   09/08/2017  Marc Harnist   //
          //                              //
         //////////////////////////////////


/**
*   MAJ: 16/08/18
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

	$save_pseudo = $name = $level = '';
	$count=1;
	$ancre=0;
	$size=5;
	$dateInputSize = 7;

	$authorization = True;
	
	$read = new Database;
	$datas = $read->read_table("budget_panorama");