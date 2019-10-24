<?php

	function	ft_is_sort($tab)
	{
		$aray = $tab;
		$flag = 0;
		sort($aray, SORT_STRING);
		foreach($aray as $key=>$value)
			if($value != $tab[$key])
				$flag = 1;
		if ($flag == 0)
			return (1);
		$flag = 1;
		$sort = $tab;
		rsort($sort, SORT_STRING);
		foreach($sort as $key=>$value)
			if($value != $tab[$key])
				$flag = 0; 
		return ($flag);
}
?>
