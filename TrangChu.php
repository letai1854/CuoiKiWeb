<?php
  require_once('entities/account.php');
  require_once('entities/subject.class.php');
  require_once('entities/thongtin.class.php');
  session_start();
  if(isset($_SESSION['username'])){
    $userName=user::get_teacherName($_SESSION['username']);
    $owner=true;
  }
  else{
    $owner=false;
  }

  $list_subject = Detail::showLimitSubject8();
  if(isset($_POST['Delete'])){
    $id=$_POST['Id'];
    $result = Detail::delete_Subject($id);
  }
  try {
    $list_subject = Detail::showLimitSubject8();
  } catch (Exception $e) {

  }

  $list_thongbao = ThongTin::getListThongTinByType("thongbao");
  $list_vieclam = ThongTin::getListThongTinByType4("vieclam");
  $list_tintuc = ThongTin::getListThongTinByType1("tintuc");
  if(isset($_POST['Delete_thongtin'])){
    $id=$_POST['Id_thongtin'];
    $result = ThongTin::deleteThongTin($id);
  }



  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
      .card{
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        border-radius: 5px;
      }
      .card:hover{
        transform: scale(1.05);
        transition: 0.3s ease;
      }

      .xemthem{
            font-weight: bold;
            display: flex;
            align-items: flex-end;
            justify-content: end;
        }

      .xemthem a:hover {
        color: black;
      }
      .item-subject .card2 {
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
      }

      .item-subject .card2:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      }

      .item-subject .card2 .card-img-wrapper {
        width: 100%;
        height: 150px; /* Set a fixed height for images */
        overflow: hidden;
      }

      .item-subject .card2 .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .item-subject .card2 .card-body {
        padding: 1rem;
        text-align: center;
      }

      .item-subject .card2 .card-body a {
        display: block;
        color: black;
        text-decoration: none;
        font-weight: bold;
      }

      .item-subject .card2 .card-body a:hover {
        color: red;
      }
      .item-subject .card2 .card-body a:hover {
        color: red;
      }
      .item-subject .card2 .card-body .mt-2 {
        margin-top: 0.5rem;
        font-size: 0.9rem;
      }

      .item-subject .card2 .btn {
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
      }

      .item-subject .card2 .btn:hover {
        opacity: 0.8;
      }

      .item-subject .card2 .btn a {
        color: white;
        text-decoration: none;
      }
      .header {
        display: flex;
        align-items: center;
        font-size: 1.8rem;
        font-weight: bold;
        color: rgba(255, 0, 0, 0.793);
      }

      .header {
        display: flex;
        align-items: center;
        font-size: 1.8rem;
        font-weight: bold;
        color: rgba(255, 0, 0, 0.793);
      }

      .item-subject .card3 {
        overflow: hidden;
        /* transition: transform 0.3s, box-shadow 0.3s; */
        height: 100%;
      }

      .item-subject .card3:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      }

      .item-subject .card3 .card-img-wrapper {
        width: 100%;
        height: 150px; ; /* Set a fixed height for images */
        overflow: hidden;
      }

      .item-subject .card3 .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .item-subject .card3 .card-body {
        padding: 1rem;
        /* text-align: center; */
      }

      .item-subject .card3 .card-body a {
        display: block;
        color: black;
        text-decoration: none;
        font-weight: bold;
      }

      .item-subject .card3 .card-body a:hover {
        color: red;
      }

      .item-subject .card3 .card-body .mt-2 {
        margin-top: 0.5rem;
        font-size: 0.9rem;
      }
      .thongbaopanel a:hover {
        color: red;
      }
      .xemct a {
        color: black;
      }
      .xemct a:hover {
        color: red;
      }
      .vieclamcard .vieclamtitle {
        color: black;
      }
      .vieclamcard .vieclamtitle:hover {
        color: red;
      }
</style>
</head>


<body>
  <div class="container">
    <div id="logo">
      <div>    
          <img src="./logo.png" alt="Logo"></div>
          <div><h2 style="margin-left: 6px;">ĐẠI HỌC <br> TÔN ĐỨC THẮNG</h2>
            <h4 style="margin-left: 6px;">GIẢNG VIÊN KHOA CÔNG NGHỆ THÔNG TIN</h4>
          </div>
      </div>
      <!-- <img src="./images/user1.jpg" alt="User Image"> -->
  </div>

  <?php require_once("nav.php") ?>
  <!-- <nav class="navbar navbar-expand-lg py-3">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarColor01">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="#">GIỚI THIỆU</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./MonHoc.php">MÔN HỌC</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./tintucchitiet.php">TIN TỨC</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./thongbaochitiet.php">THÔNG BÁO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./vieclamchitiet.php">VIỆC LÀM</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              NGHIÊN CỨU
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="chitiethoinghikhoahoc.php">HỘI NGHỊ KHOA HỌC</a>
              <a class="dropdown-item" href="chitietnckh.php">CÔNG TRÌNH NGHIÊN CỨU KHOA HỌC</a>
              <a class="dropdown-item" href="chitietcongbokhoahoc.php">CÔNG BỐ KHOA HỌC</a>
            </div>
          </li>
          <?php if ($owner) {
            echo '<li class="nav-item">
                    <a class="nav-link active" href="./Admin.php">ADMIN</a>
                  </li>';
          } ?>
        </ul>
        <div class="user-info ms-auto">
          <a class="nav-link" href="./login.php"><i class="fas fa-user"></i></a>
          <?php if($owner) { echo '<p class="text-white mb-0">'. $userName.'</p>'; } ?>
        </div>
      </div>
    </div>
  </nav> -->
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="image/bg.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="image/background1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="image/bg3.JPG" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container" style="margin-bottom:150px">
  <div class="row container subject-report1 mt-3">
      <div class="col-xl-9 col-md-6 col-sm-12 col-12">
      
          <div class="text-center" style="font-size: 1.8rem;font-weight: bold; color:rgba(255, 0, 0, 0.793); "> 
          <div class="">
          </div>
          <p>Môn học <br>
          <hr style="color: red; border-top: 2px solid red; font-weight: bold;"> </p></div>
          <div class="row" >
              <?php
              if(isset($list_subject))
              {
                if(is_array($list_subject))
                {
                  foreach($list_subject as $item)
                  {
                    echo '<div  class="col-xl-4 col-md-6 col-sm-6 col-12  mb-3 item-subject">
                    <div class="card "> 
                      <img src="'.htmlspecialchars($item['subjectImage']).'" alt="">
                      <div class="card-body">
                        <p class="card-text text-center" style="color: black">'.htmlspecialchars($item['subjectName']).'</p>
                        <div class="chitiet" style="text-align: center;">
                        <div class="xemct">
  <p><a style="font-size: 0.8rem; text-decoration: none;" href="ChiTietTaiLieu.php?sid='.$item['subjectCode'].'">Xem chi tiết</a></p>
</div>
</div>

                    ';
                    echo '</div>
                    </div>
                    </div>';
                }
              }
            }
            ?>
        <div class="xemthem"><a style="text-decoration: none;
                    color: red;" href="./MonHoc.php"><i class="fas fa-square-plus"></i> Xem thêm</a></div>
      </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 col-12 sidebar">
        <div class="thongbaopanel">
              <h5 style="color:red;"><i class="fas fa-newspaper"></i> Thông báo mới</h5>
              <br>
              <ul>
                  <?php
                  $list_thongbao = ThongTin::getListThongTinByTypeLimit8("thongbao");
                  if(isset($list_thongbao))
                  {
                      if(is_array($list_thongbao))
                      {
                          foreach($list_thongbao as $item)
                          {
                              echo '<li><a href="./noidungthongbao.php?sid='.htmlspecialchars($item['id']).'">'.htmlspecialchars($item['infoTitle']).'<br><span class="date">'.htmlspecialchars($item['day']).'</span> <span class="new">mới</span></a></li>';
                          }
                      }
                  }
                  ?>
              </ul>
              <div class="xemthem"><a style="text-decoration: none;
                    color: red;" href="./thongbaochitiet.php"><i class="fas fa-square-plus"></i> Xem thêm</a></div>
      </div>
          </div>
  </div>


    <!-- <div class="col-lg-4 col-md-12 col-12 sidebar">
        <h5><i class="fas fa-newspaper"></i> Thông tin mới</h5>
        <br>
        <ul>
            <?php
            // $list_thongbao = ThongTin::getListThongTinByTypeLimit8("thongbao");
            // if(isset($list_thongbao))
            // {
            //     if(is_array($list_thongbao))
            //     {
            //         foreach($list_thongbao as $item)
            //         {
            //             echo '<li><a href="#">'.htmlspecialchars($item['infoTitle']).'<br><span class="date">'.htmlspecialchars($item['day']).'</span> <span class="new">mới</span></a></li>';
            //         }
            //     }
            // }
            ?>
        </ul>
        <div class="xemthem"><a style="text-decoration: none;
              color: red;" href=""><i class="fas fa-square-plus"></i> Xem thêm</a></div>
    </div> -->






    <div class="row container mt-4">
      <div class="col-xl-9 col-md-8 col-sm-6 col-12">
        <div class="mb-3"  style="display: inline-block; font-size: 1.8rem; font-weight: bold; color: rgba(255, 0, 0, 0.793); "> <!-- Container bọc quanh cả biểu tượng và văn bản -->
          <i class=" fas fa-calendar"></i> <!-- Biểu tượng -->
          <p style="display: inline; margin-left: 5px;">Thông tin việc làm
          <hr style="width: 100%; border-top: 2px solid red; margin-bottom: 20px;">
      </p> <!-- Văn bản -->
      </div>
      <div class="row">
  <?php
  if (isset($list_vieclam)) {
    if (is_array($list_vieclam)) {
      foreach ($list_vieclam as $item) {
        echo '<div class="col-xl-3 col-md-6 col-sm-12 col-12 mb-3 item-subject">
                <div class="card2">
                  <div class="card-img-wrapper">
                    <img src="'.htmlspecialchars($item['infoImage']).'" class="card-img-top" alt="">
                  </div>
                  <div class="card-body text-center vieclamcard">
                    <a style="text-decoration: none;" href="./noidungvieclam.php?sid='.htmlspecialchars($item['id']).'">
                      <small class="vieclamtitle" style="font-weight: bold;">'.htmlspecialchars($item['infoTitle']).'</small>
                    </a>
                    <div class="mt-2">
                      <small>'.htmlspecialchars($item['day']).'</small>
                    </div>';
        echo '</div>
              </div>
              </div>';
      }
    }
  }
  ?>
</div>
<div class="xemthem"><a style="text-decoration: none;
                    color: red;" href="./vieclamchitiet.php"><i class="fas fa-square-plus"></i> Xem thêm</a></div>


    </div>
    
    <div class="col-xl-3 col-md-4 col-sm-6 col-12 item-subject">
  <div class="mb-3 header" style="display: flex; align-items: center; font-size: 1.8rem; font-weight: bold; color: rgba(255, 0, 0, 0.793);">
    <p style="margin-left: 5px;">    <i class="fas fa-calendar"></i> Tin tức</p>
  </div>
  <?php
  if (isset($list_tintuc)) {
    if (is_array($list_tintuc)) {
      foreach ($list_tintuc as $item) {
        echo '<div class="card3 shadow-sm mb-3">
                <div class="card-img-wrapper">
                  <img src="'.htmlspecialchars($item['infoImage']).'" alt="" class="card-img-top">
                </div>
                <div class="card-body">
                  <p class="card-text"><a href="./noidungtintuc.php?sid='.htmlspecialchars($item['id']).'">'.htmlspecialchars($item['infoTitle']).'</a></p>';
        echo '  </div>
              </div>';
      }
    }
  }
  ?>
<div class="xemthem"><a style="text-decoration: none;
                    color: red;" href="./tintucchitiet.php"><i class="fas fa-square-plus"></i> Xem thêm</a></div>
  
</div>



</div>
</div>

<?php require_once("footer.php") ?>

    <script>
    function delete_btn(id) {
        if (confirm('Bạn có chắc muốn xóa môn học') == true) {
            var idstr = id.toString();
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "");

            var id = document.createElement("input");
            id.setAttribute("type", "text");
            id.setAttribute("name", "Id");
            id.setAttribute("value", '' + idstr);

            var btn = document.createElement("button");
            btn.setAttribute("type", "submit");
            btn.setAttribute("name", "Delete");
            form.appendChild(id);
            form.appendChild(btn);
            document.getElementsByTagName("body")[0]
                .appendChild(form);
            btn.click();
        }
    }
    function delete_thongtin(id) {
      if (confirm('Bạn có chắc muốn xóa thông báo') == true) {
            var idstr = id.toString();
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "");

            var id = document.createElement("input");
            id.setAttribute("type", "text");
            id.setAttribute("name", "Id_thongtin");
            id.setAttribute("value", '' + idstr);

            var btn = document.createElement("button");
            btn.setAttribute("type", "submit");
            btn.setAttribute("name", "Delete_thongtin");
            form.appendChild(id);
            form.appendChild(btn);
            document.getElementsByTagName("body")[0]
                .appendChild(form);
            btn.click();
        }
    }
</script>



</body>
</html>
