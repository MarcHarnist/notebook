<?php
/**    Contrôleur Budget-mail
*          Marc L. Harnist
*
*  Date: 23/08/18
*
**/
$website->membersPermissions(1, $member);


if(isset($_POST['message_de_la_page_budget_rapport']))
  $message_de_la_page_budget_rapport = ($_POST['message_de_la_page_budget_rapport']);

if(isset($_POST['message_de_la_page_budget_mail'])){
  $message_de_la_page_budget_rapport = $_POST['message_de_la_page_budget_mail'];
  $destinataires = "harnist.marc@gmail.com; harnist.isabelle@gmail.com";
  $objet = "Coup d'oeil sur le budget...";
  $header = "Content-Type: text/html; charset=UTF-8; ";
  
  /* Envoi du mail */
  mail( $destinataires , $objet , $message_de_la_page_budget_rapport , $header );
  $mail_sent = True;//Pour la vue: si on a fait un envoi on affiche le message envoyé.
}