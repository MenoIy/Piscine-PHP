#!/usr/bin/php
<?php

	function ft_split($str)
	{
		$str = str_replace("\t", " ",$str);
		$str = str_replace("\r", " ",$str);
		$str = str_replace("\v", " ",$str);
		$str = str_replace("\n", " ",$str);
		$new_tab = array();
		$tab = (explode(" ",$str));
		foreach($tab as $elem)
		{
			if ($elem != NULL)
				array_push($new_tab, $elem);
		}	
		return ($new_tab);
	}
	if ($argc == 1)
		return ;
	$tab = ft_split($argv[1]);
	$i = count($tab);
	$j = 1;
	while ($j < $i)
	{
		echo ($tab[$j])." ";
		++$j;
	}
	echo($tab[0]);
	if ($tab[0] != "")
		echo "\n";
?>
