#!/usr/bin/php
<?php

	$i = 1;
	while($i <= $argc)
	{
		$done = trim($argv[$i]);
		if ($done != "")
			echo $done."\n";
		++$i;
	}
?>
