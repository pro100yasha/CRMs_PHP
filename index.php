<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    </head> 
<body>
    <form action="send_form.php" method="post">
        <h1>Заявка</h1>
        <span>Имя</span><br>
        <input type="text" name="name" required placeholder="Иван"><br>
        <span>Телефон</span><br>
        <input id="phone" type="text" name="phone" minlength="18" npaste="return false;"required placeholder="+7( _ _ _ )_ _ _ - _ _ - _ _"><br>
        <span>Комментарий</span><br>
        <input type="text" name="comment" required placeholder="Ваш комментарий"><br><br>
        <div class="submit"><input type="submit" value="Отправить"></div>
    </form>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <title>Форма</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

$(function(){
  $("#phone").mask("+7 (999) 999-99-99");
});

</script>