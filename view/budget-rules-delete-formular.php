<?php
        //////////////////////////////
       //                          //
      //   Tests pour le budget   //
     //        26/07/2017        //
    //                          //
   //////////////////////////////

$confirm = $id = "";


// Je récupère les données du formulaire
if(ISSET($_POST['ancre']))
{//L'ancre pour le lien de retour à la ligne.
  $ancre=$_POST['ancre'];
}
if(ISSET($_POST['id']))
{
  $id=htmlspecialchars($_POST['id']);
}
if(ISSET($_POST['confirm']))
{
  $confirm=$_POST['confirm'];
  $ancre=$ancre-7;
}
// Have we confirm delete ?
if($confirm == "oui")
{
  $req = $db->prepare('DELETE FROM rule WHERE id = :id');
  $req->execute(array(
    'id' => $id,
    ));
  header('Location: ' . $website->page_url . 'budget-rules#' . $ancre);
} // Close: if($confirm == "oui")... on line 71
else
{
  $reponse = $db->query("SELECT date, auteur, rule FROM rule WHERE id=$id");
  while ($donnees = $reponse->fetch())
  {
    $date=$donnees['date'];
    $auteur=$donnees['auteur'];
    $rule=$donnees['rule'];
  }
  $rule=ucfirst($rule);
  $question = "$rule du $date de l'auteur $auteur ?";

include "inc/budget-menu.php";?>

 
  <h3 class="warning">Attention ! Cette suppression sera définitive.</h3>
 <p><small><i><a href="<?= $website->page_url;?>budget-index">Index du budget</a></i></small></p>

  <h4>Etes-vous sur de vouloir supprimer l'entrée suivante:</h4>
  
  <?php
  
    echo "<p>$question</p>"; 
    $ancre_une = $ancre;	
    $ancre_une = $ancre_une-5;	
    $url_de_retour_en_arriere = "<?= $website->page_url;?>rule#$ancre_une";

	?>
  <form method="post" action="">
    <input type="hidden" name="confirm" value="oui" />
    <input type="hidden" name="id" value="<?php echo $id;?>" />
    <input type="hidden" name="ancre" value="<?php echo $ancre;?>" />
    <input class="nombre"  type="submit" value="Oui, je confirme la suppression." />
  </form>
  <form method="post" action="<?php echo $url_de_retour_en_arriere;?>">
    <input class="nombre"  type="submit" value="ANNULER" />
  </form>
  <?php
} // Close else on line 68.
