<?php
$config_string = file_get_contents('config.json');
$config = json_decode($config_string, true);
$db = $config['database'];

//db.php
$servername = 'paja.esedu.fi';
$username = 'viestiUser';
$password = 'qwerty';
$dbname = 'viestiseina';

try {
	// $dbConn = new PDO("mysql:host=$db['host'];dbname=$db['schema'];charset=utf8", $db['username'], $db['password']);
	$dbConn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
	}
catch(PDOException $e)
	{
	echo $e->getMessage();
	}

?>
