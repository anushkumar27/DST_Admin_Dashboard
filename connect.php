<?php
	require  'lib/medoo.php';
	// Using Medoo namespace
	use Medoo\Medoo;

	$database = new Medoo([
		// required
		'database_type' => 'mysql',
		'database_name' => 'healthcaredb',
		'server' => 'localhost',
		'username' => 'root',
		'password' => ''
	]);
?>