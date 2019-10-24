<?php

	$pswd = $_SERVER['PHP_AUTH_PW'];
	$user = $_SERVER['PHP_AUTH_USER'];
	$data = file_get_contents('../img/42.png');
	$data_64 = base64_encode($data);

	if ($user === null)
	{
		header('WWW-Authenticate: Basic realm=\'\'Espace membres\'\'');
		header('HTTP/1.0 401 Unauthorized');
	}
	else
	{
		if ($user === 'zaz' && $pswd === 'jaimelespetitsponeys')
		{
			$to_do = 1;

		}
		else
		{
			header('WWW-Authenticate: Basic realm=\'\'Espace membres\'\'');
			header('HTTP/1.0 401 Unauthorized');
			$to_do = 0;
		}
	}
?>
<?php if ($to_do === 1) : ?>
<html><body>
Bonjour Zaz<br />
<img src='data:image/png;base64,<?php echo $data_64 ?>'>
</body></html>
<?php endif ?>
<?php if ($to_do === 0) : ?>
<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
<?php endif ?>
