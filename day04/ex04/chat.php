<?php

	date_default_timezone_set('europe/paris');
	$file = "../private/chat";
	if (!file_exists($file))
	{
		echo "";
		return ;
	}
	$cont = unserialize(file_get_contents($file));
	foreach ($cont as $arr)
		echo date('[H:i]', $arr['time']). ' <b>'.$arr['login'].'</b>: '.$arr['msg'].'<br />'."\n";
?>
