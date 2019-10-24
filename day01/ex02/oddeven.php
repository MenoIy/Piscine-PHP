#!/usr/bin/php
<?php

	while (1)
	{
		echo ("Entrez un nombre: ");
		$number = fgets(STDIN);
		if ($number == NULL)
		{
			echo "\n";
			break;
		}
		$number = rtrim($number, "\n");
		if (is_numeric(trim($number)))
		{
			if (!($number % 2))
				echo "Le chiffre ".trim($number)." est Pair\n";
			else
				echo "Le chiffre ".trim($number)." Impair\n";
		}
		else
			echo "'$number'"." n'est pas un chiffre\n";
	} 
?>
