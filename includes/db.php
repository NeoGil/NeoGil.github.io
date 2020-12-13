<?php

/*connects to the database takes information from config*/
$mysqli = new mysqli(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['name']
);

/*removes the error of not reading the text correctly*/
$mysqli->set_charset('utf8');

/*displays a message if you can't connect to the database*/
if (mysqli_connect_errno()) {
    printf("Соединение не удалось: %s\n", mysqli_connect_error());
    exit();
}

?>