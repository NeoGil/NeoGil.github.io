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
		<script src="ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" href="css/style.min.css">
		<title>NEKRASOVA SCHOOL</title>
	</head>
	<body>
		<!-- Здесь подключается header страницы -->
		<?php include "includes/header.php" ?>
		<!-- Первая секция основной страницы -->

		<section class="crossroads">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="direction"> Добавление новой статьи</h2>
						<?php
						//print_r($_POST);
						if (isset($_POST['title'])) {
							//Вставляем данные, подставляя их в запрос

							$result = $mysqli->query("INSERT INTO `materials` (`id`, `title`, `text`, `category_id`, `article_id`) VALUES (NULL, '{$_POST['title']}', '{$_POST['editor1']}', '{$_POST['category_id']}', '{$_POST['article_id']}');");
							//Если вставка прошла успешно
							if ($result) {
							  echo '<p>Данные успешно добавлены в таблицу.</p>';
							} else {
							  echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
							}
						  }
						  ?>

						<form method="POST" action="/input_form.php">
							<input type="text" name="title", placeholder="Введите название">
							<textarea name="editor1" id="editor1" rows="10" cols="80">
								This is my textarea to be replaced with CKEditor 4.
							</textarea>
							<div class="form-group">
								<label for="exampleFormControlSelect1">Выберите категорию</label>
								<select class="form-control" id="exampleFormControlSelect1" name="category_id">
								  	<option>1</option>
								  	<option>2</option>
								  	<option>3</option>
								  	<option>4</option>
								</select>
							 </div>
							 <div class="form-group">
								<label for="exampleFormControlSelect1">Выберите артикл</label>
								<select class="form-control" id="exampleFormControlSelect1" name="article_id">
								  	<option>1</option>
								  	<option>2</option>
								  	<option>3</option>
								  	<option>4</option>
								  	<option>5</option>
								</select>
							 </div>
							<input type="submit" name="submit">
							<script>
								CKEDITOR.replace( 'editor1' );
							</script>
						</form>
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