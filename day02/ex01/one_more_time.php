#!/usr/bin/php
<?php
	date_default_timezone_set('europe/paris');
	function	ft_get_indice($array, $name)
	{
		$i = 1;
		foreach($array as $key)
		{
			if ($key == $name)
				return $i;
			++$i;
		}
		return (-1);
	}

	if ($argc != 2)
		return;
	$jour = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
	$mois = array ("janvier" , "février", "mars" , "april", "mai" 
		, "juin", "juillet" , "août", "septembre", "octobre" , "novembre" , "décembre");
	if (preg_match("/^([A-Za-z]+) (\d{1,2}) ([A-Za-z]+) (\d{4}) (\d{2}):(\d{2}):(\d{2})$/", $argv[1], $out))
	{
		$out[1][0] = strtolower($out[1][0]);
		$out[3][0] = strtolower($out[3][0]);
		if (!in_array($out[1], $jour) || !in_array($out[3], $mois))
		{
			echo "Wrong Format\n";
			return;
		}
		$indice = ft_get_indice($mois, $out[3]);
		if ((checkdate($indice ,$out[2], $out[4]) == false))
		{ 
			echo "Wrong Format\n";
			return ;
		}

		$stamp = mktime($out[5], $out[6], $out[7], $indice, $out[2],  $out[4]);
		echo $stamp."\n";
	}
	else
		echo "Wrong Format\n";

?>
