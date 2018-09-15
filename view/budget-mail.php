<!-- Note: on peut déplacer ce code dans le rapport...       -->
<section>
    <header class="row bg-light p-3 "><h2 class="row ml-0 text-muted">Correction du mail avant envoi.</h2></header>
    <?php include "inc/budget-menu.php";
    //Si un message a été envoyé on le signale
    if(isset($mail_sent) && $mail_sent == True){
       ?>
       <p class="h4 text-success">Le message a été envoyé à <?=$destinataires?>.</p>
    <?php
    }
	else { 
	//Sinon montre le mail à envoyer: on peut encore le modifier
	?>
	<form  method="post" action="#">
      <p>Le message a envoyer: <br>
        <textarea name="message_de_la_page_budget_mail" rows="20" cols="100"><?=$message_de_la_page_budget_rapport;?></textarea></p>
		
      <p><input type="hidden" name="message_de_la_page_budget_rapport" value="<?=$message_de_la_page_budget_rapport;?>">
          <input class = "btn btn-primary" type="submit"  value="Envoyer le mail"></p>
    </form>
    <?php		
	}
    include "inc/budget-menu.php";?>
</section>