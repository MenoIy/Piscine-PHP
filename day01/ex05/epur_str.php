#!/usr/bin/php
<?php

	function ft_clean_split($str)
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

	if ($argc != 2)
		return ;
	else
	{
		$i = 0;
		$tab = ft_clean_split($argv[1]);
		while($i < count($tab))
		{
			echo ($tab[$i]);
			++$i;
			if ($i < count($tab))
				echo " ";
		}
		if (count ($tab) > 0)
			echo "\n";
	}
?>
