#!/usr/bin/php
<?php

	date_default_timezone_set('europe/paris');
	$filename = "/var/run/utmpx";
	$handle = fopen($filename, "rb");
	while ($contents = fread($handle, 628))
		$arr[] = unpack("a256user/a4id/a32group/ipid/itype/I2time/a256host/i16pad", $contents);
	foreach ($arr as $value)
	{
		if ($value['type'] == 7)
			echo $value['user'] . "    " . $value['group'] . "  " .  strftime("%b %e %H:%M" ,$value['time1']). "\n";
		}
	fclose($handle);
?>
