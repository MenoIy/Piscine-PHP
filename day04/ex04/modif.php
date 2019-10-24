<?php

	$login = $_POST['login'];
	$newpw = hash('whirlpool', $_POST['newpw']);
	$oldpw = hash('whirlpool', $_POST['oldpw']);
	$submit = $_POST['submit'];
	$file = "../private/passwd";
	$error = false;

	if ($submit === "OK")
	{
		$cont = file_get_contents($file);
		$unser = unserialize($cont);
		$info = array();
		$tab = array();
		$i = 0;
		foreach ($unser as $arr)
		{
			foreach ($arr as $key => $value)
				$info[] = $value;
			if ($info[$i] === $login && $info[$i + 1] === $oldpw && $_POST['newpw'] !== "")
			{
				$info[$i +1] = $newpw;
				$error = true;
			}
			$tab[] = array ("login" => $info[$i], "passwd" => $info[$i + 1]);
			$i += 2;
		}
		if ($error == true)
		{
			header ('Location: index.html');
			echo "OK\n";
		}
		else
			echo "ERROR\n";
		file_put_contents($file, serialize($tab));
	}
	else
		echo "ERROR\n";
?>
