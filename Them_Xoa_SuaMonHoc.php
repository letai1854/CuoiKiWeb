<?php
require_once('entities/account.php');
require_once('entities/subject.class.php');
require_once('entities/thongtin.class.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(isset($_SESSION['username'])){
  $userName = user::get_teacherName($_SESSION['username']);
  $owner = true;
} else {
  $owner = false;
}


$list_subject = Detail::list_Subject();
$item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:3;
$current_page=!empty($_GET['page'])?$_GET['page']:1;
$offset=($current_page-1)*$item_per_page;


$checkTim=false;
$checkTim = isset($_GET['c']) ? base64_decode($_GET['c']) : false;
if(isset($_POST['btntimkiem'])){
    $checkTim=true;
    $key=$_POST['tim']; 
}


if(isset($_POST['btnSubmit'])){
    $subjectName=$_POST['name'];
      $txt_image=$_FILES['image'];
      $info=$_POST['info'];
    $newSubject=new Detail($subjectName,$txt_image,$info);
    $result=$newSubject->save();
    if (isset($result)) {
        if (!$result) {
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
        } else {
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
        }
    }
  }
  if(isset($_POST['Delete'])){
    $id=$_POST['Id'];
    $result = Detail::delete_Subject($id);
  }
if(isset($result)){
    $list_LimitSubject = Detail::showLimitSubject($item_per_page, $offset);
}
function showListSubjectDetail($list_LimitSubject){
    if(isset($list_LimitSubject))
    {
       if(is_array($list_LimitSubject))
       {
         foreach($list_LimitSubject as $item)
         {
            echo'<tr colspan="2"><td>'.htmlspecialchars($item['subjectName']).'</td>'.
            '<td> <img src="'.htmlspecialchars($item['subjectImage']).'" width="50px" height="50px" alt=""></td>'.'
            <td>
            <div class="AED">
                <div class="one">
                    <a href="themTaiLieu.php?sid='.$item['subjectCode'].'"><i class="fas fa-square-plus" style="color:blue; "></i></a>
                </div>
                <div class="two">
                    <a href="javascript:void(0);" ><i class="fad fa-trash" style="color:red; " onclick="delete_btn(\''.htmlspecialchars($item['subjectCode']).'\')"></i></a>
                </div>
                <div class="three">
                    <a href="suamonhoc.php?sid='.$item['subjectCode'].'" ><i class="fas fa-pen-to-square"style="color:green;"></i></a>
                </div>
            </div>
        </td> </tr>';

         }
        }
    }
    
}
?>
<script>
     function delete_btn(id) {
            if (confirm('Bạn có chắc muốn xóa môn học?')) {
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "");

                var idInput = document.createElement("input");
                idInput.setAttribute("type", "hidden");
                idInput.setAttribute("name", "Id");
                idInput.setAttribute("value", id);

                var deleteBtn = document.createElement("input");
                deleteBtn.setAttribute("type", "hidden");
                deleteBtn.setAttribute("name", "Delete");
                deleteBtn.setAttribute("value", "Delete");

                form.appendChild(idInput);
                form.appendChild(deleteBtn);

                document.body.appendChild(form);
                form.submit();
            }
        }
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThemSuaXoaMonHoc</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
</head>
<style>
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
    .AED{
        width: 30px;
        height: 30px;
        display: flex;
        font-size: 20px;
    }
    .one{
    }
    .AED .two{
        margin-left: 13px;
    }
    .AED .three{
        margin-left: 13px;
    }
    table  {
        justify-content: center;
        border: 1px solid;
        border-radius: 3px;
        
    }
    .single1 {
            display: flex;
            align-items: flex-end;
            background-color: red;
            font-size: 20px;
        }
        .page-item{
            border: 1px solid #eeeded;
            text-decoration: none;
            color: black;
            padding: 3px 9px;
            font-weight: bold;
            background-color: #eeeded;


        }
        .current-page{
            color:#fff;
            background-color: black;
            cursor: pointer;
        }
        .page-item:hover{
            background-color:#908E8E;
            border-radius: 1px solid #908E8E;
            color: #fff;
            text-decoration: none;
            transform: scale(1.1) ;
        }
        .btn1{
            background-color: black; 
        }
        .btn1:hover{
            transform: scale(1.1) ;
            color: #eeeded;
            background-color: black;
        }
        .tim{
            margin-bottom: 20px;
            width: 400px;
        }
        .them{
            margin-top: 12px;
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
   .three:hover{
        color: black;
        transform: scale(1.1);
    }
    .one:hover{
        color: black;
        transform: scale(1.1);
    }
    .two:hover{
        color: black;
        transform: scale(1.1);
    }
    .form-container {
    background-color: #eeeded;
    padding: 20px;
    border-radius: 5px;
}

.form-group textarea {
    height: 150px; /* Adjust height as needed */
    resize: none;
}

</style>
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
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single" >
            <a href="./themgiangvien.php" style=" text-decoration: none;
        color: black;">
                <div class="single-how-works-icon"><i class="fas fa-user"></i></div>
                <h6 style="    text-transform: uppercase;">thông tin<span> cá nhân</span></h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single" >
          <a href="./themthongtin.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-book"></i></div>
        <h6 style="    text-transform: uppercase;">thông tin<span> bài đăng</span></h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="./nghiencuu.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-microscope"></i></div>
        <h6 style="    text-transform: uppercase;">thông tin<span> nghiên cứu</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>

      </div>
</div>

<div class="container">
    <div class="row">
    <div class="col-lg-4 col-md-12 col-12 "style="margin-bottom:30px;">
    <div class="form-container them">
            <h2 class="text-center" style="">THÊM MÔN HỌC</h2>
            <form action="#" method="post" class="formSubject" enctype="multipart/form-data" style="height:500px" onsubmit="return validateForm2()">
              <div class="form-group" >
                <label for="name">Tên môn học:</label>
                <input type="text" id="name" name="name" class="form-control">
                <small id="nameError" style="color: red; display: none;">Vui lòng nhập tên môn học</small>
              </div>
              <div class="form-group " >
                <label for="name">Thông tin môn học:</label>
                <textarea id="info" name="info" class="form-control"></textarea>
                <small id="infoError" style="color: red; display: none;">Vui lòng nhập thông tin môn học</small>
              </div>
              <div class="form-group " style="margin-top:30px;margin-bottom:45px;">
                <label for="image">Chọn ảnh môn học:</label>
                <input type="file" name="image" id="txt_image" accept=".PNG,.GIF,.JPG,.JPEG,.jpg,.png,.jpeg"  >
                <div class="">
                <small id="imageError" style="color: red; display: none;">Vui lòng chọn ảnh môn học</small>
                </div>						
              </div>  
                                  
              <div class="form-group1 ">
                <button type="submit" class="btn1 btn btn-dark" name="btnSubmit">Xác nhận</button>
              </div>
            </form>
    </div>
    <div id="notification" style="display: none;">
    <p id="notification-message"></p>
    </div>
    </div>
    <div class="col-lg-8 col-md-12 col-12">
    <div class="">
    <div class="container-fluid tim">
    <form class="d-flex" action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
      <input class="form-control me-2" type="search" id="tim" name="tim" placeholder="Tìm kiếm" aria-label="Search">
      <button class="btn1 btn btn-dark" type="submit" name="btntimkiem"><i class="fas fa-magnifying-glass"></i></button>
    </form>
    <div id="error-message" style="color: red; display: none;">Yêu cầu nhập dữ liệu</div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Tên môn học</th>
                <th>Ảnh môn học</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody >
                <?php
                $totalSubject=1;
                $list_thongbao="";
                   
                   
                if(isset($_POST['btntimkiem'])){
                    $checkTim=true;
                    $key=$_POST['tim'];
                    if(!empty($key)){
                        $list_LimitSubject=Detail::showSearchSubject($key,$item_per_page,$offset);
                        $totalSubject=count(Detail::countSearchSubject($key));
                    }
                }
                if($checkTim==true)
                {
                    if($checkTim==true){
                        if(isset($_GET['key'])){
                            $key=base64_decode($_GET['key']);
                        }
                        if(isset($_POST['tim'])){
                            $key= $_POST['tim'];
                        }    
                    }
                $checkTim=true;
                
                if(!empty($key)){
                    $list_LimitSubject=Detail::showSearchSubject($key,$item_per_page,$offset);
                    $totalSubject=count(Detail::countSearchSubject($key));
                }  
                }
                else{
                    $checkTim=false;
                    $list_LimitSubject=Detail::showLimitSubject($item_per_page,$offset);
                    $totalSubject=count(Detail::list_Subject());
                }
                $totalPage=ceil($totalSubject/$item_per_page);
                showListSubjectDetail($list_LimitSubject);
                ?>
        </tbody>
    </table>
    <div class="">
    <?php
        if($current_page>3){
            $firs_page=1;
    ?>
        <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$firs_page?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>">First</a>
            <?php }?>
            
        <?php
        for($num=1;$num<=$totalPage;$num++){?>
            <?php if($num!=$current_page){ ?>
                <?php if ($num>$current_page-3 &&$num<$current_page+3){?>
                    <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$num?> <?php ?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>"><?=$num?></a>
        <?php }?>
        <?php }else{ ?></else>
            <strong  class="current-page page-item"><?=$num?></strong>
            <?php }?>
        <?php } 
          if($current_page<$totalPage-3){
              $end_page=$totalPage;
          ?>
          <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$end_page?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>">Last</a>
    <?php }?>
    </div>
    </div>
    </div>
    </div>
</div>


<?php require_once("footer.php") ?> 

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const inputField = document.getElementById('tim');
    const errorMessage = document.getElementById('error-message');

    // Kiểm tra dữ liệu nhập vào khi người dùng nhập liệu
    inputField.addEventListener('input', function() {
      if (inputField.value.trim() !== '') {
        errorMessage.style.display = 'none';
      }
    });
  });

  function validateForm() {
    const inputField = document.getElementById('tim');
    const errorMessage = document.getElementById('error-message');

    if (inputField.value.trim() === '') {
      errorMessage.style.display = 'block';
      return false; // Ngăn không cho biểu mẫu được gửi
    }

    errorMessage.style.display = 'none';
    return true; // Cho phép gửi biểu mẫu nếu có dữ liệu
  }
</script>
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

    // Kiểm tra trường chọn ảnh
    var image = document.getElementById('txt_image').value.trim();
    var imageError = document.getElementById('imageError');
    if (image === "") {
      imageError.style.display = 'inline';
      isValid = false;
    } else {
      imageError.style.display = 'none';
    }
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

  document.getElementById('txt_image').addEventListener('input', function() {
    document.getElementById('imageError').style.display = 'none';
  });
  document.getElementById('info').addEventListener('input', function() {
    document.getElementById('infoError').style.display = 'none';
  });
</script>
</body>
</html>