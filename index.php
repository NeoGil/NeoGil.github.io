<?php
require "includes/config.php";

?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Здесь подключаются js скрипты -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;subset=cyrillic-ext" rel="stylesheet">
		<!-- Здесь подключаются css стили -->
		<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.min.css">
		<title><?php echo $config['title']; ?></title>
	</head>
	<body>
		<!-- Здесь подключается header страницы -->
		<?php include "includes/header.php"; ob_end_flush();?>
		<!-- Первая секция основной страницы -->
		<section class="promo">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="promo_header">Учите химию легко и непринуждённо</h1>
						<div class="promo_descr">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id consequat sapien, gravida viverra fermentum. Sit ornare nibh et curabitur dolor sodales rhoncus, egestas nulla. Molestie eget mollis cras quam mi. Nam sed et, senectus egestas lacus, odio fermentum.
						</div>
						<button class="promo_btn">НАЧНЁМ УЧИТСЯ</button>
					</div>
				</div>
			</div>
		</section>
		<!-- Вторая секция выполняет навигационную функцию -->
		<section class="second">
			<div class="container">
				<div class="label">направления</div>
				<h2 class="title">Выбери направление в изучении химии</h2>
				<div class="subtitle">Изучайте теоретическую часть, лабороторые и практические работы, решайте тесты и смотрите видео материалы </div>

				<div class="row">
					<?php
						$query = $mysqli->query('SELECT * FROM `articles_categories`');
					?>
					<!-- generates cards with specific images and unique id links -->
					<?php
						while ($item = mysqli_fetch_assoc($query))
						{
							if ($item['id'] == 5) {
							} else {
                                ?>
							<div class="col-md-6">
								<a href="/crossroad.php?id=<?php echo $item['id']; ?>">
									<div class="second_item second_item_<?php echo $item['id']; ?>">
										<div class="second_item_subtitle">
											
											<?php echo $item['title']; ?>
										</div>
									</div>
								</a>
							</div>
							
						<?php
                            }
						}
					?>
				</div>
			</div>
		</section>
		<!-- Третья секция выполняет декоративную функцию -->
		<section class="carousel">
			<div class="container">
				<div class="label">наши будни</div>
				<h2 class="title">Посмотри на наши будни химиков</h2>
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
						<img class="d-block w-100" src="icons/iso/ionwork1.webp" alt="Первый слайд">
						</div>
						<div class="carousel-item">
						<img class="d-block w-100" src="icons/iso/ionwork2.webp" alt="Второй слайд">
						</div>
						<div class="carousel-item">
						<img class="d-block w-100" src="icons/iso/ionwork3.webp" alt="Третий слайд">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</section>
		<!-- Четвертая секция выполняет справочную функцию -->
		<section class="questions">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="label">дополнительно</div>
						<h2 class="title">Что то забыл?</h2>
						<div class="subtitle">Используйте справочные материалы и восполни все свои пробелы</div>
						<div class="questions_img">
							<button class="questions_btn">Далее</button>
						</div>

					</div>
				</div>
			</div>
		</section>
		<!-- Здесь подключается footer страницы -->
		<?php include "includes/footer.php" ?>
		<!-- Здесь подключаются js скрипты -->
		<script src="js/hamburger.js"></script>
		<script src="js/jquery-3.5.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>