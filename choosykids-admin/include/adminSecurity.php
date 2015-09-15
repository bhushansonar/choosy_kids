<?php
	if (!isset($_SESSION["session_adminID"]) || $_SESSION["session_adminID"]=="") {
		$p="login";
	} else {
		$bLoggedIn=true;
		if ($p=='') $p="home";
	}

?>