<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'autobot_laravel');
$we='';
$num='' ;

class DB
{
    // Объект класса PDO
    private $db;
    // Соединение с БД
    public function __construct()
    {
        $this->db = new PDO('mysql:host=' . HOST. ';dbname=' . DB, USER,PASS );
    }
    // Операции над БД
    public function query($sql, $params = [])
    {
        // Подготовка запроса
        $stmt = $this->db->prepare($sql);
        
        // Обход массива с параметрами 
        // и подставляем значения
        if ( !empty($params) ) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        } 
        // Выполняя запрос
        $stmt->execute();
        // Возвращаем ответ
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll($table, $sql = '', $params = [])
    {
        return $this->query("SELECT * FROM $table" . $sql, $params);
    }
}
$params = [ ];
// class DB {...} 
	// Создаём объект
	$db = new DB;

 /*   $params = [
		'model' => 'nev',
        'comment' => '77',
        'id_user' => '2',

	]; */

	// Получаем и выводим данные INSERT INTO
    //  $db->query('INSERT INTO  `reg_cars` ( model, comment, id_user ) VALUES ( :model, :comment, :id_user )   ', $params);
   //   $db->query('UPDATE  `reg_cars` SET  model = :model  WHERE id_reg_car=5  ', $params);
   //$car=$db->getAll('reg_cars' );
//	echo "<pre>";
if( isset($_GET['id'] ) AND isset($_GET['dob'] ) ){ $id=$_GET['id'] ;
    
    $params = [ 'approved' => 1 ];
   $reg= $db->query('UPDATE  `reg_cars` SET  approved = :approved WHERE id_reg_car='.$id.'  ', $params);
   
}

if( isset($_GET['id'] ) AND isset($_GET['del'] ) ){ $id=$_GET['id'] ;
    
    $params = [ 'approved' => 2 ];
   $ger= $db->query('UPDATE  `reg_cars` SET  approved = :approved WHERE id_reg_car='.$id.'  ', $params);
   
}


if( isset($_GET['id'] ) AND isset($_GET['Save'] ) ){ $id=$_GET['id'] ;
    
    $params = [      
        'num_car' => $_GET['num_car'],
        'model' => $_GET['model'],
        'add_info' => $_GET['add_info'],
        'comment' => $_GET['comment'],
        'owner' => $_GET['owner'],
];
   $sav= $db->query('UPDATE  reg_cars r  SET  num_car = :num_car, model= :model, add_info=:add_info, comment=:comment, r.owner=:owner  WHERE id_reg_car='.$id.'  ', $params);   
}



if( isset($_GET['find']) AND  isset($_GET['poisk']) ) { $num=$_GET['poisk'];

  $params = [      
    'num_car' => $_GET['poisk'],
  ];
  $we=" AND r.num_car LIKE '%' :num_car '%' ";
}


$nevz= $db->query('SELECT  id_reg_car   FROM  reg_cars WHERE approved="0" '); 
$row_col =count ($nevz);
if(isset ( $_GET['nevz'] ) ){ echo $row_col; die(); }


$car=$db->query("SELECT  r.id_reg_car , r.num_car, r.model , r.add_info, r.dateTime_order, r.comment, r.approved, r.id_user,r.owner,
                        u.name,u.surname,u.patronymic, 
                       a.address  FROM  reg_cars r ,  users u, addresses a   WHERE r.id_user=u.id_user AND u.id_address=a.id_address ". $we . " "  , $params);
?>



<!DOCTYPE html>
<html>

    <head>
        
        <meta charset="UTF-8">
        <title>Машины</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

      <!--  <link rel="stylesheet" href="css/admin.css"> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">

function nevz(e) {

  $.ajaxSetup({
                headers : {
                    'X-CSRF-Token' : "{{ csrf_token() }}"
                }
              });

                $.ajax({
  type: 'GET',
  url: 'NewRegCar?nevz=1',
  success: function(data) {
    $('#UpdateTable').html(data);
  }
});
 

            }
  
 $(document).ready(function () {
setInterval(function(){
  nevz();
}, 2000);

})

 $(document).ready(function () {

         var myModal = new bootstrap.Modal(document.getElementById('myModal'), { 
  keyboard: false
})
$('.closb').on("click",  function(e)  {  
     myModal.hide();

}); 
            $('#tab').on("dblclick", "tr", function(e) {
                myModal.show();
           var id_reg_car = $(this).children('th:eq(0)') .children('p').text();
    $('#id_reg_car').val(id_reg_car);
           var num_car = $(this).children('td:eq(0)') .children('p').text();
    $('#num_car').val(num_car);
           var model = $(this).children('td:eq(1)') .children('p').text();
    $('#model').val(model);
           var add_info = $(this).children('td:eq(2)') .children('p').text();
    $('#add_info').val(add_info);
           var comment = $(this).children('td:eq(4)') .children('p').text();
    $('#comment').val(comment);
           var owner = $(this).children('td:eq(6)') .children('p').text();
    $('#owner').val(owner);
            })
        });   
            </script>
    </head>
<body>
    <?php if(isset ($reg) ):?>
     <div class="p-3 mb-2 bg-primary text-white"><h2 >Заявка одобрена</h2></div>
    <?php 

    ?>
    <?php endif;?>

    <?php if(isset ($ger) ):?>
     <div class="p-3 mb-2 bg-danger text-white"><h2 >Заявка отклонена</h2></div>
    
    <?php endif;?>

    <?php if(isset ($sav) ):?>
     <div class="p-3 mb-2 bg-success bg-gradient text-white"><h2 >Данные изменены</h2></div>
    <?php endif;?>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin">Назад</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/NewRegCar">Домой</a>
        <a class="nav-link" href="http://127.0.0.1:8000/NewRegCar?nev">Новые заявки <span class=" font-weight-bold" id="UpdateTable"><?php echo $row_col;?></span></a>
      </div>
      <div class="navbar-nav">
        <form action="http://127.0.0.1:8000/NewRegCar"  method="GET">
          <input name="poisk" value="<?php echo $num;?>"/>
         <input name="find" type="submit"  value="Найти">
       </form>
      </div>
    </div>
  </div>
</nav>

<table class="table table-striped table-hover" id="tab">
  <thead>
    <tr>
    <th scope="col">ID машины</th>
    <th scope="col">Номер машины</th>
    <th scope="col">Марка машины</th>
    <th scope="col">Инфо</th>
    <th scope="col">Дата заявки</th>
    <th scope="col">Комент</th>
    <th scope="col">Статус заявки</th>
    <th scope="col">Владелец машины</th>
    <th scope="col">ФИО</th>
    <th scope="col">Адрес</th>
    <th scope="col">Одобрить</th>
    <th scope="col">Отклонить</th>
    </tr>
  </thead>
  <tbody>
    
  <?php foreach( $car as $value): ?>
    <tr id="<?php echo $value['id_reg_car']?>">
    <th scope="col" id="th<?php echo $value['id_reg_car']?>"><p> <?php echo $value['id_reg_car']?></p> </th> 
    <td> <p><?php echo  $value['num_car'] ?></p></td>
    <td> <p><?php echo $value['model'] ?></p></td>
    <td><?php echo '<p>'. $value['add_info']. '</p>'; ?>  </td>
    <td> <?php echo '<p>'. $value['dateTime_order']. '</p>'; ?>  </td>
    <td> <?php echo '<p>'. $value['comment']. '</p>'; ?>  </td>
    <td> <p><?php if($value['approved']=='0') {echo "Ожидается";}
                  if($value['approved']=='1') {echo "Подтверждена";} 
                  if($value['approved']=='2') {echo "Отклонена";}?>   
                </p></td>
                <td> <p><?php if($value['owner']=='0') {echo "Гостевая";}
                  if($value['owner']=='1') {echo "Личная";}?>  
                </p></td>
    <td><?php echo '<p>'.$value['surname'].' '.mb_substr($value['name'], 0, 1) .'. '.mb_substr($value['patronymic'], 0, 1) . '</p>'; ?>  </td>
    <td><?php echo '<p>'. $value['address']. '</p>'; ?>  </td>
    <td>
        <form action="http://127.0.0.1:8000/NewRegCar"  method="GET">
    <input type="hidden" name="id" value="<?php echo $value['id_reg_car']?>"  />
         <input name="dob" type="submit" value="+">
       </form>
    </td>
    <td>
    <form action="http://127.0.0.1:8000/NewRegCar"  method="GET">
    <input type="hidden" name="id" value="<?php echo $value['id_reg_car']?>"  />
         <input name="del" type="submit" value="-">
       </form>        
    </td>
    </tr>
   <?php  endforeach;?>
  </tbody>
</table>



<div class="modal" tabindex="-1" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Изменение данных</h5>
        <button type="button" class="close closb" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="http://127.0.0.1:8000/NewRegCar"  method="GET">
        <input type="hidden" class="form-control" id="id_reg_car" name="id"  value="">
            <div>
                <label for="num_car">Номер машины</label>
                <input type="text" class="form-control" id="num_car" name="num_car" value="">
            </div>
            <div>
                <label for="model">Марка машины</label>
                <input type="text" class="form-control" id="model" name="model"  value="">
            </div>
            <div>
                <label for="add_info">Инфо</label>
                <input type="text" class="form-control" id="add_info" name="add_info"  value="">
            </div>
            <div class="form-group">
                <label for="comment">Комент</label>
                <input type="text" class="form-control" id="comment" name="comment"  value="">
            </div>
            <div class="form-group">
                <label for="owner">Личная/Гостевая</label>
                <input type="text" class="form-control" id="owner" name="owner"  value="">
            </div>
            <div class="form-group">
            <button type="button" class="btn btn-secondary closb" data-dismiss="modal" >Close</button>
            <input name="Save" type="submit" value="Сохранить"  class="Save_changes">
            </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</body>
</html>