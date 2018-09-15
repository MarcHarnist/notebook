		</div><!-- Close </div class="container"> -->

		
		<div class="container p-0">
			<footer class="p-3"> <!-- Footer (pied de page) -->
				<h6>
					<a 	class="mr-2" 
						title = "Mensions légales du site web"
						href="<?= $website->page_url?>page-from-pages-index&id=81&titre=mentions-legales">
						<i class="fas fa-gavel fa-2x"></i>
					</a>
					<a 	class="mr-2" 
						title = "Formation La Rochelle 2018 et travaux pratiques..."
						href="../formation/">
						<i class="fab fa-earlybirds fa-2x"></i>
					</a>
				
					<span class = "text-secondary pl-5">CMS <a href="../light">"Light"</a> créé par <a href="http://marcharnist.fr" title="L'auteur"><?=$website::WEBMASTER;?></a> développeur Web junior.</span>
				</h6>
					<!-- retour à la ligne pour belle présentation online -->
			</footer> <!-- close Footer -->
		</div> <!-- close container II -->
	
		<!-- Bootstrap inside the website! -->
		<script src="./js/jquery-3.2.1.slim.min.js"></script>
		<script src="./js/popper.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		
		<!-- Code javascript de Marc L. Harnist du 11/04/2018 Source: OpenClassRoom -->
		<script src="js/_js-marc-laurent-harnist.js"></script>
		
		<!-- Hello dear visitor! - bb-code créé par M.L. Harnist le 8/04/2018 Source: OpenClassRoom -->
		<script src="js/bb-code.js"></script>

	</body>
</html>

<?php
	// store member in session var to economyse a SQL request.
	if(isset($member)){
		$_SESSION['member'] = $member;
		if(is_object($member)) {
			$member = $member->name();
			$_SESSION['member'] = $member;
		}
	}//close if(isset($member))
?>
