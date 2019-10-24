<?php
	$file = '../private/passwd';
	$dir = '../private';
	if (!file_exists($dir))
		mkdir($dir, 0755, true);
	$tab = array();
	$error = true;
	if ($_POST['submit'] === 'OK')
	{
		if ($_POST['login'] === "" || $_POST['passwd'] === "")
			$ok = false;
		else
		{
			$login = $_POST['login'];
			$passwd = hash ('whirlpool' ,$_POST['passwd']);
			$ok = true;
		}
	}
		else
			echo "ERROR\n";
	if ($ok === true)
	{
		if (!file_exists($file))
			file_put_contents($file, "");
		else
		{
			$cont = file_get_contents($file);
			$unser = unserialize($cont);
			$info = array();
			$i = 0;
			foreach ($unser as $arr)
			{
				foreach ($arr as $key => $value)
					$info[] = $value;
				$tab[] = array ("login" => $info[$i], "passwd" => $info[$i + 1]);
				if ($info[$i] == $login)
					$error = false;
				$i += 2;
			}
		}
		if ($error == true)
		{
			$tab[] = array ("login"=>$login, "passwd"=>$passwd);
			echo "OK\n";
		}

		else
			echo "ERROR\n";
		$ser = serialize($tab);
		file_put_contents($file, $ser);
	}
	else
		echo "ERROR\n";
?>
