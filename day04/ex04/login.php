<?php
	session_start();
	include 'auth.php';
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	$done = false;
	if (auth($login, $passwd))
	{
		$_SESSION['loggued_on_user'] = $login;
		$done = true;
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
	}
?>
<?php if ($done === true) : ?>
<html><body>
<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
</body></html>
<?php endif ?>
