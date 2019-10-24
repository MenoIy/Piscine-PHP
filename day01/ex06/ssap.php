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

	if ($argc < 2)
		return ;
	$full_tab = array();
	for($i= 1; $i <= $argc;++$i)
	{
		$split = ft_split($argv[$i]);
		for ($j = 0; $j < count($split); ++$j)
		{
			array_push($full_tab, $split[$j]);
		}
	}
	sort($full_tab, SORT_STRING);
	foreach ($full_tab as $elem) {
		echo $elem;
	echo "\n";
}
?>
