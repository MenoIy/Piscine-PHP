<?php

function auth($login, $passwd)
{
	$file = "../private/passwd";
	$return = FALSE;
	$cont = file_get_contents($file);
	$unser = unserialize($cont);
	$i = 0;
	foreach ($unser as $arr)
	{
		foreach ($arr as $key => $value)
			$info[] = $value;
		if ($info[$i] === $login && $info[$i + 1] === hash ('whirlpool', $passwd))
			$return = TRUE;
		$i += 2;
	}
	return ($return);
}
?>
