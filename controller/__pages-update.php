<?php
  
/* Système de pages...  13/08/2017 Marc Laurent Harnist */
/* We arrive here from the file: view/__pages-edition.php & view/__pages-creation  */

include_once USER2;
$table = TABLE_PAGES; // Database table defined in config file
$operation = $N° = $page_id = $date = $title = $text = $format = $vide = $category = 0; 

//Get formular datas: $operation: creation? Updating? Delete?
if(isset($_POST['operation'])) $operation = htmlspecialchars($_POST['operation']);
if(isset($_POST['N°']))        $N° = htmlspecialchars($_POST['N°']); // id editable in __page-edition
if(isset($_POST['page_id']))   $page_id = htmlspecialchars($_POST['page_id']); // save old id
if(isset($_POST['auteur']))  $author = htmlspecialchars($_POST['auteur']);
if(isset($_POST['category']))  $category = htmlspecialchars($_POST['category']);
if(isset($_POST['category_new']))  $category_new = htmlspecialchars($_POST['category_new']);
if($category_new !== '' && isset($_POST['category_new'])) $category = $category_new;
if(isset($_POST['date'])){
    $date=htmlspecialchars($_POST['date']);
	if($date == '') { $error_message = $vide = True;}
	elseif(!preg_match( '`(\d{1,2})/(\d{1,2})/(\d{4})`' , $date )) { 
		$error_message = $format = True;}
	else {
		$date = str_replace('/','-',$date);// replace / to - for strtotime
		$date = strtotime($date, time());// turn date to timestamp
	}
}
if(isset($_POST['title'])) $title = $_POST['title'];
if(isset($_POST['text'])) $text = ($_POST['text']);

// CREATIONS
if(!isset($error_message) && $operation == "creation") {
	// Looking for the last N° for redirect and display the page at end 
	include_once('model/get_pages_by_id.php');
	$pages = get_pages(0,1);
	$N° = $page['N°']+1; // $N° serves at the end to redirect
	$req = $db->prepare('INSERT INTO '. $table .'(date, author, title, text, category) VALUE(:date, :author, :title, :text, :category)');
	$req->execute(array(
						 'date' => $date,
						 'author' => $author,
						 'title' => $title,
						 'text' => $text,
						 'category' => $category,
						 ));
} 

// UPDATES
if(!isset($error_message) && $operation == "update"){
	// It's an update (mise à jour)
	$req = $db->prepare('UPDATE ' . $table . ' SET id = :page_id, date = :date, author = :author, title = :title, text = :text, category = :category WHERE id = :id');
	$req->execute(array(
	 'page_id' => $page_id,
	 'date' => $date,
	 'author' => $author,
	 'title' => $title,
	 'text' => $text,
	 'category' => $category,
	 'id' => $N°,
	 ));
}
// If no error, display pages-index page
if(!$error_message) header ('location: ' . PAGE_URL . 'pages-index&categorie=' . $category . '#' . $N°);
