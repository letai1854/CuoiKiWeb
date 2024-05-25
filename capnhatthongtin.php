<?php
    require_once("entities/thongtin.class.php");
    require_once('entities/account.php');

    require_once('session.php');
if(isset($_SESSION['username'])){
    $userName = user::get_teacherName($_SESSION['username']);
    $owner = true;
} else {
    $owner = false;
}
    $id = $_GET['sid'];
    $thongTin = ThongTin::getThongTinById($id);

    $infoTitle = $thongTin[0]['infoTitle'];
    $infoType = $thongTin[0]['infoType'];
    $infoContents = $thongTin[0]['infoContents'];
    $infoImage=$thongTin[0]['infoImage'];


    if (isset($_POST['btnSubmit'])) { 
        $infoTitle = $_POST['title'];
        $date = date('Y-m-d H:i:s');
        $infoImage = $_FILES['image'];
        $infoType = $_POST['infotype'];
        $infoContent = $_POST['content'];

        if ($_FILES['image']['name'] != '') 
        {
            $result = ThongTin::updateThongTin($id, $infoTitle, $date, $infoImage, $infoType, $infoContent);
        }
        else
        {
            $result = ThongTin::updateThongTinKhongImage($id, $infoTitle, $date,$infoType, $infoContent);
        }
        if ($result == true)
        {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var notification = document.getElementById("notification");
                notification.style.display = "block";
                notification.className = "success";
                document.getElementById("notification-message").innerText = "Thêm thành công!";
                setTimeout(function() {
                    notification.style.display = "none";
                }, 2000);
            });
            </script>';
            header("Location: themthongtin.php");
        } 
        else 
        {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var notification = document.getElementById("notification");
                notification.style.display = "block";
                notification.className = "failure";
                document.getElementById("notification-message").innerText = "Không thêm được!";
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
    <title>Editor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS cho phần message */
        #message {
            margin-top: 20px;
        }
        #text-area {
            width: 100%;
            height: 150px;
            margin-top: 10px;
        }
        .ck-editor__editable[role="textbox"] {
                /* Editing area */
                min-height: 300px;
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
        .tt{
      text-align: center;
      margin-top: 43px;
    }
    .single{
        border: 1px solid  #eeeded;
        border-radius: 3px;
        background-color:  #eeeded;
        margin-bottom: 30px;
        justify-content:center ;
        color: black;
        text-align: center;
        font-size: 50px;
    }
    .single:hover{
        transform: scale(1.1) ;
        background-color: #908E8E;
        color:#eeeded;
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
    <div class="container tt">
          <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="single">
          <a href="./Them_Xoa_SuaMonHoc.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-book"></i></div>
        <h6 style=" color: black;   text-transform: uppercase;">thông tin<span> Môn học</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="single" >
          <a href="./themthongtin.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-newspaper"></i></div>
        <h6 style="  color: black;  text-transform: uppercase;">thông tin<span> bài đăng</span></h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="single" >
            <a href="./themgiangvien.php" style=" text-decoration: none;
        color: black;">
                <div class="single-how-works-icon"><i class="fas fa-user"></i></div>
                <h6 style="  color: black;  text-transform: uppercase;">thông tin<span> cá nhân</span></h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
      <div class="titleh1" style="text-align:center">
        <h1 class=" ">SỬA BÀI ĐĂNG</h1>
      </div>
      <!-- <hr style="color: red; border-top: 2px solid red; font-weight: bold;"> </p></div> -->
   <div class="container ct">
    <div class="row container">
        <div class="col-xl-12 col-md-6 col-12">
          <div class="container ">
            <form action="#" method="post" class="formSubject" enctype="multipart/form-data" onsubmit="return validateForm()">
              <div class="form-group">
                    <label for="heading" >Tiêu đề:</label>
                    <input type="text" id="title" name = "title" value="<?php
                        echo $infoTitle;
                    ?>"><br>
                        <small id="nameError" class="error" style="color:red; display: none;">Vui lòng nhập tiêu đề</small>
              </div>
              <div class="form-group">
                <label for="job-type" style="margin-right: 26px;" >Loại:</label>
                <select id="job-type" name="infotype">
                <option value="vieclam" <?php echo ($infoType == 'vieclam') ? 'selected' : ''; ?>>Việc làm</option>
                <option value="thongbao" <?php echo ($infoType == 'thongbao') ? 'selected' : ''; ?>>Thông báo</option>
                <option value="tintuc" <?php echo ($infoType == 'tintuc') ? 'selected' : ''; ?>>Tin tức</option>
                </select>
              </div>
              <div class="form-group">
                    <label for="txt_image" >Hình đại diện:</label>
                    <input type="file" name="image" id="txt_image" accept=".PNG,.GIF,.JPG,.JPEG,.jpg,.png,.jpeg">	
                    <div class="">
                        <p><?php echo $infoImage ?></p>
                    </div>
              </div>
              <div class="form-group">
                    <textarea id="content" name="content" placeholder="Nhập nội dung thông tin" style="width:700px"><?php echo $infoContents; ?></textarea>
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
      </div>
   </div>
   <?php require_once("footer.php") ?>
</body>
</html>

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    function validateForm() {
        var isValid = true;

// Kiểm tra trường tên môn học
var name = document.getElementById('title').value.trim();
var nameError = document.getElementById('nameError');
if (name === "") {
  nameError.style.display = 'inline';
  isValid = false;
} else {
  nameError.style.display = 'none';
}
return isValid;
}
// Loại bỏ thông báo lỗi khi người dùng nhập dữ liệu vào các trường
document.getElementById('title').addEventListener('input', function() {
document.getElementById('nameError').style.display = 'none';
});
    ClassicEditor
        .create( document.querySelector( '#content' ), {
            ckfinder:
            {
                uploadUrl: 'fileupload.php'
            }
        } )
        .then (editor => {
            consol.log(editor);
        })
        .catch( error => {
            console.error( error );
        } );
</script>