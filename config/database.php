<?php

return [
	'driver'=> 'mysqli',
	'host'	=> 'localhost',
	'user' 	=> 'root',
	'psw' 	=> '',
	'db' 	=>	'freeblog',
	'dsn' 	=> 'mysql:host=localhost; dbname=freeblog; charset=UTF8',
	'pdooptons' => [
		[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ],
		[PDO::ATTR_ERRMODE			 => PDO::ERRMODE_EXCEPTION],
	],
];