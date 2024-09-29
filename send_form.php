<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Заявка отправлена</title>
</head>
<body>
    <div class="alert">
        <h1>Ваша заявка отправлена!<h1><br>
        <a href=".">Вернуться на главную</a>
    </div>
</body>
</html>

<?php
require_once 'amo/access.php';
require_once 'Form.php';
require_once 'amo/Amo.php';
require_once 'bitrix/Bitrix.php';

$form = new Form($_POST["name"], $_POST["phone"], $_POST["comment"]);

$amo = new Amo($subdomain, $access_token, $field_id);
$amo->send();

$bitrix = new Bitrix();
$bitrix->send();

?>