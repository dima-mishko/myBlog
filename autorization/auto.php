<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <form action="login.php" method="post" >
   <h1>Вход на сайт</h1>
    <div>
     <input placeholder="Имя" required="" name="username" type="text">
    </div>
    <div>
     <input placeholder="Пароль" required="" name="password" type="password">
    </div>
	<div>
     Чужой компьютер:<input name="checkbox" type="checkbox">
    </div>
    <div>
      <input value="Войти" type="submit">
    </div>
   </form>
</body>
</html>