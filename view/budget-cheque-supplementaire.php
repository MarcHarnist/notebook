<article>
  <header class="row bg-light p-3 ">
    <h2 class="row ml-0 text-muted">SOUHAITEZ-VOUS RENSEIGNER UN CHEQUE SUPPLEMENTAIRE?</h2>
  </header>
  <div class="row">
	  <div class="col-lg-1">
		 <form method="post" action="<?=$website->page_url?>budget-cheques">
			<input class="btn" type="submit" value="Oui">
		</form>
		</div>
	  <div class="col-lg-1">
		 <form method="post" action="<?= $website->page_url . 'budget-rapport';?>">
				<input class="btn" type="submit" value="Non" />
		</form>
		</div>
	</div>
	<?php include "inc/budget-menu.php";?>
</article>