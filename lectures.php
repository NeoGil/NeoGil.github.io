<?php

require "includes/config.php";

?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;subset=cyrillic-ext" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.min.css">
		<title>NEKRASOVA SCHOOL</title>
	</head>
	<body>
		<?php include "includes/header.php" ?>
				<!-- <div class="form_radio_group">
					<div class="form_radio_group-item">
						<input id="radio-1" type="radio" name="radio" value="1" checked>
						<label for="radio-1">Теор. часть</label>
					</div>
					<div class="form_radio_group-item">
						<input id="radio-2" type="radio" name="radio" value="2">
						<label for="radio-2">Лб. работа</label>
					</div>
					<div class="form_radio_group-item">
						<input id="radio-3" type="radio" name="radio" value="3">
						<label for="radio-3">Практика</label>
					</div>
					<div class="form_radio_group-item">
						<input id="radio-4" type="radio" name="radio" value="4" disabled>
						<label for="radio-4">Тесты</label>
					</div>
					<div class="form_radio_group-item">
						<input id="radio-5" type="radio" name="radio" value="5" disabled>
						<label for="radio-5">Видео материалы</label>
					</div>
					<div class="form_radio_group-item">
						<input id="radio-6" type="radio" name="radio" value="6" disabled>
						<label for="radio-6">Справочные материалы</label>
					</div>
				</div> -->

				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Материалы
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Теор. часть</a>
						<a class="dropdown-item" href="#">Лб. работа</a>
						<a class="dropdown-item" href="#"> Практика</a>
						<a class="dropdown-item" href="#"> Тесты</a>
						<a class="dropdown-item" href="#"> Видео материалы</a>
						<a class="dropdown-item" href="#"> Справочные материалы</a>
					</div>
				</div>

				<!--<div class="radio_switch">
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class="btn btn-secondary active">
							<input type="radio" name="options" id="option1" checked> Теор. часть
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="option2"> Лб. работа
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="option3"> Практика
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="option4"> Тесты
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="option5"> Видео материалы
						</label>
						<label class="btn btn-secondary">
							<input type="radio" name="options" id="option6"> Справочные материалы
						</label>
					</div>
				</div>-->

		<div class="filling">

			<div class="container">
				<div class="row">
					<div class="col">
						<div class="content">
							<?php

								$quer = $mysqli->query('SELECT * FROM `materials` WHERE `id` ='.(int)$_GET['id']);
								$materials = mysqli_fetch_assoc($quer)

							?>
							<h1><?php echo $materials['title']; ?>
							</h1>
							<?php echo $materials['text'] ?>
						</div>
					</div>
				</div>
			</div>

		</div>

		<footer>
			<div class="footer_wrapper">
				<div>
					<a href="https://www.instagram.com/school_nekrasova/?igshid=c7kll25lgc6y">
						<div class="footer_social">
							<img src="icons/iso/Group 18.png" alt="">
						</div>
					</a>
				</div>
				<div>
					<div class="footer_links">
						<div class="footer_links_main">
							NEKRASOVA SCHOOL
						</div>
					</div>
				</div>
				<div>
					<div class="footer_mobile">					</div>
				</div>
			</div>
		</footer>
		<script src="js/hamburger.js"></script>
		<script src="js/jquery-3.5.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>