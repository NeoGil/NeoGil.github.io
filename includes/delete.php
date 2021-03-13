<?php
require "config.php";
try {
    // Создаем массив, в котором будем хранить идентификаторы записей
    $ids_to_delete = array();
    // Переносим данные (отмеченные записи) из полей формы в массив
    if (isset($_POST['delete_rowT'])) {
        foreach($_POST['delete_rowT'] as $selected){
            $ids_to_delete[] = $selected;
        }
    } elseif (isset($_POST['delete_row'])) {
        foreach($_POST['delete_row'] as $selected){
            $ids_to_delete[] = $selected;
        }
    }
    
 
    // Если пользователь не отметил ни одной записи для удаления,
    // то прерываем выполнение кода
    if(empty($ids_to_delete)){
        header('location:http://schoolnk/adminPanel.php?act=home');
        return;
        
        
    }
    // Если есть хоть одно заполненное поле формы (запись выделена для удаления),
    // то составляем запрос.    
    if(sizeof($ids_to_delete) > 0){
        // Запрос на удаление выделенных записей в таблице
        //$check = 1;
        foreach($ids_to_delete as $select){
            $selects = $select;
            
        }
        
        if (isset($_POST['delete_rowT'])) {
            $result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE tag IN (" . implode(',', array_map('intval', $ids_to_delete)) . ")");
            
            while($results = mysqli_fetch_assoc($result)) {
                echo $results['id']."as";
                $update = mysqli_query($GLOBALS['mysqli'],"UPDATE materials SET tag = NULL WHERE id='$results[id]'");
            }
            $sql = "DELETE FROM tags WHERE id IN (" . implode(',', array_map('intval', $ids_to_delete)) . ")";
            // Перед тем как выполнять запрос предлагаю убедится, что он составлен без ошибок.
            $statement = $mysqli->prepare($sql);
            $statement->execute();
        } elseif (isset($_POST['delete_row'])) {
            $check = mysqli_fetch_array(mysqli_query($GLOBALS['mysqli'],"SELECT * FROM materials WHERE id='$selects'"));
            if ($check['article_id'] == 1) {
                $sql = "DELETE FROM materials WHERE id IN (" . implode(',', array_map('intval', $ids_to_delete)) . ")";
            // Перед тем как выполнять запрос предлагаю убедится, что он составлен без ошибок.
                $statement = $mysqli->prepare($sql);
                $statement->execute();
            } else if ($check['article_id'] == 4) {
                //echo $check;
                $sqlM = "DELETE FROM materials WHERE id IN (" . implode(',', array_map('intval', $ids_to_delete)) . ")";
                $statement = $mysqli->prepare($sqlM);
                $statement->execute();
            // Перед тем как выполнять запрос предлагаю убедится, что он составлен без ошибок.
                foreach($ids_to_delete as $select) {
                    $result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `questions` WHERE `material-id`='$select'");
                    //echo $result['id'];
                    while($results = mysqli_fetch_assoc($result)) {
                        $idsq_to_delete[] = $results['id'];
                    }
                }
                $sqlQ = "DELETE FROM questions WHERE id IN (" . implode(',', array_map('intval', $idsq_to_delete)) . ")";
                $statement = $mysqli->prepare($sqlQ);
                $statement->execute();
                foreach($idsq_to_delete as $select) {
                    $result = mysqli_query($GLOBALS['mysqli'],"SELECT * FROM `answers` WHERE `question-id`='$select'");
                    while($results = mysqli_fetch_assoc($result)) {
                        $idsa_to_delete[] = $results['id'];
                    }
                }
                $sqlA = "DELETE FROM answers WHERE id IN (" . implode(',', array_map('intval', $idsa_to_delete)) . ")";
                echo $sqlA;
                $statement = $mysqli->prepare($sqlA);
                $statement->execute();
                
            }
        }
        
        
       
        // Подготовка запроса.
        //$statement = $mysqli->prepare($sql);
 
        // Выполняем запрос.
        //$statement->execute();
    
        //echo "Записи c id: " . implode(',', array_map('intval', $ids_to_delete)) .  " успешно удалены!";
        header('location:http://schoolnk/adminPanel.php?act=home');
    }
}
 
catch(PDOException $e) {
    echo "Ошибка при удалении записи в базе данных: " . $e->getMessage();
}
 
// Закрываем соединение.
$db = null;
?>