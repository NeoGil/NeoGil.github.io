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
						<div class="block_for_messages">
							<?php
						
								if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
									echo $_SESSION["error_messages"];
						
									//Уничтожаем чтобы не появилось заново при обновлении страницы
									unset($_SESSION["error_messages"]);
								}
						
								if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
									echo $_SESSION["success_messages"];
									
									//Уничтожаем чтобы не появилось заново при обновлении страницы
									unset($_SESSION["success_messages"]);
								}
							?>
						</div>
						
						<?php
							//Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
							//иначе выводим сообщение о том, что он уже авторизован
							if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
						?>
						
						
							<div id="form_auth">
								<h2>Форма авторизации</h2>
								<form action="auth.php" method="post" name="form_auth">
									<table>
								
										<tbody><tr>
											<td> Имя: </td>
											<td>
												<input type="text" name="login" required="required"><br>
												<span id="valid_login_message" class="mesage_error"></span>
											</td>
										</tr>
								
										<tr>
											<td> Пароль: </td>
											<td>
												<input type="password" name="password" placeholder="минимум 6 символов" required="required"><br>
												<span id="valid_password_message" class="mesage_error"></span>
											</td>
										</tr>
						
										<tr>
											<td colspan="2">
												<input type="submit" name="btn_submit_auth" value="Войти">
											</td>
										</tr>
									</tbody></table>
								</form>
							</div>
						
						<?php
							}else{
						?>
						
							<div id="authorized">
								<h2>Вы уже авторизованы</h2>
							</div>
						
						<?php
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