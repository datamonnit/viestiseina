<?php
$config_string = file_get_contents('config.json');
$config = json_decode($config_string, true);
$db = $config['database'];
echo $db['host'];
echo $db['username'];



?>
