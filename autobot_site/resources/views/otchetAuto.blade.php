<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Отчёт по заявкам пользователей</title>
    <meta charset="utf-8" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-full">
        <div class="row">
            <div class="col-xs-8">
                <form class="form-inline">
                    <div class="form-group">
                        <input id="txtDate" type="text" placeholder="Дата" class="form-control" />
                    </div>
                    <button id="btnSearch" type="button" class="btn btn-default">Поиск</button>
                    <button id="btnClear" type="button" class="btn btn-default">Очистить</button>
                </form>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-xs-12">
                <table id="grid"></table>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $.ajaxSetup({
                headers : {
                    'X-CSRF-Token' : "{{ csrf_token() }}"
                }
            });
        var grid, dialog, dialogCreate;

        $(document).ready(function () {
            grid = $('#grid').grid({
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
                    { field: 'approved', title: 'Одобрение', sortable: false}
                ],
                dataSource: '/reg_cars/',
                sort: true,
                pager: { limit: 10, sizes: [10, 20] }
            });
            $('#btnSearch').on('click', function () {
                grid.reload({ page: 1, dateTime_order: $('#txtDate').val()});
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