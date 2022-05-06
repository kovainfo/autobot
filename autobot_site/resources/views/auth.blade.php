<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css/styles.css" rel="stylesheet" type="text/css">
      <title>Авторизация</title>
  </head>
  <body>
    <form action="{{ route('login') }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <label id="lb1">Авторизация</label>
      <input id="in1" type="text" placeholder="Логин" name="email" required>
      <input id="in2" type="password" placeholder="Пароль" name="password" required>
      <button id="logIn" type="submit">Войти</button>
      <label id="lb2">«АВТОБОТ ОПТИМУС ПРАЙМ </br>К ВАШИМ УСЛУГАМ!»</label>
      <div class="container2">	
        <img src="img/Autobot.png" alt="Avatar" class="avatar">
      </div>
    </form>
  </body>
</html>