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
$idUndo=$_GET['id'];
$checkType = isset($_GET['type']) ? base64_decode($_GET['type']) : '';
$checkTypeNotCode = isset($_GET['type'])?$_GET['type']:'';
$checkPer = isset($_GET['per_page']) ? $_GET['per_page'] : '';
$checkpage = isset($_GET['page']) ? $_GET['page'] : '';
$subject=Detail::list_SubjectDetailId($id);
$name=$subject[0]['subjectTitle'];
$file=$subject[0]['file'];
$type=$subject[0]['subjectType'];
if(isset($_POST['btnAccept']))
{
  $ten=$_POST['name'];
  $loai=$_POST['type1'];
  $f=$_FILES['editor'];
  $video=$_POST['video'];
  $check=false;
  if($loai=="other"){
    $result=Detail::suaVideo($id,$ten,$video);
    $check=true;
  }
  if($loai!="other") 
  {
    if($_FILES['editor']['name'] != ''){
      $result=Detail::suaTaiLieu($id,$ten,$f);
      $subject=Detail::list_SubjectDetailId($id);
      $file=$subject[0]['file'];
      $check=true;
    }
    else{
      $result=Detail::suaTenTaiLieu($id,$ten);
    }
  }
  if(!$check){
    echo '<script>alert("Hãy chọn đúng dữ liệu!")</script>';
  } 
  if(isset($result))
  {
		if(!$result)
    {
			echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var notification = document.getElementById("notification");
                notification.style.display = "block";
                notification.className = "failure";
                document.getElementById("notification-message").innerText = "Không Sửa được!";
                setTimeout(function() {
                    notification.style.display = "none";
                }, 2000);
            });
            </script>';
		}
		else
    {
			header("Location:themTaiLieu.php?sid=" . $idUndo);
      exit();
		}
	}
}
?>
<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
  var checkType = "<?php echo $checkType; ?>";
  if (checkType !== 'other') {
    document.getElementById('file').style.display = 'block';
    document.getElementById('video').style.display = 'none';
  } else {
    document.getElementById('file').style.display = 'none';
    document.getElementById('video').style.display = 'block';
  }
});
</script> -->


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
        width: auto;
        text-align: center;
        font-size: 90px;
        padding: 7px;
    }
    .single:hover{
        transform: scale(1.1) ;
        background-color: #908E8E;
        color:#eeeded;
    }
      .title{
        display: flex;
        justify-content: center;
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
      .info{
        margin-top: 42px;
      }
      .form-group1{
        display: flex;
        border-radius: 3px;

      }
      .undo{
        margin-left: 15px;
        text-decoration: none;
        color: white;
        border-radius: 3px;

      }
      .btn2{
            background-color: red; 
            color: white;
            border-radius: 5px;
        }
        .btn2:hover{
            transform: scale(1.1) ;
            color: #eeeded;
            background-color: red; 
        }
        .c1{
          margin-top: 20px;
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
      <!-- <div class="titleSubject">
        <h1 class=" " style="color: rgba(4, 17, 255, 0.966);"><?php echo $name ?></h1>
      </div> -->
      <div class="container c1">
        <div class="row   ">
          <div class="col-xl-8 col-md-6 col-12">
              <h2 class="text-center" >SỬA TÀI LIỆU</h2>



              <!-- <form action="#" method="post" class="formSubject"enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name">Tên tài liệu:</label>
                  <input type="text" id="name" name="name" class="form-control" value="<?php echo $name?>">
                </div>
             
                <div class="form-group">
                  <label for="type">Loại:</label>
                  <select id="type" name="type1" class="form-control" disabled>
                    <option value="theory" <?php if($type == 'theory' ||$type == ' theory') echo 'selected'; ?> >Lý thuyết</option>
                    <option value="practice" <?php if($type == 'practice'||$type == ' practice') echo 'selected'; ?>>Thực hành</option>
                    <option value="other" <?php if($type == 'other'||$type == ' other') echo 'selected'; ?>>Khác</option>
                    <input type="hidden" name="type1" value="<?php echo trim($type); ?>">
                  </select>
                </div>
                <div id="file" class="form-group" style="display:none;">
                  <label for="document">Chọn file:</label>
                  <input type="file" id="document" name="editor" accept=".pdf,.doc,.docx" class="form-control">
                  <div>
                    <p><?php echo ($type!='other') ? $file : ''; ?></p>
                  </div>
                </div>       
                <div id="video" class="form-group" style="display:none;">
                <label for="video">Chọn video:</label>
                <input type="text" id="video" name="video" class="form-control" value="<?php echo ($type=='other') ? $file : ''; ?>">
                </div>      
                <div class="form-group1">
                  <div class="">
                  <button type="submit" class="btn1 btn" name="btnAccept">Xác nhận</button>
                  </div>
                </div>
              </form> -->
             <form action="#" method="post" class="formSubject" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên tài liệu:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $name?>">
            <small id="nameError" class="error" style="color:red">Vui lòng nhập tên tài liệu</small>
        </div>
        <div class="form-group">
            <label for="type">Loại:</label>
            <select id="type" name="type1" class="form-control" disabled>
                <option value="theory" <?php if($type == 'theory' || $type == ' theory') echo 'selected'; ?>>Lý thuyết</option>
                <option value="practice" <?php if($type == 'practice' || $type == ' practice') echo 'selected'; ?>>Thực hành</option>
                <option value="other" <?php if($type == 'other' || $type == ' other') echo 'selected'; ?>>Khác</option>
                <input type="hidden" name="type1" value="<?php echo trim($type); ?>">
            </select>
        </div>
        <div id="file" class="form-group" style="display:none;">
            <label for="document">Chọn file:</label>
            <input type="file" id="document" name="editor" accept=".pdf,.doc,.docx" class="form-control">
            <div>
                <p><?php echo ($type != 'other') ? $file : ''; ?></p>
            </div>
        </div>       
        <div id="video" class="form-group" style="display:none;">
            <label for="video">Chọn video:</label>
            <input type="text" id="video" name="video" class="form-control" value="<?php echo ($type == 'other') ? $file : ''; ?>">
            <small id="videoError" class="error" style="color:red">Vui lòng nhập đường dẫn video hợp lệ (https:\\...)</small>
        </div>      
        <div class="form-group1">
            <div class="">
                <button type="submit" class="btn1 btn" name="btnAccept">Xác nhận</button>
            </div>
        </div>
    </form> 





              <div id="notification" style="display: none;">
              <p id="notification-message"></p>
          </div>
          </div>
          <div class="info col-xl-4 col-md-6 col-12">
          <div class="row">
        <div class="col-lg-6 col-md-6  col-12">
            <div class="single" >
              <a href="./themgiangvien.php" style=" text-decoration: none;
          color: black;">
                  <div class="single-how-works-icon"><i class="fas fa-user"></i></div>
                  <h6 style=" color:black;   text-transform: uppercase;">thông tin <br>cá nhân</h6>
              </a>
              <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
            </div>
          </div>
          <div class="col-lg-6 col-md-6  col-12">
            <div class="single" >
            <a href="./themthongtin.php" style=" text-decoration: none;
          color: black;">
          <div class="single-how-works-icon"><i class="fas fa-newspaper"></i></div>
          <h6 style="  color:black;  text-transform: uppercase;">thông tin <br>bài đăng</h6>
            </a>
              <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
            </div>
          </div>
          <div class="col-lg-6 col-md-6  col-12">
            <div class="single">
            <a href="./nghiencuu.php" style=" text-decoration: none;
          color: black;">
          <div class="single-how-works-icon" ><i class="fas fa-microscope"></i></div>
          <h6 style="  color:black;  text-transform: uppercase;">thông tin <br>nghiên cứu</h6>
            </a>
              <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <div class="single">
            <a href="./Them_Xoa_SuaMonHoc.php" style=" text-decoration: none;
          color: black;">
          <div class="single-how-works-icon" ><i class="fas fa-book"></i></div>
          <h6 style="  color:black;  text-transform: uppercase;">thông tin <br>môn học</h6>
            </a>
              <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
            </div>
          </div>
  
        </div>
          </div>
        </div>    
      </div>
      <?php require_once("footer.php") ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkType = "<?php echo $checkType; ?>";
            var fileGroup = document.getElementById('file');
            var videoGroup = document.getElementById('video');
            document.getElementById('nameError').style.display = 'none';
            document.getElementById('videoError').style.display = 'none';
            if (checkType !== 'other') {
                fileGroup.style.display = 'block';
                videoGroup.style.display = 'none';
            } else {
                fileGroup.style.display = 'none';
                videoGroup.style.display = 'block';
            }
            document.querySelector('form').addEventListener('submit', function(event) {
                var isValid = true;
                
                // Kiểm tra tên tài liệu
                var name = document.getElementById('name').value.trim();
                if (name === "") {
                    document.getElementById('nameError').style.display = 'inline';
                    isValid = false;
                } else {
                    document.getElementById('nameError').style.display = 'none';
                }

                // Kiểm tra file tài liệu nếu type không phải là "Khác"

                // Kiểm tra đường dẫn video nếu type là "Khác"
        //         if (checkType === 'other') {
        //     var videoUrl = videoGroup.value.trim();
        //     var urlPattern = /^https:/i;
        //     if (videoUrl === "" || !urlPattern.test(videoUrl) ||videoUrl==null) {
        //         document.getElementById('videoError').style.display = 'inline';
        //         isValid = false;
        //     } else {
        //         document.getElementById('videoError').style.display = 'none';
        //     }        // }

                if (!isValid) {
                    event.preventDefault(); // Ngăn form submit nếu có lỗi
                }
            });

            // Ẩn thông báo lỗi khi người dùng nhập dữ liệu vào các trường
            document.getElementById('name').addEventListener('input', function() {
                document.getElementById('nameError').style.display = 'none';
            });
            document.getElementById('video').addEventListener('input', function() {
                document.getElementById('videoError').style.display = 'none';
            });
        });
    </script>
</body>
</html>