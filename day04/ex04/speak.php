<?php
	session_start();
	date_default_timezone_set('europe/paris');
	$file = '../private/chat';
	$submit = $_POST['submit'];
	$login = $_SESSION['loggued_on_user'];
	if ($login === "")
	{
		echo "ERROR\n";
		return ;
	}
	if ($submit !== "OK")
	{
		return ;
		echo "ERROR\n";
	}
	$msg = $_POST['msg'];
	$tab = array();

	$flag = false;
	if (!file_exists($file))
	{
		file_put_contents($file, "");
		$flag = true;
	}
	$open = fopen($file, "rw");
	flock($open, LOCK_EX);
	if ($flag === false)
	{	
		$cont = unserialize(file_get_contents($file));
		$info = array();
		$i = 0;
		foreach($cont as $arr)
		{
			foreach($arr as $key => $value)
				$info[] = $value;
			$tab[] = array ("login" => $info[$i], "time" => $info[$i+ 1] , "msg" => $info[$i +2]);
			$i += 3;
		}
	}
	$tab[] = array("login" => $login, "time" => time(), "msg"=> $msg);
	file_put_contents($file, serialize($tab));
	flock($open, LOCK_UN);
	fclose($open);
?>
<html>
	<head>
		<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
	</head>
	<body>
		<form action="speak.php" method="POST">
			<input type="text" name="msg" value=""/><input type="submit" name="submit" value="Send"/>
		</form>
	</body>
</html>
