<?php
	//Запускаем сессию\
	//ob_start();
	
?>
<!-- General site header -->

<header>
	<nav>
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-5">
					<a href="/" class="logo"><img src="icons/vector/logo1.svg" alt="logo"></a>
				</div>
				<div class="col-xl-8 col-lg-7 col-md-9 col-sm-6 col-4">

					<ul class="menu">
						<li class="menu_item"><a href="/" class="menu_link">Главная страница</a></li>
						<!-- accesses a table in the database -->
						<?php
							$query = $mysqli->query('SELECT * FROM menu_item');
						?>
						<!-- the main menu item is generated in order using the table elements and also creates a link that is unique for each of the elements with certain ID -->
						<?php
							while ($item = mysqli_fetch_assoc($query))
							{
								?>
								<li class="menu_item"><a href="/crossroad.php?id=<?php echo $item['id']; ?>" class="menu_link"><?php echo $item['title']; ?></a></li>
							<?php
							}
						?>
					</ul>
				</div>
				
				
				<div id="auth_block" >
					<?php
						//Проверяем авторизован ли пользователь
						if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
							// если нет, то выводим блок с ссылками на страницу регистрации и авторизации
					?>
							<div id="link_auth">
								<a class="login" href="/form_auth.php" alt="icons/vector/login.svg">
									<img class="login_img" src="/icons/vector/login.svg">
								</a>
							</div>
					<?php
						}else{
							//Если пользователь авторизован, то выводим ссылку Выход
					?> 
							<div id="link_logout">
								<a href="/includes/logout.php" alt="icons/vector/login.svg">
									<img class="adminPanel_img" src="/icons/vector/logOut.svg">
								</a>
							</div>
							<div id="link_adminPanel">
								<a href="/adminPanel.php" alt="icons/vector/login.svg">
									<img class="adminPanel_img" src="/icons/vector/adminPanel.svg">
								</a>
							</div>
					<?php
						}
						ob_end_flush();
					?>
				</div>
				<a href=""  class="back" onclick="javascript:history.back(-2); return false;"  alt="icons/vector/batton_back.svg">
					<img class="back_img" src="icons/vector/batton_back.svg" alt="back_img">
				</a>
				<div class="hamburger">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
	</nav>
</header>