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

  $list_subject = Detail::list_Subject();
  if(isset($_POST['Delete'])){
    $id=$_POST['Id'];
    $result = Detail::delete_Subject($id);
  }
  try {
    $list_subject = Detail::list_Subject();
  } catch (Exception $e) {

  }

  $list_thongbao = ThongTin::getListThongTinByType("thongbao");
  $list_vieclam = ThongTin::getListThongTinByType("vieclam");
  $list_tintuc = ThongTin::getListThongTinByType("tintuc");
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
    <title>home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="css/trangchustyle.css">
</head>
<body>
  <div class="container">
    <div id="logo">
      <div>    
          <img src="./logo.png" alt="Logo"></div>
          <div><h2 style="margin-left: 6px;">ĐẠI HỌC <br> TÔN ĐỨC THẮNG</h2>
            <h4 style="margin-left: 6px;">KHOA CÔNG NGHỆ THÔNG TIN</h4>
          </div>
      </div>
  </div>


  <nav class="navbar navbar-expand-lg py-3">
    <div class="container">
      <?php if($owner) { echo '<p class="text-white mb-0">'. $userName.'</p>'; } ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarColor01">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="#">GIỚI THIỆU</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">MÔN HỌC</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">TIN TỨC</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">THÔNG BÁO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">VIỆC LÀM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">NGHIÊN CỨU</a>
          </li>
          <?php if ($owner) {
            echo '<li class="nav-item">
                    <a class="nav-link active" href="./Admin.php">ADMIN</a>
                  </li>';
          } ?>
        </ul>
        <div class="user-info ms-auto">
          <a class="nav-link" href="./login.php"><i class="fas fa-user"></i></a>
          <img src="./images/user1.jpg" alt="User Image">
        </div>
      </div>
    </div>
  </nav>
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/bg.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="image/background1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="image/bgtdtu1.jpg" class="d-block w-100" alt="...">
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

    <div class="row container subject-report mt-3">
        <div class="col-xl-9 col-md-6 col-sm-12 col-12">
            <div class="text-center" style="font-size: 1.8rem;font-weight: bold; color:rgba(255, 0, 0, 0.793); "><p>Môn học <br>
            <hr style="color: red; border-top: 2px solid red; font-weight: bold;"> </p></div>
            <div class="row">
                <?php
                if(isset($list_subject))
                {
                  if(is_array($list_subject))
                  {
                    foreach($list_subject as $item)
                    {
                      echo '<div class="col-xl-3 col-md-3 col-sm-12 mb-3 item-subject">
                      <div class="card shadow-sm"> 
                        <img src="'.htmlspecialchars($item['subjectImage']).'" alt="">
                        <div class="card-body">
                          <p class="card-text text-center" style="color: blue;">'.htmlspecialchars($item['subjectName']).'</p>
                          <div class="chitiet" style="text-align: center;">
    <p><a style="color: red; text-decoration: none;" href="ChiTietMonHoc.php?sid='.$item['subjectCode'].'">Xem chi tiết</a></p>
</div>

                      ';
                      if($owner)
                      {
                        echo '<button type="button" class="btn btn-sm" style="background-color: rgb(213, 198, 101); border-radius: 3px; width:50px" name="deletebtn"><a style="color: white; text-decoration: none;" href="suamonhoc.php?sid='.$item['subjectCode'].'">Sửa</a></button>
                        <button type="button" class="btn btn-sm" style="color: white; background-color: rgb(36, 36, 153); border-radius: 3px; width:50px" name="updatebtn" onclick="delete_btn(\'' . htmlspecialchars($item['subjectCode']) . '\')">Xóa</button>
                        <button type="button" class="btn btn-sm" style="background-color: rgb(32, 115, 40); border-radius: 3px; width:60px">
                        <a style="color: white; text-decoration: none; width:150px"><a style="color: white; text-decoration: none;" href="themTaiLieu.php?sid='.$item['subjectCode'].'">Thêm</a></a>
                        </button>';
                      }
                      echo '</div>
                      </div>
                      </div>';
                  }
                }
              }
              ?>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 col-sm-12 col-12">
        <div style="display: inline-block; font-size: 1.8rem; font-weight: bold; color: rgba(255, 0, 0, 0.793);"> 
          <i class="fas fa-newspaper"></i> 
          <p style="display: inline; margin-left: 5px;">Thông báo</p> 
      </div>
      <div class="row newspaper" style="margin-top: 14px; width:500px; padding-bottom:4px;">
      <?php
        if (isset($list_thongbao)) {
            if (is_array($list_thongbao)) {
                foreach ($list_thongbao as $item) {
                  echo '<li><a href="#">'.htmlspecialchars($item['infoTitle']).'<br><span class="date">'.htmlspecialchars($item['day']).'</span> <span class="new">mới</span></a></li>';
                    if ($owner) {
                        echo '<div class="thongbao-actions">';
                        echo '<button class="edit-btn"><a href="capnhatthongtin.php?id=' . $item['id'] . '">Sửa</a></button>';
                        echo '<button class="delete-btn" onclick="delete_thongtin(\'' . htmlspecialchars($item['id']) . '\')">Xoá</button>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
        }
      ?>
      </div>
    
    </div>
    </div>

    <!-- <div class="col-lg-4 col-md-12 col-12 sidebar">
        <h5><i class="fas fa-newspaper"></i> Thông tin mới</h5>
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
                        echo '<li><a href="#">'.htmlspecialchars($item['infoTitle']).'<br><span class="date">'.htmlspecialchars($item['day']).'</span> <span class="new">mới</span></a></li>';
                    }
                }
            }
            ?>
        </ul>
        <div class="xemthem"><a style="text-decoration: none;
              color: red;" href=""><i class="fas fa-square-plus"></i> Xem thêm</a></div>
    </div> -->






    <div class="row container mt-4">
      <div class="col-xl-9 col-md-8 col-sm-6 col-12">
        <div class="mb-3"  style="display: inline-block; font-size: 1.8rem; font-weight: bold; color: rgba(255, 0, 0, 0.793); "> <!-- Container bọc quanh cả biểu tượng và văn bản -->
          <i class=" fas fa-calendar"></i> <!-- Biểu tượng -->
          <p style="display: inline; margin-left: 5px;">Thông tin việc làm</p> <!-- Văn bản -->
      </div>
      <div class="row">
          <?php
          if (isset($list_vieclam)) {
            if (is_array(($list_vieclam))) {
              foreach ($list_vieclam as $item) {
                echo '<div class="col-xl-3 col-md-3 col-sm-12 mb-3 item-subject">
                      <div class="card shadow-sm">
                        <img src="'.htmlspecialchars($item['infoImage']).'" alt="">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                            <a style="text-decoration: none;" href="chitietthongtin.php?sid='.$item['id'].'"><small class="text-body-secondary">'.htmlspecialchars($item['infoTitle']).'</small></a>
                            <div class="mt-2"><small class="text-body-secondary">' . htmlspecialchars($item['day']) . '</small></div>
                          </div>'
                        ;

              if ($owner) {
                echo '<div class="mt-3">'; // Add margin top for button alignment
                echo '<button type="button" class="btn btn-sm" style="background-color: rgb(213, 198, 101); border-radius: 3px; width:50px" name="deletebtn"><a style="color: white; text-decoration: none;" href="capnhatthongtin.php?id='.$item['id'].'">Sửa</a></button>
                      <button type="button" class="btn btn-sm ml-2" style="color: white; background-color: rgb(36, 36, 153); border-radius: 3px; width:50px" name="updatebtn" onclick="delete_thongtin(\'' . htmlspecialchars($item['id']) . '\')">Xóa</button>';
                echo '</div>'; // Close the div for button alignment
              }
              echo '</div>
                    </div>
                    </div>';
              }
            }
          }
        ?>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
      <div class="mb-3"  style="display: inline-block; font-size: 1.8rem; font-weight: bold; color: rgba(255, 0, 0, 0.793); "> <!-- Container bọc quanh cả biểu tượng và văn bản -->
        <i class="fas fa-newspaper fas fa-calendar"></i> <!-- Biểu tượng -->
        <p style="display: inline; margin-left: 5px;">Tin tức</p> <!-- Văn bản -->
    </div>
    <?php
      if (isset($list_tintuc)) {
        if (is_array(($list_tintuc))) {
          foreach ($list_tintuc as $item) {
            echo '<div class="card shadow-sm" style="border: 2px solid rgba(0, 0, 0, 0.386);"> 
                  <img src="'.htmlspecialchars($item['infoImage']).'" alt="">
                  <div class="card-body">
                    <p class="card-text "><a style="text-decoration: none;" href="chitietthongtin.php?sid='.$item['id'].'">'.htmlspecialchars($item['infoTitle']).'</a></p>';
                        
            if ($owner) {
                echo '<div class="mt-3">'; // Add margin top for button alignment
                echo '<button type="button" class="btn btn-sm" style="background-color: rgb(213, 198, 101); border-radius: 3px; width:50px" name="deletebtn"><a style="color: white; text-decoration: none;" href="capnhatthongtin.php?id='.$item['id'].'">Sửa</a></button>
                        <button type="button" class="btn btn-sm ml-2" style="color: white; background-color: rgb(36, 36, 153); border-radius: 3px; width:50px" name="updatebtn" onclick="delete_thongtin(\'' . htmlspecialchars($item['id']) . '\')">Xóa</button>';
                echo '</div>'; // Close the div for button alignment
            }

            echo '</div>'; // Close the card-body div
            echo '</div>'; // Close the card div

          }
        }
      }
    
    ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
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
