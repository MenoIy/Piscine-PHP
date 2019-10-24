#!/usr/bin/php
#<?php

	function ft_replace($matches)
	{	
		return ('title='.strtoupper($matches[1]));
	}
	function ft_replace_cnt($matches)
	{
		return (">".strtoupper($matches[1])."<");
	}
	function ft_a($matches)
	{
		$str = preg_replace_callback('/title=(\s*["\'][^"\']*)/', 'ft_replace', $matches[1]);
		if (preg_match("/<.*/", $matches[2]))
		{
			$tmp = preg_replace_callback('/title=(\s*["\'][^"\']*)/', 'ft_replace', $matches[2]);
			$tmp = preg_replace_callback("/>([^<]*)</", 'ft_replace_cnt', $tmp);
			$str = $str.$tmp.$matches[3];
		}
		else
			$str = $str.strtoupper($matches[2]).$matches[3];
		return ($str);
	}
	if ($argc == 1)
		return ;
	$str = file_get_contents($argv[1]);
	echo preg_replace_callback('/(<a [^>]*)(>.*?)(<\/a>)/sim', 'ft_a', $str);
?>
