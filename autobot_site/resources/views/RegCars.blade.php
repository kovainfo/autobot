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

    <form action="{{ route('index') }}" method="GET">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <button type="submit">Назад</button>
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
            grid = $('#grid').grid({
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