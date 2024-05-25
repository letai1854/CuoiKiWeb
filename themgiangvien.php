<?php 
require_once('entities/account.php');
require_once('entities/subject.class.php');
require_once('session.php');

if(isset($_SESSION['username'])){
  $userName = user::get_teacherName($_SESSION['username']);
  $owner = true;
} else {
  $owner = false;
}
if(isset($_SESSION['username']))
{
$user=$_SESSION['username'];
}
$user='hahehiho9999@gmail.com';
$account=User::getInforAccount($user);
$name=$account[0]['teacherName'];
$phone=$account[0]['phone'];
$email=$account[0]['email'];
$info=$account[0]['info'];
$image=$account[0]['image'];
$hinh="<br> <br> <img src='". $image."'width='100'>";
if(isset($_POST['btnxacnhan'])){
  $name=$_POST['name'];
  $sdt=$_POST['sdt'];
  $email=$_POST['email'];
  $image=$_FILES['image'];
  $content=$_POST['content'];
  if ($_FILES['image']['name'] != '') 
  {
    $result=User::update_User($user,$name,$content,$sdt,$email,$image);
    $account=User::getInforAccount($user);
    $image=$account[0]['image'];
    $name=$account[0]['teacherName'];
    $phone=$account[0]['phone'];
    $email=$account[0]['email'];
    $info=$account[0]['info'];
    $hinh="<br> <br> <img src='". $image."'width='100'>";
  }
  else
  {
    $result=User::update_UserKhongAnh($user,$name,$content,$sdt,$email);
    $account=User::getInforAccount($user);
    $image=$account[0]['image'];
    $name=$account[0]['teacherName'];
    $phone=$account[0]['phone'];
    $email=$account[0]['email'];
    $info=$account[0]['info'];
    $hinh="<br> <br> <img src='". $image."'width='100'>";
  }
  if(isset($result)){
		if(!$result){
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
		else{
      echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
          var notification = document.getElementById("notification");
          notification.style.display = "block";
          notification.className = "success";
          document.getElementById("notification-message").innerText = "Sửa thành công!";
          setTimeout(function() {
              notification.style.display = "none";
          }, 2000);
      });
      </script>';
		}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    .infor{
      margin-top: 20px;
    }
    .formSubject{
      margin-bottom: 30px;
      margin-top: 10px;
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
    .ck-editor__editable[role="textbox"] {
                /* Editing area */
                min-height: 300px;
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
        .single{
        border: 1px solid  #eeeded;
        border-radius: 3px;
        background-color:  #eeeded;
        margin-bottom: 30px;
        justify-content:center ;
    }
    .single:hover{
        transform: scale(1.1) ;
        background-color: #908E8E;
        color:#eeeded;
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
<div class="infor container text-center py-1 mt-10">
      <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single" >
            <a href="./themthongtin.php" style=" text-decoration: none;
        color: black;">
                <div class="single-how-works-icon"><i class="fas fa-newspaper"></i></div>
                <h6 style="color:black;    text-transform: uppercase;">thông tin <br> bài đăng</span></h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single" >
          <a href="./Them_Xoa_SuaMonHoc.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-book"></i></div>
        <h6 style="color:black;    text-transform: uppercase;">thông tin <br> môn học</span></h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="./nghiencuu.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-microscope"></i></div>
        <h6 style="color:black;    text-transform: uppercase;">thông tin  nghiên cứu</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>

      </div>
</div>
      <!-- <div class="titleSubject">
        <h1 class=" " style="color: rgba(4, 17, 255, 0.966);">THÊM THÔNG TIN GIẢNG VIÊN</h1>
        <hr style="color: red; border-top: 2px solid red; font-weight: bold;"> </p></div>
      </div> -->
      <div class="container">
      <div class="row  container infor">
        <div class="col-xl-9 col-md-6 col-12">
          <div class="text-center">
          <h2>THÔNG TIN GIẢNG VIÊN</h2>
            </div>
            <div id="notification" style="display: none;">
              <p id="notification-message"></p>
            </div>
          <div class="container ">
            <form action="#" method="post" class="formSubject" id="frm" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Tên giảng viên:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $name?>">
                <span id="name-error" class="error-message" style="display: none; color:red">Tên không được để trống</span>
              </div>
              <div class="form-group">
                <label for="name">Số điện thoại:</label>
                <input type="text" id="sdt" name="sdt" class="form-control" value="<?php echo $phone?>">
                <span id="sdt-error" class="error-message" style="display: none; color:red">Số điện thoại không hợp lệ</span>
              </div>
              <div class="form-group">
                <label for="name">Email:</label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $email?>">
                <span id="email-error" class="error-message" style="display: none; color:red">Email không hợp lệ</span>
              </div>
              <div class="form-group">
                    <label for="txt_image" >Hình đại diện:</label>
                    <input type="file" name="image" id="txt_image" accept=".PNG,.GIF,.JPG,.JPEG,.jpg,.png,.jpeg">
                    <?php echo $hinh; ?>
              </div>
              <div class="form-group">
                    <label for="txt_image" >Giới thiệu:</label>
                    <textarea id="content" name="content" placeholder="Nhập nội dung thông tin" style="width:700px" ><?php echo $info;?></textarea>
              </div>   
                            
              <div class="form-group1">
                <button type="submit" class="btn btn1" name="btnxacnhan" id="btnxacnhan">Xác nhận</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
      
      <?php require_once("footer.php") ?>

      <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
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
</body>
</html>
<script>
        document.getElementById('frm').addEventListener('submit', function(event) {
            let valid = true;

            const name = document.getElementById('name').value.trim();
            const sdt = document.getElementById('sdt').value.trim();
            const email = document.getElementById('email').value.trim();

            // Name validation
            if (name === '') {
                document.getElementById('name-error').style.display = 'inline';
                valid = false;
            } else {
                document.getElementById('name-error').style.display = 'none';
            }

            // Phone number validation
            const phonePattern = /^\d{10}$/;
            if (sdt === '' || !phonePattern.test(sdt)) {
                document.getElementById('sdt-error').style.display = 'inline';
                valid = false;
            } else {
                document.getElementById('sdt-error').style.display = 'none';
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailPattern.test(email)) {
                document.getElementById('email-error').style.display = 'inline';
                valid = false;
            } else {
                document.getElementById('email-error').style.display = 'none';
            }

            // If any validation fails, prevent the form submission
            if (!valid) {
                event.preventDefault();
            }
        });

        // Hide error messages when user starts typing
        document.getElementById('name').addEventListener('input', function() {
            document.getElementById('name-error').style.display = 'none';
        });

        document.getElementById('sdt').addEventListener('input', function() {
            document.getElementById('sdt-error').style.display = 'none';
        });

        document.getElementById('email').addEventListener('input', function() {
            document.getElementById('email-error').style.display = 'none';
        });
    </script>