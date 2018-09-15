<!--
####################################################################################

                              Vue budget-cde-echeancier
                                 Marc L. Harnist
                                      2017
                               
#####################################################################################
-->
<h2>Chèques à la Caisse d'Epargne (Marc)</h2>

<?php include "inc/budget-cde-menu.php";?>

<!--
###################### TABLEAU D'AFFICHAGES DE TOUS LES CHEQUES ###################### -->
<table class="table table-striped">
  <tr class="text-center">
    <th>ID</th><th>Numéro</th><th>Date</th><th>Acteur</th><th>Ordre</th><th>Euro</th><th>Encaissé?</th>    <th colspan="2">Action </th>
  </tr>
  <?php
  $count = $ancre = 0;
  foreach($liste as $donnee){
    // Chaque entrée sera récupérée et placée dans un array.
    $id = $donnee['id'];
    $numero = $donnee['numero'];
    $date = $donnee['date'];
    $acteur = $donnee['acteur'];
    $ordre = $donnee['ordre'];
    $montant = $donnee['montant'];
    $encaissement = $donnee['encaissement'];

    //Calculs
    if($encaissement == "non")
      $total +=$montant;
    ?>
    <tr id="<?php $ancre=$count; echo $ancre; $count++;?>">
      <form method="post" action="<?=$website->page_url;?>budget-cde-cheques-update">
        <td>
		  <input class="form-control" size="1" type="text" name="new_id" value="<?=$id?>">
          <input type="hidden" name="id" value="<?=$id?>"><!-- on sauve la valeur de l'ancien id-->
        </td>
        <td><input class="form-control text-right" type="text"size="15" name="numero"  value="<?=$numero;?>">    </td>
        <td><input class="form-control test-center" type="text" size="10"  name="date"    value="<?=$date;?>">      </td>
        <td><input class="form-control pl-1" type="text" size="3"  name="acteur"  value="<?=$acteur;?>">    </td>
        <td><input class="form-control" type="text" size="30" name="ordre"   value="<?=$ordre;?>">     </td>
        <td><input class="form-control text-right pr-1" type="text" size="1"  name="montant" value="<?=$montant;?>"></td>
        <td>
          <div class="form-group">
            <select class="custom-select" name="encaissement">
              <option value="non"<?php if($encaissement == "non") echo " selected";?>>non</option>
              <option value="oui"<?php if($encaissement == "oui") echo " selected";?>>oui</option>
            </select>
          </div>
        </td>
          <td class="center">
            <input type="hidden" name="operation" value="update">
            <input type="hidden" name="ancre" value="<?=$ancre?>">
            <button type="submit" class="btn btn-primary" >Edit</button>
        </td>
      </form>
        <td class="center">
          <form method="post" action="<?=$website->page_url;?>budget-cde-cheques-delete">
            <div class="form-group row">
              <div class="col-sm-10">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="ancre" value="<?=$ancre?>">
                <input type="hidden" name="ordre" value="<?=$ordre?>">
                <input type="hidden" name="montant" value="<?=$montant?>">
                <button type="submit" class="btn btn-primary" >Suppr</button>
              </div>
            </div>
          </form>
        </td>
      <?php
  }// ferme foreach
?>

<!--  FORMULAIRE POUR RAJOUTER UN CHEQUE           -->
  <tr>
    <form method="post" action="<?= $website->page_url;?>budget-cde-cheques-update">
      <td></td>
      <td><input  class="form-control" type="text" size="15" name="numero" value="" required></td>
      <td><input class="form-control" type="text" size="10" name="date" value=""></td>
      <td>
      <input class="form-control" type="text" size="3" name="acteur"></td>
      <td>
      <input class="form-control" type="text" size="30" name="ordre"></td>
      <td>
      <input class="form-control" type="text" size="1" name="montant" placeholder="€"></td>
      <td>
          <div class="form-group">
            <select class="custom-select" name="encaissement">
              <option value="non" selected>non</option>
              <option value="oui">oui</option>
            </select>
          </div>
	  </td>
      <td colspan="2" class="center">
		  <input type="hidden" name="operation" value="creation">
		  <button type="submit" class="btn btn-primary">Enregistrer</button>
	  </td>
  </form>
</table>
<h3 class="text-center">Total des chèques à encaisser: <span class="text-danger"><?=$total;?> €</span></h3>

<?php include "inc/budget-cde-menu.php";?>

<div class="breakafter"></div>