<?php

function auth($login, $passwd)
{
	$file = "../private/passwd";
	$return = FALSE;
	$cont = file_get_contents($file);
	$unser = unserialize($cont);
	$passwd = hash(whirlpool, $passwd);
	foreach ($unser as $arr)
	{	
		if ($arr['login'] === $login && $arr['passwd'] === $passwd)
			$return = TRUE;
	}
	return ($return);
}
?>
