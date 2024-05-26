

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <style>
      .infor .single {
        font-family: "Open Sans", sans-serif;
        color: #0c0c0c;
        background-color:#eeeded;
        padding: 30px;
        border-radius: 4px;
        width: 100%;
        height: 100%;
        transition: 0.3s ease;
      }
      
      .single {
        transition: transform 1s, background-color 1s;
      }

      .single:hover {
        /* transform: scale(1.2) ; */
        transform: scale(1.1) ;
        background-color: #908E8E;
        color:#eeeded;
      }

    .infor .single button{
      color: #1d1d1d;
      background: none;
      font-size: 14px;
      font-weight: 500;
      border-bottom: 1px solid black;
      text-transform: uppercase;
      display: inline-block;
      padding: 2.5px;
      transform: translateY(10px);
      transition:  0.3s ease;

    }
    .infor .single button:hover{
      color: brown;
      background-color: none;
      border-bottom: #fff;
    
    }
    .single-how-works-icon{
      font-size: 90px;
    }
    #se {
      margin-bottom: 100px;
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
  <section id="se">
  <div class="container text-center py-5 mt-5">
          <h3>Chỉnh sửa thông tin</h3>
          <p>Bạn có thể chỉnh sửa tất cả nội dung website trong bốn lựa chọn dưới đây</p>
          
</div>
<div class="infor container text-center py-1 mt-1">
      <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single">
            <div class="single-how-works-icon" style="font-size: 90px;"><i class="fas fa-user"></i></div>
            <h2 style="    text-transform: uppercase;">thông tin<span> cá nhân</span></h2>
            <!-- <p>Chỉnh sửa các thông tin cá nhân của giảng viên</p> -->
            <button class="welcome-hero-btn how-work-btn"><a href="./themgiangvien.php" style="text-decoration: none; color:black">Xem Thêm</a></button>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single" >
            <div class="single-how-works-icon" tyle="font-size: 90px;"><i class="fas fa-book"></i></div>
            <h2 style="    text-transform: uppercase;">thông tin<span> môn học</span></h2>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
            <button class="welcome-hero-btn how-work-btn"><a href="./Them_Xoa_SuaMonHoc.php" style="text-decoration: none; color:black">Xem Thêm</a></button>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single">
            <div class="single-how-works-icon" tyle="font-size: 90px;"><i class="fas fa-microscope"></i></div>
            <h2 style="    text-transform: uppercase;">thông tin<span> nghiên cứu</span></h2>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
            <button class="welcome-hero-btn how-work-btn"><a href="./nghiencuu.php" style="text-decoration: none; color:black">Xem Thêm</a></button>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single">
            <div class="single-how-works-icon" tyle="font-size: 90px;"><i class="fas fa-newspaper"></i></div>
            <h2 style="    text-transform: uppercase;">thông tin<span> bài đăng</span></h2>
            <!-- <p>Thêm và chỉnh sửa thông tin thông báo-tin tức-việc làm.</p> -->
            <button class="welcome-hero-btn how-work-btn"><a href="./themthongtin.php" style="text-decoration: none; color:black">Xem Thêm</a></button>
          </div>
        </div>
      </div>
</div>
  </section>

  <?php require_once("footer.php") ?>

    
</body>
</html>

