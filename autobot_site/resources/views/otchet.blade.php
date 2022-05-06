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
        <div class="row" style="margin-top: 10px">
            <div class="col-xs-12">
                <table id="grid"></table>
            </div>
        </div>
    
    <script type="text/javascript">
        $.ajaxSetup({
                headers : {
                    'X-CSRF-Token' : "{{ csrf_token() }}"
                }
            });
        var grid, dialog, dialogCreate;
        function Edit(e) {
            $('#id_user').val(e.data.record.id_user);
            $('#name').val(e.data.record.name);
            $('#surname').val(e.data.record.surname);
            $('#patronymic').val(e.data.record.patronymic);
            $('#phone_number').val(e.data.record.phone_number);
            $('#address').val(e.data.record.address);
            $('#telegram_id').val(e.data.record.telegram_id);
            $('#approved').val(e.data.record.approved);
            $('#role').val(e.data.record.id_role);

            $('#email').val(e.data.record.email);
            $('#password').val(e.data.record.password);
            dialog.open('Edit user');
        }
        function Create() {
            var record = {
                name: $('#nameC').val(),
                email: $('#emailC').val(),
                password: $('#passwordC').val(),
                surname: $('#surnameC').val(),
                patronymic: $('#patronymicC').val(),
                phone_number: $('#phone_numberC').val(),
                address: $('#addressC').val(),
                telegram_id: $('#telegram_idC').val(),
                approved: $('#approvedC').val(),
                id_role: $('#role_idC').val()
            };
            $.ajax({ url: '/users/create', data: record , method: 'POST' })
                .done(function () {
                    dialogCreate.close();
                    grid.reload();
                })
                .fail(function () {
                    alert('Failed to save.');
                    dialogCreate.close();
                });
        }
        function Save() {
            var record = {
                id_user: $('#id_user').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                surname: $('#surname').val(),
                patronymic: $('#patronymic').val(),
                phone_number: $('#phone_number').val(),
                address: $('#address').val(),
                telegram_id: $('#telegram_id').val(),
                approved: $('#approved').val(),
                id_role: $('#role_id').val()
            };
            $.ajax({ url: '/users/update', data: record , method: 'POST' })
                .done(function () {
                    dialog.close();
                    grid.reload();
                })
                .fail(function () {
                    alert('Failed to save.');
                    dialog.close();
                });
        }
        function Delete(e) {
            if (confirm('Are you sure?')) {
                $.ajax({ url: '/users/delete', data: { id_user: e.data.record.id_user }, method: 'POST' })
                    .done(function () {
                        grid.reload();
                    })
                    .fail(function () {
                        alert('Failed to delete.');
                    });
            }
        }

        $('#btnUpdateUsers').on('click', function () {
            grid.reload();
        });
        
        $(document).ready(function () {
            grid = $('#grid').grid({
                primaryKey: 'id',
                dataSource: '/users/index',
                uiLibrary: 'bootstrap',
                columns: [
                    { field: 'id_user', hidden: true, width: 40 },
                    { field: 'name', title: 'Имя', sortable: true },
                    { field: 'surname', title: 'Фамилия', sortable: true },
                    { field: 'patronymic', title: 'Отчетство', sortable: true },
                    { field: 'phone_number', title: 'Номер телефона', sortable: true },
                    { field: 'address', title: 'Адрес', sortable: true },
                    { field: 'telegram_id', title: 'Код тг', sortable: true },
                    { field: 'approved', title: 'Подтвержден', sortable: true },
                    { field: 'name_role', title: 'Роль', sortable: true },
                    { field: 'email', title: 'Email', sortable: true },
                    { field: 'password', title: 'Пароль', sortable: true },
                    ],
                pager: { limit: 10, sizes: [10, 15, 20, 30] }
            });
            $('#btnSearch').on('click', function () {
                grid.reload({ page: 1, name: $('#txtName').val()});
            });
            $('#btnClear').on('click', function () {
                $('#id_user').val('');
                $('#name').val('');
                $('#surname').val('');
                $('#patronymic').val('');
                $('#phone_number').val('');
                $('#telegram_id').val('');
                $('#approved').val('');
                $('#role').val('');
                $('#email').val('');
                $('#password').val('');
                $('#role_id').val('');
                grid.reload({ name: '', surname: '', patronymic: '', phone_number: '', telegram_id: '', approved: '', email: '', password: '', role_id: '' });
            });
        });
    </script>
</body>
</html>