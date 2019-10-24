#!/usr/bin/php
<?php

	function ft_is_alpha($c)
	{		
		if (!(($c >= 'a' && $c <= 'z') || ($c >= 'A' && $c <= 'Z')))
			return (0);
		return (1);
	}
	function ft_sscp($a, $b)
	{
		$j = 0;
		while(ord($a[$j]) != 0 && ord($b[$j]) != 0 && strtolower($a[$j]) == strtolower($b[$j]))
			++$j;
		if (ord($a[$j]) == 0 && ord($b[$j]) != '0')
			return (1);
		if (ord($b[$j]) == 0 && ord($a[$j]) != 0)
			return (0);
		if (ord($b[$j]) == 0 && ord($a[$j]) == 0)
			return (1);
		if (ft_is_alpha($b[$j]) && ft_is_alpha($a[$j]) && strtolower($a[$j]) <= strtolower($b[$j]))
			return (1);
		if (ft_is_alpha($a[$j]) && is_numeric($b[$j]))
			return (1);
		if (ft_is_alpha($a[$j]) && !is_numeric($b[$j]) && !ft_is_alpha($b[$j]))
			return (1);
		if (is_numeric($a[$j]) && !is_numeric($b[$j]) && !ft_is_alpha($b[$j]))
			return (1);
		if (is_numeric($a[$j]) && is_numeric($b[$j]) && $a[$j] <= $b[$j])
			return (1);
		if (!is_numeric($b[$j]) && !ft_is_alpha($b[$j]) && !is_numeric($a[$j]) && !ft_is_alpha($a[$j]) && $a[$j] <= $b[$j])
			return (1);
		return (0);
	}

	function ft_sort_special($array)
	{
		$count = count($array);
		for ($i = 0; $i < $count; $i++)
   		{
			for ($j = $i + 1; $j < $count; $j++) 
			{
				if (!ft_sscp($array[$i], $array[$j]))
			   	{
					$temp = $array[$i];
					$array[$i] = $array[$j];
					$array[$j] = $temp;
				}
			}
		}
		foreach($array as $elem) 
			echo $elem."\n";
	}

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
			array_push($full_tab, $split[$j]);
	}
	ft_sort_special($full_tab);
?>
