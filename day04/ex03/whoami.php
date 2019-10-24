<?php
	session_start();

	$login = $_SESSION['loggued_on_user']; 
	if($login !== "")
		echo $login."\n";
	else
		echo "ERROR\n";
?>
