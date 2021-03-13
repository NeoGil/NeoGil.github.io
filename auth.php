<?php
ob_start();
session_start();
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
<?php
    
    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION["error_messages"] = '';
    
    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION["success_messages"] = '';
    /*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
    */
    if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){
    
        //(1) Место для следующего куска кода
        if(isset($_POST["login"])){
 
            //Обрезаем пробелы с начала и с конца строки
            $login = trim($_POST["login"]);
         
            if(!empty($login)){
                $login = htmlspecialchars($login, ENT_QUOTES);
    
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш логин</p>";
                 
                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: http://schoolnk/form_auth.php");
         
                //Останавливаем скрипт
                exit();
            }
             
        }else{
            // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода логин</p>";
             
            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: http://schoolnk/form_auth.php");
         
            //Останавливаем скрипт
            exit();
        }
    
    }else{
        exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=/> главную страницу </a>.</p>");
    }

    if(isset($_POST["password"])){
 
        //Обрезаем пробелы с начала и с конца строки
        $password = trim($_POST["password"]);
     
        if(!empty($password)){
            $password = htmlspecialchars($password, ENT_QUOTES);
     
            //Шифруем пароль
            //$password = md5($password."top_secret");
        }else{
            // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш пароль</p>";
             
            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: http://schoolnk/form_auth.php");
     
            //Останавливаем скрипт
            exit();
        }
         
    }else{
        // Сохраняем в сессию сообщение об ошибке. 
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода пароля</p>";
         
        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://schoolnk/form_auth.php");
     
        //Останавливаем скрипт
        exit();
    }
    
    //Запрос в БД на выборке пользователя.
    $result_query_select = $mysqli->query("SELECT * FROM `userlist` WHERE login = '".$login."' AND password = '".$password."'");

    if(!$result_query_select){
        // Сохраняем в сессию сообщение об ошибке. 
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на выборке пользователя из БД</p>";
        
        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://schoolnk/form_auth.php");
    
        //Останавливаем скрипт
        exit();
    }else{
        //echo $result_query_select->num_rows;
        //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
        if($result_query_select->num_rows == 1){
            $resul = mysqli_fetch_assoc($result_query_select);
            // Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $_SESSION['accessLevel'] = $resul['admin'];
            //Возвращаем пользователя на главную страницу
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /");
    
        }else{
            
            // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Неправильный логин и/или пароль</p>";
            
            //Возвращаем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /form_auth.php");
    
            //Останавливаем скрипт
            exit();
        }
    }


?>
<?php
ob_end_flush();
?>


