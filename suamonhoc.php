<?php
require_once("entities/subject.class.php");
require_once('entities/account.php');

require_once('session.php');
if(isset($_SESSION['username'])){
$userName = user::get_teacherName($_SESSION['username']);
$owner = true;
} else {
$owner = false;
}
$id=$_GET['sid'];
$subject=Detail::get_Subject($id);
$name=$subject[0]['subjectName'];
$file=$subject[0]['subjectImage'];
$info=$subject[0]['subjectInfo'];
$hinh="<br> <br> <img src='".$file."'width='100'>";


if(isset($_POST['btnSubmit']))
{
    if ($_FILES['image']['name'] != '') 
    {
        $result=Detail::update_subject($id,$_POST['namesubject'],$_FILES['image'],$_POST['info']);
        $subject=Detail::get_Subject($id);
        $file=$subject[0]['subjectImage'];
        $hinh="<br> <br> <img src='". $file."'width='100'>";
    }
    else
    {
        $result=Detail::update_subjectname($id,$_POST['namesubject'],$_POST['info']);
        $hinh="<br> <br> <img src='".$file."'width='100'>";
    }
    if ($result == true)
    {
      // echo '<script>
      // document.addEventListener("DOMContentLoaded", function() {
      //     var notification = document.getElementById("notification");
      //     notification.style.display = "block";
      //     notification.className = "success";
      //     document.getElementById("notification-message").innerText = "Sửa thành công!";
      //     setTimeout(function() {
      //         notification.style.display = "none";
      //     }, 2000);
      // });
      // </script>';
      header("Location: Them_Xoa_SuaMonHoc.php");
    } else 
    {
      echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
          var notification = document.getElementById("notification");
          notification.style.display = "block";
          notification.className = "failure";
          document.getElementById("notification-message").innerText = "Không sửa được!";
          setTimeout(function() {
              notification.style.display = "none";
          }, 2000);
      });
      </script>';
    }
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

<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
   <style>
    .single{
        border: 1px solid  #eeeded;
        border-radius: 3px;
        background-color:  #eeeded;
        margin-bottom: 30px;
        justify-content:center ;
        color: black;
        height: 175px;
        text-align: center;
        font-size: 70px;
    }
    .single:hover{
        transform: scale(1.1) ;
        background-color: #908E8E;
        color:#eeeded;
    }
    .ct{
      margin-top: 30px;
    }
    .tt{
      text-align: center;
      margin-top: 43px;
    }
    #notification {
        justify-content: center;
        text-align: center;
        display: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
    }
    .success {
        background-color: green;
    }
    .failure {
        background-color: red;
    }
    .btn1{
            background-color: black; 
            color: white;
        }
        .btn1:hover{
            transform: scale(1.1) ;
            color: #eeeded;
            background-color: black;
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
    <div class="ct container">
      <div class="row ">
        <div class="col-xl-8 col-md-6 col-12">
          <div class="container ">
            <h2 class="text-center"  style="">Sửa Môn Học</h2>
            <form action="#" method="post" class="formSubject" enctype="multipart/form-data" style="height:450px" onsubmit="return validateForm2()">
              <div class="form-group">
                <label for="name">Tên môn học:</label>
                <input type="text" id="name" name="namesubject" class="form-control" value=" <?php echo $name ?> ">
                <small id="nameError" style="color: red; display: none;">Vui lòng nhập tên môn học</small>
              </div>
              <div class="form-group " >
                <label for="name">Thông tin môn học:</label>
                <textarea id="info" name="info" class="form-control"> <?php echo $info ?> </textarea>
                <small id="infoError" style="color: red; display: none;">Vui lòng nhập thông tin môn học</small>
              </div>
              <div class="form-group">
                <label for="image">Chọn ảnh môn học:</label>
                <input type="file" name="image" id="txt_image" accept=".PNG,.GIF,.JPG,.JPEG,.jpg,.png,.jpeg"   >	
                <?php
                    echo $hinh
                ?>
              </div>                         
              <div class="form-group1">
                <button type="submit" class="btn1 btn" name="btnSubmit">Xác nhận</button>
              </div>
            </form>
            <div id="notification" style="display: none;">
    <p id="notification-message"></p>
    </div>
          </div>
        </div>
        <div class="tt col-xl-4 col-md-6 col-12">
          <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="single">
          <a href="./Them_Xoa_SuaMonHoc.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-book"></i></div>
        <h6 style=" color: black;   text-transform: uppercase;">thông tin<span> Môn học</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="single" >
          <a href="./themthongtin.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-newspaper"></i></div>
        <h6 style="  color: black;  text-transform: uppercase;">thông tin<span> bài đăng</span></h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="single" >
            <a href="./themgiangvien.php" style=" text-decoration: none;
        color: black;">
                <div class="single-how-works-icon"><i class="fas fa-user"></i></div>
                <h6 style="  color: black;  text-transform: uppercase;">thông tin<span> cá nhân</span></h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
          <a href="./nghiencuu.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-microscope"></i></div>
        <h6 style=" color: black;   text-transform: uppercase;">thông tin<span> nghiên cứu</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>
          </div>
        

       
        </div>
      </div>
      
      </div>
  

  
      <?php require_once("footer.php") ?>
</body>
</html>
<script>
  function validateForm2() {
    var isValid = true;

    // Kiểm tra trường tên môn học
    var name = document.getElementById('name').value.trim();
    var nameError = document.getElementById('nameError');
    if (name === "") {
      nameError.style.display = 'inline';
      isValid = false;
    } else {
      nameError.style.display = 'none';
    }
    return isValid;
    var info = document.getElementById('info').value.trim();
    var infoError = document.getElementById('infoError');
    if (info === "") {
      infoError.style.display = 'inline';
      isValid = false;
    } else {
      infoError.style.display = 'none';
    }
    return isValid;
  }
  // Loại bỏ thông báo lỗi khi người dùng nhập dữ liệu vào các trường
  document.getElementById('name').addEventListener('input', function() {
    document.getElementById('nameError').style.display = 'none';

  });
  document.getElementById('info').addEventListener('input', function() {
    document.getElementById('infoError').style.display = 'none';
  });
</script> 