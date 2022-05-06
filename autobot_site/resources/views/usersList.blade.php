<?php
use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Пользователи</title>
    <link rel="stylesheet" href="css/usersList.css">
</head>
<body>
    <?php
        $contorller = new UserController();
        $request = new Request($_REQUEST);
        $data = json_decode($contorller->index($request)->content())->records;
        $hideKeys = ["id_user", "id_role", "id_address", "id_essence", "remember_token"];
        //dd($data);
    ?>
    <table class="table">
        <tr>
            <td>Фамилия</td>
            <td>Имя</td>
            <td>Отчество</td>
            <td>Номер телефона</td>
            <td>Телеграм Id</td>
            <td>Статус</td>
            <td>Адрес</td>
            <td>Роль</td>
            <td>Email</td>
            <td>Пароль</td>
        </tr>
    <?php foreach ($data as $item):?>
        <tr>
            <?php foreach($item as $key => $attribute):?>
                <?php if(in_array($key, $hideKeys)) continue;?>
                <td><?php 
                if($key == "approved") {
                    switch($attribute){
                        case "0":
                            echo "Ожидает";
                            break;
                        case "1":
                            echo "Одобрен";
                            break;
                        case "2":
                            echo "Забанен";
                            break;
                        default:
                            echo "Неизвестно";
                            break;
                    }
                }
                elseif($key == "name_role"){
                    switch($attribute){
                        case "liver":
                            echo "Житель";
                            break;
                        case "admin":
                            echo "Администратор";
                            break;
                        case "guard":
                            echo "Охранник";
                            break;
                        default:
                            echo "Неизвестно";
                            break;
                    }
                }
                else echo $attribute; 
                ?></td>
            <?php endforeach;?>
        </tr>
    <?php endforeach;?>
    </table>
</body>
</html>