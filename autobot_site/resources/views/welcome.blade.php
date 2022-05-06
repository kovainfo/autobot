<!DOCTYPE html>
<html>
<head>
    <title>Getting Started with jQuery Grid</title>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <form action="{{ route('logout') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <button type="submit">Выйти</button>
    </form>
    
    <form action="{{ route('userManage') }}" method="GET">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <button type="submit">Управление пользователями</button>
    </form>

    <form action="{{ route('RegCars') }}" method="GET">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <button type="submit">Список машин</button>
    </form>

    <table id="grid"></table>
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
            grid = $('#grid').grid({
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
    
</body>
</html>
