<?php 
// если была нажата кнопка "Отправить" 
if($_GET['submit']) { 
        // $_POST['title'] содержит данные из поля "Тема", trim() - убираем все лишние пробелы и переносы строк, htmlspecialchars() - преобразует специальные символы в HTML сущности, будем считать для того, чтобы простейшие попытки взломать наш сайт обломались, ну и  substr($_POST['title'], 0, 1000) - урезаем текст до 1000 символов. Для переменной $_POST['mess'] все аналогично 
        $subject = substr(htmlspecialchars(trim($_GET['subject'])), 0, 1000); 
        $mess =  substr(htmlspecialchars(trim($_POST['mess'])), 0, 1000000); 
        // $to - кому отправляем 
        $to = 'eu.bogomaz@gmail.com'; 
        // $from - от кого 
        $from='y.bohomaz@gmail.com'; 
        // функция, которая отправляет наше письмо. 
        mail($to, $subject, $mess, 'From:'.$from); 
        echo 'Спасибо! Ваше письмо отправлено.'; 
} 