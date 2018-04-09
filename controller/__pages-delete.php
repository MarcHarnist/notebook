<?php
/*           _________________
            |                 |         
            |   FORMULAR BY   |        
            |   Marc Harnist  | 
			|                 |
            |    09/08/2017   |    
            |_________________|        
*/

include_once USER2; // This page reserved for level 1 & 2 users
include_once('model/get-one-page.php');// get the page in question

// Data put in security
foreach($pages as $page){
    $page['text'] = nl2br($page['text']);
    $page['date'] = date(('d/m/Y'),($page['date']));
}

if(isset($_POST['id'])) {
  $req = $db->prepare('DELETE FROM ' . TABLE_PAGES . ' WHERE id = :id'); // TABLE_PAGES defined in config file
  $req->execute(array('id' => $id));
  header('Location: ' . PAGE_URL . 'pages-index&categorie='.$page['category']);
}
