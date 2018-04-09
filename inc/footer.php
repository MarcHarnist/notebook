		</div class="container">
		
		<div class="container p-0">
			<footer class="p-3"> <!-- Footer (pied de page) -->
				<h6>
					<a 	class="mr-2" 
						title = "Mensions légales du site web"
						href="<?=PAGE_URL?>page-from-pages-index&id=81&titre=mentions-legales">
						<i class="fas fa-gavel fa-2x"></i>
					</a>
					<a 	class="mr-2"
						title = "Valide W3C ?"
						href="http://validator.w3.org/check/referer">
						<i class="fab fa-html5 fa-2x"></i>
					</a>
					<a 	class="mr-2" 
						title = "Valide W3C ?"
						href="http://jigsaw.w3.org/css-validator/check/referer">
						<i class="fab fa-css3-alt fa-2x"></i>
					</a>
					<a 	class="mr-2" 
						title = "Mes formations"
						href="../formation/">
						<i class="fab fa-earlybirds fa-2x"></i>
					</a>
				
					<span class = "text-secondary pl-5">Light CMS par <a href="http://marcharnist.fr" title="L'auteur">Marc Laurent Harnist</a> développeur, intégrateur et référenceur web.</span>
				</h6>
					<!-- retour à la ligne pour belle présentation online -->
			</footer> <!-- close Footer -->
		</div> <!-- close container II -->
	
		<!-- Bootstrap inside the website! -->
		<script src="./js/jquery-3.2.1.slim.min.js"></script>
		<script src="./js/popper.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
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
	}
?>
