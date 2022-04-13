<!DOCTYPE html>
<html>

    <head>
        
        <meta charset="UTF-8">
        <title>Администратор</title>
        <link rel="stylesheet" href="css/admin.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <form action="{{ route('userManage') }}" method="GET">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button type="submit">Управление пользователями</button>
            </form>
            <form class=formtable>
                <div class="text2">
                    <p>ПО ФЕН-ШУЮ АДМИН ДОЛЖЕН<br/>СПАТЬ ГОЛОВОЙ<br/>НА СЕРВЕРЕ</p>
                </div>
                <div class="text3">
                    <p>ЗАЯВКИ НА РЕГИСТРАЦИЮ</p>
                </div>
                
                <table class="grid1" id="grid2"></table>

                <div class="text4">
                    <p>ЗАЯВКИ НА ВЪЕЗД</p>
                </div>

                <table class="grid3" id="grid4"></table>
            </form>



            <!-- <div class="container3">
                <button type="submit" class="gog">УДАЛИТЬ ПОЛЬЗОВАТЕЛЯ</button>
                <button type="submit" class="gog">УДАЛИТЬ ЗАЯВКУ</button>
                <button type="submit" class="gog">ЗАЯВКИ НА ВЪЕЗД</button>
            </div>  
            <div class="container4">
                <button type="submit" class="gog">ИЗМЕНИТЬ/ДОБАВИТЬ</button>
                <button type="submit" class="gog">ИЗМЕНИТЬ/ДОБАВИТЬ</button>
            </div>  -->

        </div>
       
        <div class="footer">
            <footer>
                © AVTOBOTS PRODUCTION 2022
            </footer>
        </div>
        

        <script type="text/javascript">
    var grid;
    function UpAdd(e) {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-Token' : "{{ csrf_token() }}"
                }
            });
            if (confirm('Are you sure?')) {
                var record = {
                    id_user: e.data.record.id_user,
                    name: e.data.record.name,
                    surname: e.data.record.surname,
                    patronymic: e.data.record.patronymic,
                    phone_number: e.data.record.phone_number,
                    address: e.data.record.address,
                    telegram_id: e.data.record.telegram_id,
                    approved: 1
                };
                $.ajax({ url: '/users/update', data: record, method: 'POST' })  
                .done(function () {
                    alert('Nice.');
                    grid.reload();
                })
                .fail(function () {
                    alert('Failed to save.');
                });
            }
        }
        function Update(e) {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-Token' : "{{ csrf_token() }}"
                }
            });
            if (confirm('Are you sure?')) {
                var record = {
                    id_user: e.data.record.id_user,
                    name: e.data.record.name,
                    surname: e.data.record.surname,
                    patronymic: e.data.record.patronymic,
                    phone_number: e.data.record.phone_number,
                    address: e.data.record.address,
                    telegram_id: e.data.record.telegram_id,
                    approved: 2
                };
                $.ajax({ url: '/users/update', data: record, method: 'POST' })  
                .done(function () {
                    alert('Nice.');
                    grid.reload();
                })
                .fail(function () {
                    alert('Failed to save.');
                });
            }
        }
        $(document).ready(function () {
            grid = $('#grid2').grid({
                dataSource: '/users/index',
                columns: [
                    { field: 'id_user', title: 'id', hidden: true},
                    { field: 'name', title: 'Имя', sortable: true, colspan: 3}, 
                    { field: 'surname', title: 'Фамилия', sortable: true},
                    { field: 'patronymic', title: 'Отчетство', sortable: true},
                    { field: 'phone_number', title: 'Номер телеофна'},
                    { field: 'address', title: 'Номер участка'},
                    { field: 'telegram_id', title: 'ID Телеграма'},
                    { field: 'approved', title: 'Статус'},
                    { width: 124, tmpl: '<button>Добавить</button>', align: 'center', events: { 'click': UpAdd } },
                    { width: 124, tmpl: '<button>Бан</button>', align: 'center', events: { 'click': Update } }
                ],
                pager: { limit: 5 }
            });
        });
    </script>

    






<script type="text/javascript">
    var grid;

    function Dob(e) {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-Token' : "{{ csrf_token() }}"
                }
                
            });
            if (confirm('Вы уверены?')) {
                var record = {
                    num_car: e.data.record.num_car,
                    model: e.data.record.model,
                    add_info: e.data.record.add_info,
                    dateTime_order: e.data.record.dateTime_order,
                    comment: e.data.record.comment,
                    id_reg_car: e.data.record.id_reg_car,
                    id_user: e.data.record.id_user,
                    approved: 1

                };
                $.ajax({ url: '/reg_cars/update', data: record, method: 'POST' })  
                .done(function () {
                    alert('Nice.');
                    grid.reload();
                })
                .fail(function () {
                    alert('Ошибка сохранения.');
                });
            }
        }
        function Del(e) {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-Token' : "{{ csrf_token() }}"
                }
            });
            if (confirm('Вы уверены?')) {
                var record = {
                    num_car: e.data.record.num_car,
                    model: e.data.record.model,
                    add_info: e.data.record.add_info,
                    dateTime_order: e.data.record.dateTime_order,
                    comment: e.data.record.comment,
                    id_reg_car: e.data.record.id_reg_car,
                    id_user: e.data.record.id_user,
                    approved: 2
                };
                $.ajax({ url: '/reg_cars/update', data: record, method: 'POST' })  
                .done(function () {
                    alert('Nice.');
                    grid.reload();
                })
                .fail(function () {
                    alert('Ошибка сохранения.');
                });
            }
        }
        $(document).ready(function () {
            grid = $('#grid4').grid({
                dataSource: '/reg_cars/',
                columns: [

                    { field: 'model', title: 'Марка', sortable: true},
                    { field: 'num_car', title: 'Номер машины'},
                    { field: 'dateTime_order', title: 'Дата'},
                    { field: 'add_info', title: 'Инфо'},
                    { field: 'comment', title: 'Коментарий'},
                    { field: 'id_reg_car', title: 'id машины', hidden: true},
                    { field: 'id_user', title: 'id пользователя', hidden: true},
                    { field: 'approved', title: 'Действия'},
                    { width: 124, tmpl: '<button>Одобрить</button>', align: 'center', events: { 'click': Dob } },
                    { width: 124, tmpl: '<button>Отклонить</button>', align: 'center', events: { 'click': Del } }
                ],
                pager: { limit: 5 }
            });
        });
    </script>

    </body>
</html>