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
		<!-- Здесь подключается header страницы -->
		<?php include "includes/header.php" ?>
		<!-- Первая секция основной страницы -->

		<!-- generates cards with specific images and unique id links -->
		<?php
			$article = $mysqli->query("SELECT * FROM `articles_categories` WHERE `id` =".(int)$_GET['id']);
			/*checks the sent id for extra characters*/
		  	if ($_GET['id'] == 5)
			{
				?>
			  	<div class="filling">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="content">
									<?php 
                                        echo mysqli_fetch_assoc($article)['text'];
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			} elseif (mysqli_num_rows($article) <= 0 )
			{
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
			}else {
				$art = mysqli_fetch_assoc($article);
				?>
				<section class="crossroads">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h2 class="direction"><?php echo $art['title']; ?></h2>
								<div class="accordion" id="accordionExample">

									<?php
										$query = $mysqli->query('SELECT * FROM `articles_id`');
									?>
									<?php
										while ($item = mysqli_fetch_assoc($query))
										{
											?>
											<div class="card">
												<div class="card-header" id="heading<?php echo $item['id_text']; ?>">
													<h2 class="mb-0">
														<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $item['id_text']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $item['id_text']; ?>">
															<?php echo $item['title'] ?>
														</button>
													</h2>
												</div>

												<div id="collapse<?php echo $item['id_text']; ?>" class="collapse show" aria-labelledby="heading<?php echo $item['id_text']; ?>" data-parent="#accordionExample">
													<div class="card-body">
														<ul>
															<?php

															if ($item['id'] >= 1) {
																$quer = $mysqli->query('SELECT * FROM `materials` WHERE `category_id` ='.(int)$_GET['id'].' AND `article_id` ='.$item['id']);
																while ($materials = mysqli_fetch_assoc($quer))
																{
																		?>
																		<li><a href="/lectures.php?id=<?php echo $materials['id']; ?>"><?php echo $materials['title'] ?></a></li>
																		<?php
																}

															} else
															{
																?>
																<li><div>Данный материал отсутствует</div></li>
																<?php

															}


															?>
														</ul>
													</div>
												</div>
											</div>
											<?php
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</section>

				<?php
			}
		?>
		<!-- Здесь подключается footer страницы -->
		<?php include "includes/footer.php" ?>
		<!-- Здесь подключаются js скрипты -->
		<script src="js/hamburger.js"></script>
		<script src="js/jquery-3.5.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>