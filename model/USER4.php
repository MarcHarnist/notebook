<?php

// Redirect to home page if not level 1
if(!$_SESSION['member'] && !$level) {
	header('Location: ' . WEBSITE_URL);
} elseif($level <= 4) header('Location: ' . WEBSITE_URL);
