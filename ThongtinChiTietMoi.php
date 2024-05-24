<?php
    require_once('entities/account.php');
    require_once('entities/thongtin.class.php');
    $id=$_GET['sid'];
    $thongtin = ThongTin::getThongTinById($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Liệu Thầy Dzoãn Xuân Thanh</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .title1{
            color:#0073e6;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-xl-8 col-md-6 col-12">
        <div class="title1">
          <?php
            if ($thongtin && isset($thongtin[0]['infoTitle'])) {
                echo '<h1>'.htmlspecialchars($thongtin[0]['infoTitle']).'</h1>';
            } else {
                echo '<h1>Title Not Available</h1>'; // Display a default message or handle the case where the title is not available
            }
          ?>
      </div>


        </div>
        <div class="col-xl-4 col-md-6 col-12">


        </div>
    </div>



    </div>
</body>
</html>
