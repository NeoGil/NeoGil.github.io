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
								if ( $_POST["radio-ar"] == 4) {
									$result = $mysqli->query('SELECT * FROM `materials` WHERE `title` ="'.$_POST['title'].'"');
                                    while ($myrow = mysqli_fetch_assoc($result)) {
                                        foreach ($_POST['test'] as $key => $value) {
                                            if (isset($value['question'])) {
                                                $results = $mysqli->query("INSERT INTO `questions` (`id`, `question`, `material-id`) VALUES (NULL, '{$value['question']}', '{$myrow['id']}');");
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
																} else {
																	echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
																	
																	echo "INSERT INTO `answers` (`id`, `question-id`, `name`, `answer`, `choice`) VALUES (NULL,'{$myrows['id']}','{$names}', '{$values}', '{$chois}');";
																}
																
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
								unset($_POST);
								//header("location:" . __FILE__);
								//exit();
							} elseif ($_POST['title'] == '') {
								
							} else {
							  	echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
							}
                        }
                        ?>
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