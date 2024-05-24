<?php
    require_once('entities/account.php');
    require_once('entities/thongtin.class.php');
    session_start();
    if(isset($_SESSION['username'])){
      $userName=user::get_teacherName($_SESSION['username']);
      $owner=true;
    }
    else{
      $owner=false;
    }
    $id=$_GET['sid'];
    $thongtin = ThongTin::getThongTinById($id);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
   
</head>
<body>
    <div class="container">
        <div id="logo">
          <div>    <img src="./logo.png" alt="Logo"></div>
              
                <div><h2 style="margin-left: 6px;">ĐẠI HỌC <br> TÔN ĐỨC THẮNG</h2>
                  <h4 style="margin-left: 6px;">KHOA CÔNG NGHỆ THÔNG TIN</h4>
                </div>
            </div>
      </div>
      <div class="titleh1">
          <?php
            if ($thongtin && isset($thongtin[0]['infoTitle'])) {
                echo '<h1>'.htmlspecialchars($thongtin[0]['infoTitle']).'</h1>';
            } else {
                echo '<h1>Title Not Available</h1>'; // Display a default message or handle the case where the title is not available
            }
          ?>
      </div>
      <p>
          <?php
            if ($thongtin && isset($thongtin[0]['day'])) {
                echo htmlspecialchars($thongtin[0]['day']);
            } else {
                echo 'Day not availabel'; // Display a default message or handle the case where the title is not available
            }
          ?>
      </p>
      <hr style="color: red; border-top: 2px solid red; font-weight: bold;"> </p></div>
       
            <?php
            if ($thongtin && isset($thongtin[0]['infoContents'])) {
                echo $thongtin[0]['infoContents'];
            } else {
                echo 'Error'; 
            }
          ?>
   </div>

