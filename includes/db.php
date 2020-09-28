<?php

/*$connection = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['name']
);


if ( $connection == false) {
	echo "Не удача хозяин";
	echo mysqli_connect_error();
	exit();
}*/



$mysqli = new mysqli(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['name']
);


if (mysqli_connect_errno()) {
    printf("Соединение не удалось: %s\n", mysqli_connect_error());
    exit();
}

?>