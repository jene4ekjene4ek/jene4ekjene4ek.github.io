<?php 

function complete_mail() { 
        // $_POST['title'] содержит данные из поля "Тема", trim() - убираем все лишние пробелы и переносы строк, htmlspecialchars() - преобразует специальные символы в HTML сущности, будем считать для того, чтобы простейшие попытки взломать наш сайт обломались, ну и  substr($_POST['title'], 0, 1000) - урезаем текст до 1000 символов. Для переменных $_POST['mess'], $_POST['name'], $_POST['tel'], $_POST['email'] все аналогично 
        $_GET['subject'] = 'Заказ от '.date('d.m.Y').'г.';
        $_GET['mess'] =  substr(htmlspecialchars(trim($_GET['mess'])), 0, 1000000); 
        $_GET['user_name'] =  substr(htmlspecialchars(trim($_GET['user_name'])), 0, 30); 
        $_GET['user_phone'] =  substr(htmlspecialchars(trim($_GET['user_phone'])), 0, 30); 
        $_GET['user_mail'] =  substr(htmlspecialchars(trim($_GET['user_mail'])), 0, 50); 
        // если не заполнено поле "Имя" - показываем ошибку 0 
        if (empty($_GET['user_name'])) 
             output_err(0); 
        // если неправильно заполнено поле email - показываем ошибку 1 
        if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_GET['user_mail'])) 
             output_err(1); 
        // если не заполнено поле "Сообщение" - показываем ошибку 2 
        if(empty($_GET['user_phone'])) 
             output_err(2); 
        // создаем наше сообщение 
        $mess = ' 
Имя отправителя:'.$_GET['user_name'].' 
Контактный телефон:'.$_GET['user_phone'].' 
Контактный email:'.$_GET['user_mail'].' 
'.$_GET['mess']; 
        // $to - кому отправляем 
        $to = 'eu.bogomaz@gmail.com'; 
        // $from - от кого 
        $from='y.bohomaz@gmail.com'; 
        mail($to, $_GET['title'], $mess, "From:".$from); 
        echo 'Спасибо! Ваше письмо отправлено.'; 
} 

function output_err($num) 
{ 
    $err[0] = 'ОШИБКА! Не введено имя.'; 
    $err[1] = 'ОШИБКА! Неверно введен e-mail.'; 
    $err[2] = 'ОШИБКА! Не введено сообщение.'; 
    echo '<p>'.$err[$num].'</p>'; 
    show_form(); 
    exit(); 
} 

if (!empty($_GET['submit'])) complete_mail(); 
else show_form(); 
