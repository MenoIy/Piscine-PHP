#!/usr/bin/php
<?php

	$to_find = $argv[1];
	$i = 1;
	if ($argc <= 2)
		return ;
	$out = "";
	while($i <= $argc)
	{
		$tab = explode(":",$argv[$i]);
		if ($tab[0] == $to_find && $tab[1] != "")
			$out = $tab[1];
		++$i;
	}
	echo $out;
	if ($out != "")
		echo "\n";
?>
