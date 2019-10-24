#!/usr/bin/php
<?
	function get_name($link)
	{
		$tab = explode("/", $link);
		$i = count($tab);
		return $tab[$i - 1];
	}

	function download_img($matches)
	{
		global $argv;
		global $dir_name;
		$link = "";
		if (preg_match('/^https?:\/\/.*$/', $matches[1]))
			$link = $matches[1];
		else
			$link = $argv[1]."/".$matches[1];
		$ch = curl_init ($link);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$raw=curl_exec($ch);
		curl_close ($ch);
		$name = get_name($link);
		file_put_contents($dir_name."/".$name, $raw);
	}

	function get_src($matches)
	{
		preg_replace_callback('/src=["\']([^"\']*)/', 'download_img', $matches[2]);
	}

	if ($argc == 1)
		return ;
	$dir_name = $argv[1];
	if (strpos($argv[1], "https://") !== false)
		$dir_name = substr($argv[1], 8);
	else if (strpos($argv[1], "http://") !== false)
		$dir_name = substr($argv[1], 7);
	$dir_name = explode("/", $dir_name)[0];
	if(!file_exists($dir_name))
		mkdir($dir_name);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $argv[1]);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	curl_close($ch);
	preg_replace_callback('/(<img )([^>]*)\/?>/sim', 'get_src', $result);
?>
