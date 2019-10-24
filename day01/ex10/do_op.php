#!/usr/bin/php
<?php

	if ($argc != 4)
	{
		echo "Incorrect Parameters\n";
		return ;
	}

	$a = trim($argv[1]);
	$b = trim($argv[3]);
	$p = trim($argv[2]);
	if (is_numeric($a) && is_numeric($b))
	{
		if ($p == '+')
			echo ($a + $b)."\n";
		if ($p == '-')
			echo ($a - $b)."\n";
		if ($p == '*')
			echo ($a * $b)."\n";
		if ($p == '/' )
			echo ($a / $b)."\n";
		if ($p == '%')
			echo ($a % $b)."\n";
	}
?>
