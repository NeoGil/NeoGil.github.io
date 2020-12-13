<?php

//require "includes/config.php";
//session_start();



$echo = "<div class='table'>
<div class='tale-wrapper'>
			<div class='table-title'>Войти в панель администратора</div>
			<div class='table-content'>
						<form method='post' id='login-form' class='login-form'>
									  <input type='text' placeholder='Логин' class='input'
										name='login' required><br>
									 <input type='password' placeholder='Пароль' class='input'
									   name='password' required><br>
									<input type='submit' value='Войти' class='button'>
					  </form>
			 </div>
</div>
</div>";

//$loginResults = $mysqli->query('SELECT * FROM `userlist` WHERE `title` ="'.$_POST['title'].'"');
function login($login,$password) {

	//Обязательно нужно провести валидацию логина и пароля, чтобыисключить вероятность инъекции
	//Запрос в базу данных
	//$loginResults = $GLOBALS['mysqli']->query('SELECT * FROM `userlist` WHERE `login` ="$login" AND `password`="$password"AND `admin`="1"');
	$loginResult = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM userlist WHERE login='$login' AND password='$password' AND admin='1'");
	if(mysqli_num_rows($loginResult) == 1) {  //Если есть совпадение,возвращается true
		echo "Привет ".$_SESSION['login'];
		if(isset($_GET['act'])) {$act = $_GET['act'];} else {$act = 'home';}
		switch($act) {
			case 'home':
				/*$article_result = mysqli_query($db,"SELECT * FROM articles");
				if(mysqli_num_rows($article_result) >= 1) {
							while($article_array = mysqli_fetch_array($article_result)) {
										$articles = "<div class='table-content__list-item'><a href='?act=edit_article&id=$article_array[id]'>$article_array[id] | $article_array[title]</a></div>";
							}
				} else {
						$articles = "Статей пока нет";
				}*/
				$users_result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM userlist");
				if(mysqli_num_rows($users_result) >= 1) {
					//echo "norm";
					while($users_array = mysqli_fetch_array($users_result)) {
						$users .= "<div class='table-content__list-item'><a href='? act=edit_user&id=$users_array[id]'>$users_array[id] |$users_array[login]</a></div>";
						//echo ($users);
					}
				} else {
					$users = "Статей пока нет";
				}
				$article_result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials");
				if(mysqli_num_rows($article_result) >= 1) {
					while($article_array = mysqli_fetch_array($article_result)) {
						$articles .= "<div class='table-content__list-item'><a href='?act=edit_article&id=$article_array[id]'>$article_array[id] |
						$article_array[title]</a></div>";
					}
				} else {
					$articles = "Статей пока нет";
				}
				$echo = "<div class='tables'>
							<div class='table'>
								<div class='table-wrapper'>
									<div class='table-title'>Страницы</div>
										<div class='table-content'>
											$articles
											<a href='?act=add_article'                                                                                          class='table__add-button'                                                                                         id='add_article'>+</a>
										</div>
									</div>
								</div>
							</div>
							<div class='table'>
								<div class='table-wrapper'>
									<div class='table-title'>Пользователи</div>
										<div class='table-content'>
											$users
											<a href='?act=add_user'                                                                                  class='table__add-button'
											id='add_user'>+</a>
										</div>
									</div>
								</div>
							</div>
						</div>";
			break;

			case 'edit_article':
				if(isset($_GET['id'])) {
				$id = $_GET['id'];
				$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE id='$id'");
					if(mysqli_num_rows($result) == 1) {
						if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['text'])) {
							//Тут должна быть валидация
							//Обновление таблицы
							$update = mysqli_query($GLOBALS['mysqli'],"UPDATE materials SET title='$_POST[title]', text='$_POST[text]', category_id='$_POST[category_id]', article_id='$_POST[article_id]' WHERE id='$id'");
							if($update) {
								//Если обновление прошло успешно, получаются новые данные
								$result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE id='$id'");
								$message = "Успешно обновлено!";
							}
						}
						$article = mysqli_fetch_array($result);//Получение информации в массив
						//Форма редактирования
						//session_start();
						$echo = "<div class='table'>
									<div class='table-wrapper'>
										<div class='table-title'>Редактирование статьи</div>
										<div class='table-content'>
										<a href='?act=home'><- Вернуться</a><br>
										$message
										<form method='post' class='article-form'>
											<b>Название:</b> <input type='text' name='title' value='$article[title]'><br>
											<b>Текст:</b> <textarea name='text'>$article[text]</textarea></br>
											<b>Категория:</b> <input type='text' name='category_id' value='$article[category_id]'><br>
											<b>Артикл:</b> <input type='text' name='article_id' value='$article[article_id]'><br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
										</div>
									</div>
								</div>";
					}
				}
				break;
		}
		echo $echo;
		$_COOKIE['login'] = $_POST['login'];

		$_COOKIE['password'] = $_POST['password'];
		return true;
	} else {//Если такого пользователя не существует, данные стираются, а возвращается false

		unset($_SESSION['login'],$_SESSION['password']);
		return false;

	}

}

if(isset($_POST['login']) && isset($_POST['password'])) {
	
	$_SESSION['login'] = $_POST['login'];

	$_SESSION['password'] = $_POST['password'];

}

if(isset($_SESSION['login']) && isset($_SESSION['password'])) {
	if(login($_SESSION['login'],$_SESSION['password'])) {//Попытка авторизации
	//Тут будут проходить все операции

		$echo = null; //Обнуление переменной, чтобы удалить из вывода форму авторизации
	}

}

?>