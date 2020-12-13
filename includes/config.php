<?php
ob_start();
session_start();
/*data is stored that can change frequently*/
$config = array(
	'title' => 'NKschool',
	'INST_url' => 'https://www.instagram.com/school_nekrasova/?igshid=c7kll25lgc6y',
	'db' => array(
		'server' => 'localhost',
		'username' => 'root',
		'password' => 'root',
		'name' => 'schoolnk',

	),
);
/*loads a file db.php*/
require "db.php";