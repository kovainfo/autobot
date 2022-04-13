<!DOCTYPE html>
<html>
<head>
    <title>Getting Started with jQuery Grid</title>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <form action="{{ route('logout') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <button type="submit">Выйти</button>
    </form>
    <table id="grid"></table>
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
                    telegram_user_id: e.data.record.telegram_user_id,
                    address: e.data.record.address,
                    date_time: e.data.record.date_time,
                    full_name: e.data.record.full_name,
                    phone_number: e.data.record.phone_number,
                    comment: e.data.record.comment,
                    status: e.data.record.status,
                    add_info: e.data.record.add_info,
                    id: e.data.record.id,
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
                    telegram_user_id: e.data.record.telegram_user_id,
                    address: e.data.record.address,
                    date_time: e.data.record.date_time,
                    full_name: e.data.record.full_name,
                    phone_number: e.data.record.phone_number,
                    comment: e.data.record.comment,
                    status: e.data.record.status,
                    add_info: e.data.record.add_info,
                    id: e.data.record.id,
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
            grid = $('#grid').grid({
                dataSource: '/reg_cars/',
                columns: [

                    { field: 'add_info', title: 'Марка', sortable: true},
                    { field: 'telegram_user_id', title: 'ID телеграмм пользователя'},
                    { field: 'num_car', title: 'Номер машины'},
                    { field: 'date_time', title: 'Дата'},
                    { field: 'address', title: 'Адресс'},
                    { field: 'full_name', title: 'Имя'},
                    { field: 'phone_number', title: 'Номер телефона'},
                    { field: 'comment', title: 'Коментарий'},
                    { field: 'status', title: 'статус'},
                    { field: 'id', title: 'id', hidden: true},
                    { field: 'approved', title: 'Действия'},
                    { width: 124, tmpl: '<button>Добавить</button>', align: 'center', events: { 'click': Dob } },
                    { width: 124, tmpl: '<button>Бан</button>', align: 'center', events: { 'click': Del } }
                ],
                pager: { limit: 5 }
            });
        });
    </script>
</body>
</html>





            

            