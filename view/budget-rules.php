<?php
$count=1;
$rols = "70"; $rows = "4";// Textareas sizes

include "inc/budget-menu.php";
?>
<article>
  <header class="row bg-light p-3 ">
    <h2 class="row ml-0 text-muted">Règles du budget</h2>
  </header>   
  <div class="col-sm-12">
    <table class="table table-striped"><!-- Boostrap classes -->
      <tr>
        <th>Id </th>
        <th>Date </th>
        <th>Auteur </th>
        <th>Règles </th>
        <th colspan="2">Action </th>
      </tr>
      <?php
      foreach($rules as $rule){
      ?>
      <tr id="<?php $ancre = $count; echo $ancre; $count++;?>">
        <!-- formular id deleted: 2 ids != valid html5 --> 
        <form method="post" action="<?= $website->page_url;?>budget-rules-update">
          <td>
            <input type="text" size="1" name="rule_id" value="<?=$rule['id'];?>" />
            <!-- on sauve la valeur de l'ancien $rule['id-->
            <!-- on crée une ancre, id = ancre = $count, pour revenir à la hauteur de cette ligne -->
            <input type="hidden" name="id" value="<?php echo $rule['id'];?>" />
          </td>
          <td>
            <input type="text" size="5" name="date" value="<?php echo $rule['date'];?>" />
          </td>
          <td>
            <input type="text" size="5" name="auteur" value="<?php echo $rule['auteur'];?>" />
          </td>
          <td>
            <textarea class="left" type="text" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="rule"><?php echo $rule['rule'];?></textarea>
          </td>
          <td class="center">
            <input type="hidden" name="operation" value="update" />
            <input type="hidden" name="ancre" value="<?php echo $ancre;?>" />
            <input type="submit" value="Edit" />
          </td>
        </form>
        <td class="center">
          <span class="center">
            <form method="post" action="<?= $website->page_url;?>budget-rules-delete">
              <input type="submit" value="del" />
              <input type="hidden" name="id" value="<?=$rule['id'];?>" />
              <input type="hidden" name="ancre" value="<?=$ancre;?>" />
              <input type="hidden" name="operation" value="delete" />
            </form>
          </span>
        </td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <form method="post" action="<?= $website->page_url;?>budget-rules-update">
          <!-- Id du formulaire supprimés: 2 ids != valide html5 --> 
          <td>
            <input type="text" size="1" />
          </td>
          <td>
            <input type="text" size="5" name="date" />          
          </td>
          <td>
            <input type="text" size="5" name="auteur" />          
          </td>
          <td>
            <textarea class="left" type="text" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="rule"></textarea>
          </td>       
          <td colspan="2" class="center">
            <input type="hidden" name="ancre" value="<?php echo $ancre;?>" />
            <input type="hidden" name="operation" value="creation" />
            <input class="right"  type="submit" size="140" value="Creation" />
          </td>
        </form>
      </tr>
    </table>
  </div>
</article><?php include "inc/budget-menu.php";?>
