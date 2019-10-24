#!/usr/bin/php
<?php

	if ($argc != 2)
		echo "Incorrect Parameters\n";
	else
	{
		$number = sscanf($argv[1], "%f %c %f %s");
		if ($number[3] != "" || !is_numeric($number[0]) || !is_numeric($number[2]))
			echo "Syntax Error\n";
		else
		{
			if ($number[1] == '+')
				echo ($number[0] + $number[2])."\n";
			else if ($number[1] == '/')
				echo ($number[0] / $number[2])."\n";
			else if ($number[1] == '*')
				echo ($number[0] * $number[2])."\n";
			else if ($number[1] == '-')
				echo ($number[0] - $number[2])."\n";
			else if ($number[1] == '%')
				echo ($number[0] % $number[2])."\n";
			else
				echo "Syntax Error\n";
		}
	}
?>
