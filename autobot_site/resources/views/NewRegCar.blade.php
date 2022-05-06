<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Машины</title>
    <meta charset="utf-8" />
    

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/regcar.css">
</head>

<body>
    <header id="header" class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="http://127.0.0.1:8000/">
                    <img src="img/Autobot.png" alt="logo" width="50" height="50">
                </a>
            </div>
            <p class="text1">«Автобот»</p>
            <nav class="header-nav">
                <a href="http://127.0.0.1:8000/">  Выход</a>
            </nav>
        </div>
    </header>
    <button type="submit" class="back">
        <a href="http://127.0.0.1:8000/admin"> 🠔 </a>
    </button>
    <div class="container-full">
        
        <div class="row">
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
                    </div>
                    <button id="btnSearch" type="button" class="btn btn-default">Поиск</button>
                    <button id="btnClear" type="button" class="btn btn-default">Очистить</button>
                    <!-- <button type="button" id="btnCreateTestUsers" class="btn btn-default">+5 </button> -->
                    <input value = "+ *" type="button" id="btnUpdateUsers" class="btn btn-default"/>
                </form>
            </div>
            <div class="col-xs-4">
                <button id="btnAdd" type="button" class="btn btn-default pull-right">Создать новую заявку</button>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-xs-12">
                <table id="grid2"></table>
            </div>
        </div>
    </div>
    <div id="dialogCreate" style="display: none">
        <form>
            <div class="form-group">
                <label for="num_car">Name</label>
                <input type="text" class="form-control" id="num_carC">
            </div>
            <div class="form-group">
                <label for="dateTime_order">DateTime</label>
                <input type="text" class="form-control" id="surnameC">
            </div>
            <div class="form-group">
                <label for="patronymic">Patronymic</label>
                <input type="text" class="form-control" id="patronymicC">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number</label>
                <input type="text" class="form-control" id="phone_numberC">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="addressC">
            </div>
            <div class="form-group">
                <label for="telegram_id">Telegram ID</label>
                <input type="text" class="form-control" id="telegram_idC">
            </div>
            <div class="form-group">
                <label for="approved">Approved</label>
                <input type="text" class="form-control" id="approvedC">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="emailC" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="passwordC" />
            </div>
            <div class="form-group">
                <label for="role_id">Role ID</label>
                <input type="text" class="form-control" id="role_idC" />
            </div>
            <button type="button" id="btnCreateUser" class="btn btn-default">Create</button>
            <button type="button" id="btnCreateCancel" class="btn btn-default">Cancel</button>
            
        </form>
    </div>

    <div id="dialog" style="display: none">
        <input type="hidden" id="id_user" />
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" class="form-control" id="surname">
            </div>
            <div class="form-group">
                <label for="patronymic">Patronymic</label>
                <input type="text" class="form-control" id="patronymic">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number</label>
                <input type="text" class="form-control" id="phone_number">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address">
            </div>
            <div class="form-group">
                <label for="telegram_id">Telegram ID</label>
                <input type="text" class="form-control" id="telegram_id">
            </div>
            <div class="form-group">
                <label for="approved">Approved</label>
                <input type="text" class="form-control" id="approved">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" />
            </div>
            <div class="form-group">
                <label for="role">Role ID</label>
                <input type="text" class="form-control" id="role" />
            </div>
            <button type="button" id="btnSave" class="btn btn-default">Save</button>
            <button type="button" id="btnCancel" class="btn btn-default">Cancel</button>
        </form>
    </div>
    <div class="footer">
            <footer>
                © AVTOBOTS PRODUCTION 2022
            </footer>
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

        $(document).ready(function () {
            grid = $('#grid2').grid({
                uiLibrary: 'bootstrap',
                columns: [
                    { field: 'model', title: 'Марка', sortable: true},
                    { field: 'num_car', title: 'Номер машины', sortable: true},
                    { field: 'dateTime_order', title: 'Дата', sortable: true},
                    { field: 'add_info', title: 'Инфо', sortable: true},
                    { field: 'comment', title: 'Коментарий'},
                    { field: 'id_reg_car', title: 'id машины', hidden: true},
                    { field: 'id_user', title: 'id пользователя', hidden: true},
                    { field: 'owner', title: 'Собственность', sortable: true},
                    { field: 'approved', title: 'Одобрение', sortable: false},
                    { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-plus', tooltip: 'Одобрение', events: { 'click': Dob} },
                    { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-minus', tooltip: 'Отклонение', events: { 'click': Del } },
                    { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-pencil', tooltip: 'Редактировать', events: { 'click': Dob } },
                    { title: '', field: '', width: 36, type: 'icon', icon: 'glyphicon-remove', tooltip: 'Удалить', events: { 'click': Deleete } }
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
</body>
</html>