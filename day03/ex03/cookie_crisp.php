<?php

	$name = $_GET['name'];
	$action = $_GET['action'];
	$value = $_GET['value'];
	if ($action == 'set')
		setcookie($name, $value, time() + 3600);
	else if ($action == 'get' && $_COOKIE[$name])
		echo $_COOKIE[$name]."\n";
	else if ($action == 'del')
		setcookie($name, $value, time() - 1);

?>
