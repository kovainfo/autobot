<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Охранник</title>
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.jqueryui.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.jqueryui.min.css"/>

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
            <div class="text2">
                <p>ПО ФЕН-ШУЮ АДМИН ДОЛЖЕН<br/>СПАТЬ ГОЛОВОЙ<br/>НА СЕРВЕРЕ</p>
            </div>
            <div class="optimus">
                <img src="img/optimus.png" alt="opt" width="400" height="520">
            </div>
            
            <div class="container3">
                <button type="submit" class="gog">УДАЛИТЬ ПОЛЬЗОВАТЕЛЯ</button>
                <button type="submit" class="gog">УДАЛИТЬ ЗАЯВКУ</button>
                <button type="submit" class="gog">ЗАЯВКИ НА ВЪЕЗД</button>
            </div>  
            <div class="container4">
                <button type="submit" class="gog">ИЗМЕНИТЬ/ДОБАВИТЬ</button>
                <button type="submit" class="gog">ИЗМЕНИТЬ/ДОБАВИТЬ</button>
            </div> 
        </div>
       
        
        <div class="footer">
            <footer>
                © AVTOBOTS PRODUCTION 2022
            </footer>
        </div>
        
        <script>
            $(document).ready(function() {
                $('#table_1').DataTable();
            } );
        </script>
        
    </body>
</html>