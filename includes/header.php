<header>
	<nav>
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-5">
					<a href="/" class="logo"><img src="icons/vector/logo1.svg" alt="logo"></a>
				</div>
				<div class="col-xl-9 col-lg-9 col-md-9 col-sm-6 col-4">

					<ul class="menu">
						<li class="menu_item"><a href="/" class="menu_link">Главная страница</a></li>
						<?php
							$query = $mysqli->query('SELECT * FROM menu_item');
						?>
						<?php
							while ($item = mysqli_fetch_assoc($query))
							{
								?>
								<li class="menu_item"><a href="/crossroad.php?id=<?php echo $item['id']; ?>" class="menu_link"><?php echo $item['title']; ?></a></li>
							<?php
							}
						?>
						<!-- <li class="menu_item"><a href="#" class="menu_link">Главная страница</a></li>
						<li class="menu_item"><a href="#require" class="menu_link">Общая химия</a></li>
						<li class="menu_item"><a href="#require" class="menu_link">Неорганическая химия</a></li>
						<li class="menu_item"><a href="#" class="menu_link">Органическая химия</a></li>
						<li class="menu_item"><a href="#" class="menu_link">Специальные вопросы химии</a></li>
						<li class="menu_item"><a href="#" class="menu_link">справочные материалы</a></li> -->
					</ul>
				</div>
				<div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-2">
					<a href="#"  class="back"  alt="icons/vector/batton_back.svg">
						<img class="back_img" src="icons/vector/batton_back.svg" alt="back_img">
					</a>
				</div>
				<div class="hamburger">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
	</nav>
</header>