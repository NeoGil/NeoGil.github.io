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
		<link rel="stylesheet" href="css/styless.min.css">
		<title>NEKRASOVA SCHOOL</title>
	</head>
	<body>
		<?php include "includes/header.php"?>
		
		
		<div class="filling">

			<div class="container">
				<div class="row">
					<?php
						$quer = $mysqli->query('SELECT * FROM `materials` WHERE `id` ='.(int)$_GET['id']);
						$materials = mysqli_fetch_assoc($quer);
						$mdCol = "";
						if ($materials['tag'] != null) {
							$mdCol = "col-md-9";
						}
					?>
					<div class="col-12 <?php echo $mdCol?>">
						<div class="content">
							<?php
								$article = mysqli_fetch_assoc($mysqli->query('SELECT * FROM `articles_id`'));
								/*checks the sent id for extra characters*/
								if (mysqli_num_rows($quer) <= 0 ) {
									?>
									<section class="crossroads">
										<div class="container">
											<div class="row">
												<div class="col-md-12">
													<h2 class="direction">Ощибка</h2>
												</div>
											</div>
										</div>
									</section>
									<?php
								} elseif ( $materials['article_id'] == 4) {
									
                                    //$coun = $mysqli->query('SELECT COUNT(*) FROM `questions` WHERE `material-id` ='.(int)$_GET['id']);
									
									//$count = mysqli_fetch_assoc($coun);
									
									$result = $mysqli->query('SELECT * FROM `questions` WHERE `material-id` ='.(int)$_GET['id']); 
                                    $qwest = null;
									while($myrow = mysqli_fetch_assoc($result)) {
										$json = json_decode(file_get_contents('qwest.json'), true);
										$question = $myrow['question'];
										
										//$js  = ['sldf','sldf','sldf','sldf','sldf'];
										//var_dump($js);
										//$js[] = $ans;
										//var_dump($js);
										//$nonw = ['a','b','d','s','g'];
										$correctAnswer = 'c';
										$json = [];
										$arr = [];
                                        $pops = [];
										$arrs['question'] = $question;
										$question_id =  (int)$myrow['id'];
                                        //echo $question_id;
										$resul = $mysqli->query('SELECT * FROM `answers` WHERE `question-id` ='.$question_id); 
										$js = [];
                                        $n = '';
										while ($myrows = mysqli_fetch_assoc($resul)) {
											$js[] = $myrows['answer'];
											$pops[$myrows['name']] =$myrows['answer'] ;
											$arrs['answers'] = $pops;
											if ($myrows['choice'] == 1) {
                                                $n =$n.$myrows['name'];
											}
											$arrs['correctAnswer'] = $n;
										}
										//$arrs['correctAnswer'] = $correctAnswer;
										//var_dump($arrs);
										$qwest[] = $arrs;
									}
										
										
										
									//}
									file_put_contents('qwest.json', json_encode($qwest, JSON_UNESCAPED_UNICODE));
									
									?>
									<div class="quest"
										<div class="container">
											<div class="row">
												<div class="col-md-12">
													<h4 class="direction"><?php echo $materials['text']; ?></h2>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="page">
														<div class="dark-area clearfix">
															<div class="clearfix">
																<div class="c100 p50 big dark">
																	<span id="persent"><div id="results"></div></span>
																	<div class="slice">
																		<div class="bar"></div>
																		<div class="fill"></div>
																	</div>
																</div>           
															</div>
														</div>
													</div>   
													<div id="quiz"></div>
													<button id="submit">Начать тест</button>
												</div>
											</div>
										</div>
												
									<?php
								} else {
									//var_dump($materials);
									//$materials = mysqli_fetch_assoc($quer)
									?>
									<h1><?php echo $materials['title']; ?></h1>
									<?php
									echo $materials['text'];
								}

							?>


						</div>
					</div>
					<?php
						if ($materials['tag'] != null) {
								?>
									<div class="col">
										<div class="tag_menu">
											<h3>Связаные темы</h3>
											<?php
												$query = $mysqli->query('SELECT * FROM `articles_id`');
											?>
											<?php
												
												
												while ($item = mysqli_fetch_assoc($query)) {
													//echo $item['title'];
													$tems = "";
													if ($item['id'] >= 1) {
														$quer = $mysqli->query('SELECT * FROM `materials` WHERE `article_id` ='.$item['id']);
														
														while ($material = mysqli_fetch_assoc($quer)) {
															if ( $material['tag'] == $materials['tag']) {
																$tems .= "<li><a href='/lectures.php?id=".$material['id']."; ?>'>".$material['title']."</a></li>";
															} else {
																$tems = "¯\_(ツ)_/¯";
															}
															
														
														}
													} else {
														$tems = "<li><div>Данный материал отсутствует</div></li>";
													}
													echo '
													<div class="tag_item">
														<div class="alert alert-dark" role="alert">
															'.$item['title'].'
															<ul>
																'.$tems.'
															</ul>
														</div>
													</div>
														
														';
												}
												?>
													
										</div>
									</div>
								<?php	
						}
					?>
					
				</div>
			</div>

		</div>

		<!-- Здесь подключается footer страницы -->
		<?php include "includes/footer.php" ?>
		<!-- Здесь подключаются js скрипты -->
		<script src="js/alfa.js"></script>
		<script src="js/hamburger.js"></script>
		<script src="js/jquery-3.5.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>