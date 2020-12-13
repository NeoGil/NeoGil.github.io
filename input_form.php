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
						print_r($_POST);
						
						if (isset($_POST['title'])) {
							
							//Вставляем данные, подставляя их в запрос
							if ($_POST['title'] == '') {
								echo '<p>Произошла ошибка: Вы не назвали статью</p>';
							} else {
								$result = $mysqli->query("INSERT INTO `materials` (`id`, `title`, `text`, `category_id`, `article_id`) VALUES (NULL, '{$_POST['title']}', '{$_POST['editor1']}', '{$_POST['radio-ct']}', '{$_POST['radio-ar']}');");
								//form.reset();
								if ( $_POST["radio-ar"] == 4) {
									$result = $mysqli->query('SELECT * FROM `materials` WHERE `title` ="'.$_POST['title'].'"');
                                    while ($myrow = mysqli_fetch_assoc($result)) {
										//echo $myrow['id'];
                                        foreach ($_POST['test'] as $key => $value) {
                                            //var_dump($value);
                                            //echo("<br>");
                                            if (isset($value['question'])) {
                                                //echo ($value['question']);
                                                $results = $mysqli->query("INSERT INTO `questions` (`id`, `question`, `material-id`) VALUES (NULL, '{$value['question']}', '{$myrow['id']}');");
												//echo("<br>");
												$resul = $mysqli->query('SELECT * FROM `questions` WHERE `question` ="'.$value['question'].'" && `material-id` ="'.$myrow['id'].'"');
												while ($myrows = mysqli_fetch_assoc($resul)) {
													if (isset($value['answer'])) {
														$names = 0;
														foreach ($value['answer'] as $key => $values) {
															$names++;
															if ($values != "") {
																if (isset($value['choice'])) {
																	foreach ($value['choice'] as $keys => $valus) {
																		if ($key == $keys) {
																			$n = 1;
																			break;
																		} else {
																			$n = 0;
																		}
																	}
																	$chois = $n;
																}
																//echo $myrows['questions'];
																$resulst = $mysqli->query("INSERT INTO `answers` (`id`, `question-id`, `name`, `answer`, `choice`) VALUES (NULL,'{$myrows['id']}','{$names}', '{$values}', '{$chois}');");
																if ($resulst) {
																	//echo "Done";
																} else {
																	echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
																	
																	echo "INSERT INTO `answers` (`id`, `question-id`, `name`, `answer`, `choice`) VALUES (NULL,'{$myrows['id']}','{$names}', '{$values}', '{$chois}');";
																	//echo $myrows['id'];
																	//echo $value['question'];
																}
																
																//
																//echo($names.") ".$values.": ".$chois);
																//echo("<br>");
															}
														}
													}
												}
												
                                            }
                                        }
                                    }
								}
                            }
							//Если вставка прошла успешно
							if ($result) {
							  	echo '<p>Данные успешно добавлены в таблицу.</p>';
							  	//unset($_POST);
							} elseif ($_POST['title'] == '') {
								
							} else {
							  	echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
							}
						  }
						  ?>

						<form method="POST" action="/input_form.php">
							<div class="categore">
								<h5>Выберите катигорию</h5>
								<div class="form_radio_btn">
									<input id="radio-1" type="radio" name="radio-ct" value="1" checked>
									<label for="radio-1">Общая химия</label>
								</div>
								
								<div class="form_radio_btn">
									<input id="radio-2" type="radio" name="radio-ct" value="2">
									<label for="radio-2">Неорганическая химия</label>
								</div>
								
								<div class="form_radio_btn">
									<input id="radio-3" type="radio" name="radio-ct" value="3">
									<label for="radio-3">Органическая химия</label>
								</div>
								
								<div class="form_radio_btn">
									<input id="radio-4" type="radio" name="radio-ct" value="4">
									<label for="radio-4">Cпециальные вопросы химии</label>
								</div>
							</div><br>
							<div class="articl">
								<h5>Выберите артикул</h5>
								<div class="form_radio_btn">
									<input id="radio-5" type="radio" name="radio-ar" value="1" checked>
									<label for="radio-5">Теоретическая часть</label>
								</div>
								
								<div class="form_radio_btn">
									<input id="radio-6" type="radio" name="radio-ar" value="2">
									<label for="radio-6">Лабороторная работа</label>
								</div>
								
								<div class="form_radio_btn">
									<input id="radio-7" type="radio" name="radio-ar" value="3">
									<label for="radio-7">Практика</label>
								</div>
								
								<div class="form_radio_btn">
									<input id="radio-8" type="radio" name="radio-ar" value="4">
									<label for="radio-8">Тесты</label>
								</div>
								<div class="form_radio_btn">
									<input id="radio-9" type="radio" name="radio-ar" value="5">
									<label for="radio-9">Видеоматериалы</label>
								</div>
							</div><br>
							<input type="text" name="title", placeholder="Введите название">
							
							<textarea name="editor1" id="editor1" rows="10" cols="80">
								This is my textarea to be replaced with CKEditor 4.
							</textarea>

							
							
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
		<script src="js/script.js"></script>
	</body>
</html>