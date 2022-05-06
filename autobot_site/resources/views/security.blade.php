<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Охранник</title>
        <link rel="stylesheet" href="css/security.css">
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <div class="maincontainer">
        <header id="header" class="header">
                <div class="container d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="/">
                            <img src="img/Autobot.png" alt="logo" width="50" height="50">
                        </a>
                    </div>
                    <p class="text1">«Автобот»</p>
                    <nav class="header-nav">
                        <a href="/otchetAuto">Отчёт заявок на въезд      |</a>
                        <a href="/">  Выход</a>
                    </nav>
                </div>
            </header>
            <div class="text2">
                <p>ОХРАНА РАБОТАЕТ КАК <br/>ЧАСЫ!</p>
            </div>
            <div class="col-xs-8">
                <form class="form-inline">
                    <div class="form-group">
                        <input id="txtNumCar" type="text" placeholder="Номер машины" class="form-control" />
                        <!-- <input id="txtSurname" type="text" placeholder="Surname" class="form-control" /> -->
                        <!-- <input id="txtPatronymic" type="text" placeholder="Patronymic" class="form-control" />
                        <input id="txtPhone_number" type="text" placeholder="Phone number" class="form-control" />
                        <input id="txtTelegram_id" type="text" placeholder="Telegram ID" class="form-control" />
                        <input id="txtApproved" type="text" placeholder="Approved" class="form-control" /> -->
                        <input id="txtdateTime" type="text" placeholder="Дата" class="form-control" />
                        <!-- <input id="txtPassword" type="text" placeholder="Password" class="form-control" />
                        <input id="txtRole" type="text" placeholder="Role" class="form-control" /> -->
                        <button id="btnSearch" type="button" class="btn btn-default">Поиск</button>
                    <button id="btnClear" type="button" class="btn btn-default">Очистить</button>r
                    </div>
                    
                    <!-- <button type="button" id="btnCreateTestUsers" class="btn btn-default">+5 </button> -->
                    
                </form>
            </div>
            <p class="text3">ЗАЯВКИ НА ВЪЕЗД</p>
            <input value = "+ * users" type="button" id="btnUpdateUsers" class="btn btn-default"/>
            <table id="grid2" class="table table-sortable"></table>
            <p class="text4">ПОЛЬЗОВАТЕЛИ</p>
            <table id="grid4"></table>  
            <div class="footer" id="foooter">
                <footer>
                    © AVTOBOTS PRODUCTION 2022
                </footer>
            </div>
        </div>        

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
                    owner: e.data.record.owner,
                    approved: 1

                };
                $.ajax({ url: '/reg_cars/update', data: record, method: 'POST' })  
                .done(function () {
                    alert('Выполнено.');
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
                    owner: e.data.record.owner,
                    approved: 2
                };
                $.ajax({ url: '/reg_cars/update', data: record, method: 'POST' })  
                .done(function () {
                    alert('Выполнено.');
                    grid.reload();
                })
                .fail(function () {
                    alert('Ошибка в отклонении.');
                });
            }
        }

        function Deleete(e) {
                if (confirm('Вы уверены')) {
                    $.ajax({ url: '/reg_cars/delete', data: { id: e.data.id }, method: 'POST' })
                        .done(function () {
                            alert('Выполнено.');
                            grid.reload();
                        })
                        .fail(function () {
                            alert('Отказ в удалении.');
                        });
                }
            }

            let timerId = setInterval(() => {

            var xhr = new XMLHttpRequest()
            xhr.open('GET', 'reg_cars/getCount', true)
            xhr.send()

            xhr.onreadystatechange = function() {
                if (xhr.readyState != 4) {
                    return
            }

            var UsersCount = JSON.parse(xhr.responseText)   
            var newUsersCount = UsersCount.count - grid.count(true)
            $('#btnUpdateUsers').val("+" + newUsersCount)
            if (xhr.status === 200) {
                    console.log('result', xhr.responseText)
                } else {
                    console.log('err', xhr.responseText)
                }
            }            
            }, 2000);

            $('#btnUpdateUsers').on('click', function () {
                grid.reload();
            });

        $(document).ready(function () {
            grid = $('#grid2').grid({
                uiLibrary: 'bootstrap',
                columns: [
                    { field: 'model', width: 100, title: 'Марка', sortable: true},
                    { field: 'num_car', title: 'Номер машины', sortable: true},
                    { field: 'dateTime_order', title: 'Дата', sortable: true},
                    { field: 'add_info', title: 'Инфо', sortable: true},
                    { field: 'comment', title: 'Коментарий'},
                    { field: 'id_reg_car', title: 'id машины', hidden: true},
                    { field: 'id_user', title: 'id пользователя', hidden: true},
                    { field: 'owner', title: 'Собственность', sortable: true},
                    { field: 'approved', title: 'Одобрение', sortable: false},
                    { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-plus', tooltip: 'Одобрение', events: { 'click': Dob} },
                    { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-minus', tooltip: 'Отклонение', events: { 'click': Del } }
                  
                ],
                dataSource: '/reg_cars/',
                sort: true,
                pager: { limit: 5, sizes: [2, 5, 10, 20] }
            });
            $('#btnSearch').on('click', function () {
                grid.reload({ page: 1, num_car: $('#txtNumCar').val(), dateTime_order: $('#txtdateTime').val()});
            });
            $('#btnClear').on('click', function () {
                $('#id_reg_car').val('');
                $('#num_car').val('');
                $('#model').val('');
                $('#add_info').val('');
                $('#dateTime_order').val('');
                $('#comment').val('');
                $('#approved').val('');
                $('#id_user').val('');
                $('#owner').val('');
                grid.reload({ id_reg_car: '', num_car: '', model: '', add_info: '', dateTime_order: '', comment: '', approved: '', id_user: '', owner: '' });
            });
        });
    </script>

    <script type="text/javascript">
            $.ajaxSetup({
                    headers : {
                        'X-CSRF-Token' : "{{ csrf_token() }}"
                    }
                });
            var grid2, dialog, dialogCreate;
            function Edit(e) {
                $('#id').val(e.data.id);
                $('#name').val(e.data.record.name);
                $('#email').val(e.data.record.email);
                $('#password').val(e.data.record.password);
                $('#user_id').val(e.data.record.user_id);
                dialog.open('Edit user');
            }
            function Create() {
                var record = {
                    name: $('#nameC').val(),
                    email: $('#emailC').val(),
                    password: $('#passwordC').val(),
                    role_id: $('#role_idC').val()
                };
                $.ajax({ url: '/users/create', data: record , method: 'POST' })
                    .done(function () {
                        dialogCreate.close();
                        grid2.reload();
                    })
                    .fail(function () {
                        alert('Failed to save.');
                        dialogCreate.close();
                    });
            }
            function Save() {
                var record = {
                    id: $('#id').val(),
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    role_id: $('#role_id').val()
                };
                $.ajax({ url: '/users/update', data: record , method: 'POST' })
                    .done(function () {
                        dialog.close();
                        grid2.reload();
                    })
                    .fail(function () {
                        alert('Failed to save.');
                        dialog.close();
                    });
            }
            function Delete(e) {
                if (confirm('Are you sure?')) {
                    $.ajax({ url: '/users/delete', data: { id: e.data.id }, method: 'POST' })
                        .done(function () {
                            grid2.reload();
                        })
                        .fail(function () {
                            alert('Failed to delete.');
                        });
                }
            }
            $(document).ready(function () {
                grid2 = $('#grid4').grid({
                    primaryKey: 'id',
                    dataSource: '/users/index',
                    uiLibrary: 'bootstrap',
                    columns: [           
                        { field: 'id', width:35, align:'center', title: 'ID' },
                        { field: 'name', title: 'Имя', sortable: true },
                        { field: 'email', title: 'Почта', sortable: true },
                        { field: 'password', title: 'Пароль', sortable: true },
                        { field: 'id_role', width:55, align:'center', title: 'Роль', sortable: false},
                    ],
                    pager: { limit: 5, sizes: [2, 5, 10, 20] }
                });
            });
        </script>
    </body>
</html>