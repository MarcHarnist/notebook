<?php
$website->membersPermissions(1, $member);

$database = new Database;// Connect to database and class Methods
$rules = $database->getOneEntryById("budget_rules", $_POST['id']); // On veut une seule page par son id

if(isset($_POST['id']) && isset($_POST['id-deleted'])) {
  $suppresion = $database->delete($_POST['id'], "budget_rules");
  header('Location: ' . $website->page_url . 'budget-rules#' . $_POST['ancre']);
}

