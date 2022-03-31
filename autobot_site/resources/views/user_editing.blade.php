<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Редактирование пользователей</title>
        <link rel="stylesheet" href="css/user_editing.css">
    </head>
    <body>
        <div class="maincontainer">
            <header id="header" class="header">
                <div class="container d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="#">
                            <img src="img/Autobot.png" alt="logo" width="50" height="50">
                        </a>
                    </div>
                    <p class="text1">«Автобот»</p>
                    <nav class="header-nav">
                        <a href="#">Выход</a>
                    </nav>
                </div>
            </header>
            <div>
                <button type="submit" class="back">
                    <span> 🠔 </span>
                </button>
                <p class="text2">РЕДАКТИРОВАНИЕ ПОЛЬЗОВАТЕЛЕЙ</p>
            </div>
            <div class="container1">				
                    <input type="text" placeholder="Фамилия" class="input" required>				
                    <input type="text" placeholder="Имя" class="input" required>
                    <input type="text" placeholder="Отчество" class="input" required>					
                    <input type="text" placeholder="Марка машины" class="input" required>					 				
                    <input type="text" placeholder="Номер машины" class="input" required>								
                    <input type="text" placeholder="Цвет машины" class="input" required>
                    <input type="text" placeholder="Роль" class="input" required>
            </div>     
            <div class="container3">
                <button type="submit" class="gog">ДОБАВИТЬ</button>
                <button type="submit" class="gog">ИЗМЕНИТЬ</button>
                <button type="submit" class="gog">УДАЛИТЬ</button>
            </div> 
        </div>
        
        <div class="footer">
            <footer>
                © AVTOBOTS PRODUCTION 2022
            </footer>
        </div>
    </body>
</html>