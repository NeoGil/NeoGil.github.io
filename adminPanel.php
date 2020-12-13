<?php
require "includes/config.php";
?>

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
		<title>AdminPanel</title>
	</head>
	<body>
		<!-- Здесь подключается header страницы -->
		<?php include "includes/header.php" ?>
		<!-- Первая секция основной страницы -->

		<section class="crossroads">
			<div class="container">
				<div class="row">
<?
	
	//echo $_SESSION['accessLevel'];
	if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
		exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=/> главную страницу </a>.</p>");
	} else {
		if ($_SESSION['accessLevel'] != 1) {
			exit("<p><strong>Ошибка!</strong> У вас не прав доступа к этой странице. Вы можете перейти на <a href=/> главную страницу </a>.</p>");
		} else {
			//echo $_SESSION['accessLevel'];
			if(isset($_GET['act'])) {$act = $_GET['act'];} else {$act = 'home';}
				switch($act) {
				case 'home':
					foreach (mysqli_query($GLOBALS['mysqli'],"SELECT * FROM articles_id") as $article ) {
						//echo $article['id'];
						$articles = null;
						$article_result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE article_id='$article[id]'");
					
						if(mysqli_num_rows($article_result) >= 1) {
							while($article_array = mysqli_fetch_array($article_result)) {
								$articles .= "<div class='table-content__list-item'>
								<a href='?act=edit_article&id=$article_array[id]'>$article_array[id] | $article_array[title]</a>
								<input type='checkbox' name='delete_row[]' value='" . $article_array["id"] . "'>
								</div>";
								
							}
						} else {
							$articles = "Статей пока нет";
						}
						?>
						<script>
							function ask() {
								var s = confirm("Вы уверены?");
								if(s) {
									document.forms['form1'].submit();
								}
							}
						</script>
						<?
						/*
						if (isset($_POST['id'])) {
							//$n = $_POST['id'];
                            echo $_POST['id'];
							$k = mysqli_query($GLOBALS['mysqli'],"DELETE FROM `materials` WHERE `id`='$_POST[id]'");
							//header('location:http://schoolnk/adminPanel.php?act=home');
						}*/

						
						$articl .= "
						<div class='col-md'>
							<div class='table'>
								<div class='table-wrapper'>
									<div class='table-title'>$article[title]</div>
									<div class='table-content'>
										<form class='form1' action='/includes/delete.php' method='POST'>
											$articles
										<button type='submit' onclick='ask(); return false;'><img src='/icons/vector/delet.svg' alt='deletBtn'></button></form>
										<a href='?act=add_article&id=$article[id]'class='table__add-button'id='add_article'>+</a>
									</div>
								</div>
							</div>
						</div>";
					}
					$users_result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM userlist");
					if(mysqli_num_rows($users_result) >= 1) {
						while($users_array = mysqli_fetch_array($users_result)) {
							$users .= "<div class='table-content__list-item'>$users_array[id] | $users_array[login]</div>";
						}
					} else {
								$users = "Статей пока нет";
					}
					$echo = "   $articl
								<div class='col-md'>
									<div class='table'>
										<div class='table-wrapper'>
											<div class='table-title'>Пользователи</div>
											<div class='table-content'>
												$users
												<a href='?act=add_user'class='table__add-button'id='add_user'>+</a>
											</div>
										</div>
									</div>
								</div>";
				break;
				case 'edit_article':
					if(isset($_GET['id'])) {
						$id = $_GET['id'];
						$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE id='$id'");
						//echo mysqli_num_rows($result);
						$article = mysqli_fetch_array($result);
						if(mysqli_num_rows($result) == 1) {
							if($article['article_id'] == 1) {
								//echo $article['article_id'];
								if(isset($_POST['title']) && isset($_POST['text'])) {
									//Тут должна быть валидация
									//Обновление таблицы
									$update = mysqli_query($GLOBALS['mysqli'],"UPDATE materials SET title='$_POST[title]', text='$_POST[text]' WHERE id='$id'");
									if($update) {
										//Если обновление прошло успешно, получаются новые данные
										$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE id='$id'");
										$message = "Успешно обновлено!";
									}
								}
								$echo = "
									<div class='table'>
										<div class='table-wrapper'>
											<div class='table-title'>Редактирование статьи</div>
											<div class='table-content'>
												<a href='?act=home'><- Вернуться</a><br>
												$message
												<form method='post' class='article-form'>
													<b>Название:</b> <input type='text' name='title' value='$article[title]'><br>
													<b>Текст:</b>
													<textarea name='text' id='text' rows='10' cols='80'>
														$article[text]
													</textarea>
													<script>
														CKEDITOR.replace( 'text' );
													</script>
													</br>
													<input type='submit' class='button' value='Сохранить'>
												</form>
											</div>
										</div>
									</div>";

							} else if ($article['article_id'] == 4) {

								$resulst = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `questions` WHERE `material-id`='$id'");
								if(isset($_POST['title']) && isset($_POST['text'])) {
									//Тут должна быть валидация
									//Обновление таблицы
									$update = mysqli_query($GLOBALS['mysqli'],"UPDATE materials SET title='$_POST[title]', text='$_POST[text]' WHERE id='$id'");
									if($update) {
										//Если обновление прошло успешно, получаются новые данные
										$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE id='$id'");
										$message = "Успешно обновлено!";
									}
								
								}
								if (isset($_POST['test'])) {
                                    $idQuest = null;
									$countq = 0;
									while ($resuls = mysqli_fetch_assoc($resulst)) {
                                        $idQuest[] = $resuls['id'];
									}
									foreach ($_POST['test'] as $value) {
										$update = mysqli_query($GLOBALS['mysqli'],"UPDATE `questions` SET `question` = '$value[question]' WHERE `questions`.`id` = $idQuest[$countq];");
										
										$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `answers` WHERE `question-id`='$idQuest[$countq]'");
										$idAns = null;
                                        $names = null;
										$countA = 0;
                                        $ans = null;
										while ($resula = mysqli_fetch_assoc($result)) {
											$idAns[] = $resula['id'];
											$names = $resula['name'];
											$idansd = $resula['id'];
                                            $ans[] =  $resula['answer'];
										}
                                        foreach ($value['answer'] as $ansVal) {
											if (count($value['answer']) == count($idAns)) {
												$update = mysqli_query($GLOBALS['mysqli'],"UPDATE `answers` SET `answer` = '$ansVal' WHERE `answers`.`id` = $idAns[$countA];");
                                            	$countA++;
											} else if (count($value['answer']) > count($idAns)) {
                                                $l = 0;
												foreach ($ans as $values) {
													if ($values == $ansVal) {
														$l = 0;
														break;
                                                       
													} else if ($values != $ansVal) {
														
                                                        $l=1;
														
													}
												}
												if ($l == 1) {
													$names++;
													$update = mysqli_query($GLOBALS['mysqli'],"INSERT INTO `answers` (`id`, `question-id`, `name`, `answer`, `choice`) VALUES (NULL,'$idQuest[$countq]','$names', '$ansVal', '0');");
													if($update) {
														//Если обновление прошло успешно, получаются новые данные
														$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `answers` WHERE `question-id`='$idQuest[$countq]'");
														
													}
												}
											} else if (count($value['answer']) < count($idAns)) {
												$update = mysqli_query($GLOBALS['mysqli'],"DELETE FROM `answers` WHERE `answers`.`id` = $idansd;");
												if($update) {
													//Если обновление прошло успешно, получаются новые данные
													$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `answers` WHERE `question-id`='$idQuest[$countq]'");
													
												}
												
											}
											
										}
										$countA = 0;
										for ($i=0; $i < count($value['answer']); $i++) {
											if (isset($value['choice'][$i+1])) {

											} else {
												($value['choice'])[$i+1] = 0;
											}
										}
                                        ksort($value['choice']);
										foreach ($value['choice'] as $ansCois) {
                                            //echo $idAns[$countA];
											$update = mysqli_query($GLOBALS['mysqli'],"UPDATE `answers` SET `choice` = '$ansCois' WHERE `answers`.`id` = $idAns[$countA];");
											$countA++;
										}
										$countq++;
									}
									if($update) {
										//Если обновление прошло успешно, получаются новые данные
										$resulst = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `questions` WHERE `material-id`='$id'");
										
									}
								}
								if(mysqli_num_rows($resulst) >= 1) {
									$n = 1;
									while ($resuls = mysqli_fetch_assoc($resulst)) {
                                        $b = $n - 1;
                                        $test = '<textarea name="test['.$b.'][question]" id="1" cols="80" rows="10" placeholder="Введите вопрос '.$n.'">'.$resuls['question'].'</textarea>
										';
										
                                        $id = $resuls['id'];
										$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `answers` WHERE `question-id`='$id'");
										if(mysqli_num_rows($result) >= 1) {
											$a = 1;
											while ($resuls = mysqli_fetch_assoc($result)) {
												if ($resuls['choice'] == 1) {
                                                    $chec = 'checked';
												} else {
                                                    $chec = '';
												}
												$answer .= '<div class="col-md-4 col-lg-3">
												<input type="text" name="test['.$b.'][answer]['.$a.']", placeholder="Введите ответ" value="'.$resuls['answer'].'">
												<input type="checkbox" value="1" name="test['.$b.'][choice]['.$a.']" '.$chec.'>
											</div>';
                                            $a++;
											}
										}
										$n++;
										$echos .= '
										<div class="testing_form" id="test1">
											'.$test.'
											<div class="answer">
												<div class="row">
													'.$answer.'
												</div>
											</div>
											<div class="row">
												<div class="minus">'.$b.'</div>
												
												<div class="pluss">'.$b.'</div>
											</div>
										</div>
										';
                                        $answer = null;
									}
								} else {
                                    $echos = "Вопросы не были найдены!";
								}
								$echo = "
									<div class='table'>
										<div class='table-wrapper'>
											<div class='table-title'>Редактирование статьи</div>
											<div class='table-content'>
												<a href='?act=home'><- Вернуться</a><br>
												$message
												<form method='post' class='article-form'>
													<b>Название:</b> <input type='text' name='title' value='$article[title]'><br>
													<b>Текст:</b>
													<textarea name='text' id='text' rows='10' cols='80'>
														$article[text]
													</textarea>
													<h3>Тест</h3>
													<div class='testing'>
														".$echos."
													</div>
													<script>
														CKEDITOR.replace( 'text' );
													</script>
													</br>
													<input type='submit' class='button' value='Сохранить'>
												</form>
											</div>
										</div>
									</div>";

								
									
							}
						}
					}
				break;
				case 'add_user':
						if(isset($_POST['reglogin']) && isset($_POST['regpassword'])) {
							$check = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM userlist WHERE login='$_POST[reglogin]'");
							if(mysqli_num_rows($check) == 0) {
								if (isset($_POST['regadmin'])) {
									
								} else {
									$_POST['regadmin'] = 0;
								}
								$insert = mysqli_query($GLOBALS['mysqli'],"INSERT INTO userlist (id,login,password,admin) VALUE (null,'$_POST[reglogin]','$_POST[regpassword]','$_POST[regadmin]')");
								if($insert) {
									$message = "Пользователь успешно добавлен!";
								} else {
									$message = "Ошибка! ".mysqli_error($GLOBALS['mysqli']);
								}
							} else {
								$message = "Пользователь с таким логином уже существует!";
							}
						}
						$echo = "<div class='table'>
						<div class='table-wrapper'>
						<div class='table-title'>Новый пользователь</div>
						<div class='table-content'>
						<a href='?act=home'><- Вернуться</a><br>
						$message
						<form method='post' class='user-form'>
						<b>Логин:</b> <input type='text' name='reglogin' required><br>
						<b>Пароль:</b> <input type='text' name='regpassword' required><br>
						<b>Админ:</b> <input type='checkbox' name='regadmin'></br>
						<input type='submit' class='button' value='Добавить'>
						</form>
						</div>
						</div>
						</div>";
				break;
				case 'add_article':
					/*
					if(isset($_POST['reglogin']) && isset($_POST['regpassword'])) {
						$check = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM userlist WHERE login='$_POST[reglogin]'");
						if(mysqli_num_rows($check) == 0) {
							if (isset($_POST['regadmin'])) {
								
							} else {
								$_POST['regadmin'] = 0;
							}
							$insert = mysqli_query($GLOBALS['mysqli'],"INSERT INTO userlist (id,login,password,admin) VALUE (null,'$_POST[reglogin]','$_POST[regpassword]','$_POST[regadmin]')");
							if($insert) {
								$message = "Пользователь успешно добавлен!";
							} else {
								$message = "Ошибка! ".mysqli_error($GLOBALS['mysqli']);
							}
						} else {
							$message = "Пользователь с таким логином уже существует!";
						}
					}*/
					if ($_GET['id'] == 1) {
						if (isset($_POST['title'])) {
							if ($_POST['title'] == '') {
								echo '<p>Произошла ошибка: Вы не назвали статью</p>';
							} else {
								$check = mysqli_query($GLOBALS['mysqli'], "SELECT * FROM materials WHERE title='$_POST[title]'");
								if (mysqli_num_rows($check) == 0) {
									$result = $mysqli->query("INSERT INTO `materials` (`id`, `title`, `text`, `category_id`, `article_id`) VALUES (NULL, '{$_POST['title']}', '{$_POST['editor1']}', '{$_POST['radio-ct']}', '1');");
								} else {
									echo '<p>Произошла ошибка: Есть статья с таким названием! </p>';
								}
								if ($result) {
									echo '<p>Данные успешно добавлены в таблицу.</p>';
								//unset($_POST);
								} elseif ($_POST['title'] == '') {
								} else {
									echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
								}
							}
						}
					} else if ($_GET['id'] == 2 ) {
						echo '<p>Произошла ошибка: Данный функционал неготов( сори:) )</p> <a href="?act=home"><- Вернуться</a><br>';
						break;
					} else if ($_GET['id'] == 3 ) {
						echo '<p>Произошла ошибка: Данный функционал неготов( сори:) )</p> <a href="?act=home"><- Вернуться</a><br>';
						break;
					} else if ($_GET['id'] == 4 ) {
									
						if (isset($_POST['title'])) {
							
							//Вставляем данные, подставляя их в запрос
							if ($_POST['title'] == '') {
								echo '<p>Произошла ошибка: Вы не назвали статью</p>';
							} else {
								$check = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE title='$_POST[title]'");
								
								//form.reset();
								//echo $check;
								if ( mysqli_num_rows($check) == 0) {
									$result = $mysqli->query("INSERT INTO `materials` (`id`, `title`, `text`, `category_id`, `article_id`) VALUES (NULL, '{$_POST['title']}', '{$_POST['editor1']}', '{$_POST['radio-ct']}', '4');");
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
								} else {
									echo '<p>Произошла ошибка: Есть статья с таким названием! </p>';
									
								}
								
							}
							//Если вставка прошла успешно
							if ($result) {
								echo '<p>Данные успешно добавлены в таблицу.</p>';
								//unset($_POST);
							} elseif ($_POST['title'] == '') {
								
							} else {
								//echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
							}
						}
						$testing = '<div class="testings">
						<h5>Напишите парочку вопросов</h5>
						<div class="testing">
							<div class="testing_form" id="test1">
								<textarea name="test[0][question]" id="1" cols="80" rows="10" placeholder="Введите вопрос 1"></textarea>
								<div class="answer">
									<div class="row">
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[0][answer][1]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[0][choice][1]">
										</div>
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[0][answer][2]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[0][choice][2]">
										</div>
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[0][answer][3]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[0][choice][3]">
										</div>
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[0][answer][4]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[0][choice][4]">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="minus">0</div>
									
									<div class="pluss">0</div>
								</div>
							</div>
							<div class="testing_form" id="test1">
								<textarea name="test[1][question]" id="1" cols="80" rows="10" placeholder="Введите вопрос 2"></textarea>
								<div class="answer">
									<div class="row">
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[1][answer][1]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[1][choice][1]">
										</div>
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[1][answer][2]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[1][choice][2]">
										</div>
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[1][answer][3]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[1][choice][3]">
										</div>
										<div class="col-md-4 col-lg-3">
											<input type="text" name="test[1][answer][4]", placeholder="Введите ответ">
											<input type="checkbox" value="1" name="test[1][choice][4]">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="minus">1</div>
									
									<div class="pluss">1</div>
								</div>
							</div>
						</div>
						<div class="row">
							
							<div class="tminus"></div>
						
							<div class="tpluss"></div>
							
						</div>
					</div>';


					} else if ($_GET['id'] == 5 ) {
						echo '<p>Произошла ошибка: Данный функционал неготов( сори:) )</p> <a href="?act=home"><- Вернуться</a><br>';
						break;
					}
					
					

					$echo = "<div class='table'>
					<div class='table-wrapper'>
					<div class='table-title'>Панель добавления</div>
					<div class='table-content'>
					<a href='?act=home'><- Вернуться</a><br>
					$message
					<form method='post' class='article-form'>".'
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
							<input type="text" name="title", placeholder="Введите название">
							
							<textarea name="editor1" id="editor1" rows="10" cols="80">
								This is my textarea to be replaced with CKEditor 4.
							</textarea>

							'.$testing.'
							
							<input type="submit" class="button" value="Добавить">'."

							<script>
								CKEDITOR.replace( 'editor1' );
							</script>
					</form>
					</div>
					</div>
					</div>";
				break;
				}
				
		}
		echo $echo;
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
		<script src="js/script.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
	</body>
</html>                    