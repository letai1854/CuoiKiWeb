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
if(isset($_POST['btnAccept']))
{
  $name=$_POST['name'];
  $type=$_POST['type'];
  $file=$_FILES['editor'];
  $video=$_POST['video'];
  $id=$_GET['sid'];
  // $check=false;
  if($video!="" && $type=="other"){
    $result=Detail::saveVideo($id,$name,$video,$type);
    // $check=true;
  }
  if($_FILES['editor']['name'] != '' &&$type!="other") 
  {
    $result=Detail::saveTaiLieu($id,$name,$file,$type);
    // $check=true;

  }
  // if(!$check){
  //   echo '<script>alert("Hãy chọn đúng dữ liệu!")</script>';
  // }
  if(isset($result))
  {
		if(!$result)
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
		else
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
		}
	}
}
$id=$_GET['sid'];
$subject=Detail::get_Subject($id);
$name1=$subject[0]['subjectName'];
$subjectDetail=Detail::list_SubjectDtail($id);

$type = isset($_GET['type']) ? base64_decode($_GET['type']) : '';
$checkTim=false;
if($type==''){
  $type='theory';
}
// session_start();

if (isset($_SESSION['documentType'])) {
if($_SESSION['i']==1){
  $type=$_SESSION['documentType'];
  $_SESSION['i']=2;
}
}
session_write_close();

if(isset($_POST['loai'])){
  $type=$_POST['Type'];
  session_start();
  $_SESSION['documentType']=$type;
  $_SESSION['i']=1;
  session_write_close();
  $checkTim=false;
}
if(!isset($_POST['loai'])){
  $checkTim = isset($_GET['c']) ? base64_decode($_GET['c']) : false;
}
$item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:2;
$current_page=!empty($_GET['page'])?$_GET['page']:1;
$offset=($current_page-1)*$item_per_page;
$checkSearch=false;
if(isset($_POST['btntimkiem'])){
  $checkTim=true;
  $key=$_POST['tim'];
  $type = $_POST['type'];
}
if(isset($_POST['Delete'])){
  $i=$_POST['Id'];
  $type=$_POST['type'];
  $result = Detail::delete_SubjectDetaile($i);
}
function checkType(){
  $type = isset($_GET['type']) ? base64_decode($_GET['type']) : '';
  if($type==''){
    $type='theory';
  }
  return $type;
}
function showListSubjectDetail($subjectDetail,$type){

                if(isset($subjectDetail))
                {
                   if(is_array($subjectDetail))
                   {
                     foreach($subjectDetail as $item)
                     {
                        echo'<tr colspan="2"><td>'.htmlspecialchars($item['subjectTitle']).'</td>'.
                        '<td> <p>'.htmlspecialchars($item['file']).'</p></td>'.'
                        <td>
                        <div class="AED">
                            <div class="two">
                            <a href="javascript:void(0);" onclick="delete_btn(\'' . htmlspecialchars($item['id']) . '\', \'' . htmlspecialchars($item['subjectType']) . '\')">
                            <i class="fad fa-trash" style="color:red;"></i>
                        </a>
                            </div>
                            <div class="three">
                                <a href="suaTaiLieu.php?sid='.$item['id'].'&type='.base64_encode($item['subjectType']).'&id='.htmlspecialchars($item['subjectCode']).'" ><i class="fas fa-pen-to-square"style="color:green;"></i></a>
                            </div>
                        </div>
                    </td> </tr>';
                      // }
                     }
                    }
                }
}
?>
<script>
     function getOption(type) {
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "");

                var idInput = document.createElement("input");
                idInput.setAttribute("type", "hidden");
                idInput.setAttribute("name", "Type");
                idInput.setAttribute("value", type);

                var Btn = document.createElement("input");
                Btn.setAttribute("type", "hidden");
                Btn.setAttribute("name", "loai");
                Btn.setAttribute("value", "loai");

                form.appendChild(idInput);
                form.appendChild(Btn);

                document.body.appendChild(form);
                form.submit();
            }
</script>
<script>
     function delete_btn(id,type) {
            if (confirm('Bạn có chắc muốn xóa tài liệu?')) {
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "");

                var idInput = document.createElement("input");
                idInput.setAttribute("type", "hidden");
                idInput.setAttribute("name", "Id");
                idInput.setAttribute("value", id);

                var typeInput = document.createElement("input");
                typeInput.setAttribute("type", "hidden");
                typeInput.setAttribute("name", "type");
                typeInput.setAttribute("value", type);

                var deleteBtn = document.createElement("input");
                deleteBtn.setAttribute("type", "hidden");
                deleteBtn.setAttribute("name", "Delete");
                deleteBtn.setAttribute("value", "Delete");
                form.appendChild(idInput);
                form.appendChild(typeInput);
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
    <title>home</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
    <style>
      .single{
        border: 1px solid  #eeeded;
        border-radius: 3px;
        background-color:  #eeeded;
        margin-bottom: 30px;
        justify-content:center ;
        width: auto;
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
        }
        .btn1:hover{
            transform: scale(1.1) ;
            color: #eeeded;
            background-color: black;
        }
        .tim{
            margin-bottom: 20px;
            width: 700px;
            display: flex;
        }
        .them{
          margin-bottom: 15px;
        }
        .titlethem{
          margin-bottom: 18px;
        }
        .titleLoai{
          border: 1px solid #eeeded;
          text-align: center;
          padding: 2px 3px 3px 3px;
          font-weight: 600;
          background-color: #eeeded;
          color: black;
          display: flex;
          justify-content: center;
        }
        .container1 {
            display: flex;
            align-items: center;
        }
        .label1 {
            margin-right: 10px;
            font-weight: bold;
            width: 150px;
        }
        .danhmuc{
          width: 125px;
          border: 1px solid black;
          border-radius: 3px;
          padding: 5px 0px 4px 12px;
          margin-bottom: 10px;
          background-color: black;
          color: white;
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
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single" >
            <a href="./themgiangvien.php" style=" text-decoration: none;
        color: black;">
                <div class="single-how-works-icon"><i class="fas fa-user"></i></div>
                <h6 style=" color:black;   text-transform: uppercase;">thông tin <br>cá <br> nhân</h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single" >
          <a href="./themthongtin.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-newspaper"></i></div>
        <h6 style="  color:black;  text-transform: uppercase;">thông tin <br> bài <br> đăng</h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="./nghiencuu.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-microscope"></i></div>
        <h6 style="  color:black;  text-transform: uppercase;">thông tin nghiên <br> cứu</h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="./Them_Xoa_SuaMonHoc.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-book"></i></div>
        <h6 style="  color:black;  text-transform: uppercase;">thông tin môn <br>  học</h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>

      </div>
</div>
      <div class="titleSubject">
        <h1 class=" title"><?php echo $name1 ?></h1>
      </div>
      
      <div class="row  container">
        <div class="col-xl-4 col-md-6 col-12">
          <div class="container them">
            <div class="titlethem">
            <h2 class="text-center" style="">THÊM TÀI LIỆU</h2>
            </div>
            <!-- <form action="#" method="post" class="formSubject" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên tài liệu:</label>
            <input type="text" id="name" name="name" class="form-control">
            <small id="nameError" class="error" style="color:red">Vui lòng nhập tên tài liệu</small>
        </div>
        <div class="form-group">
            <label for="type">Loại:</label>
            <select id="type" name="type" class="form-control">
                <option value="theory">Lý thuyết</option>
                <option value="practice">Thực hành</option>
                <option value="other">Khác</option>
            </select>
        </div>
        <div class="form-group" id="file-group">
            <label for="document">Chọn file:</label>
            <input type="file" id="document" name="editor" accept=".pdf,.doc,.docx" class="form-control">
            <small id="documentError" class="error" style="color:red">Vui lòng chọn file tài liệu</small>
        </div>
        <div class="form-group" id="video-group" style="display: none;">
            <label for="video">Chọn video:</label>
            <input type="text" id="video" name="video" class="form-control">
            <small id="videoError" class="error" style="color:red">Vui lòng nhập đường dẫn video hợp lệ (https://...)</small>
        </div>
        <div class="form-group1">
            <input type="hidden" name="type" id="typeHiddenAccept">
            <button type="submit" class="btn1 btn btn-dark" name="btnAccept">Xác nhận</button>
        </div>
    </form> -->
    <form action="#" method="post" class="formSubject" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên tài liệu:</label>
            <input type="text" id="name" name="name" class="form-control">
            <small id="nameError" class="error" style="color:red">Vui lòng nhập tên tài liệu</small>
        </div>
        <div class="form-group">
            <label for="type">Loại:</label>
            <select id="type" name="type" class="form-control">
                <option value="theory">Lý thuyết</option>
                <option value="practice">Thực hành</option>
                <option value="other">Khác</option>
            </select>
        </div>
        <div class="form-group" id="file-group">
            <label for="document">Chọn file:</label>
            <input type="file" id="document" name="editor" accept=".pdf,.doc,.docx" class="form-control">
            <small id="documentError" class="error" style="color:red">Vui lòng chọn file tài liệu</small>
        </div>
        <div class="form-group" id="video-group" style="display: none;">
            <label for="video">Chọn video:</label>
            <input type="text" id="video" name="video" class="form-control">
            <small id="videoError" class="error" style="color:red">Vui lòng nhập đường dẫn video hợp lệ (https://...)</small>
        </div>
        <div class="form-group1">
            <input type="hidden" name="type" id="typeHiddenAccept">
            <button type="submit" class="btn1 btn btn-dark" name="btnAccept">Xác nhận</button>
        </div>
    </form>

          </div>
          <div id="notification" style="display: none;">
              <p id="notification-message"></p>
          </div>
        </div>
    <div class="col-lg-8 col-md-12 col-12">
      <div class="">
        <div class="row">
      <div class="col-lg-7 col-md-6 col-12">
          <div class="container-fluid tim">
              <div class="timkiem">
                  <form class="d-flex" action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm1()">
                  <input class="form-control me-2" type="search" id="tim" name="tim" placeholder="Tìm kiếm" aria-label="Search">
                  <input type="hidden" name="type" id="typeHidden">
                  <button class="btn1 btn btn-dark" type="submit" name="btntimkiem"><i class="fas fa-magnifying-glass"></i></button>
                  </form>
                  <div id="error-message" style="color: red; display: none;">Yêu cầu nhập dữ liệu</div>
              </div>
          </div>
      </div>
        <div class="col-lg-5 col-md-6 col-12">
          <div class="danhmuc container">
          <div class="">
            <div class="label1">LOẠI TÀI LIỆU</div>
            <div class="">
              <select id="documentType" onchange="getOption(this.value)" onchange="updateTypeValue(this.value)">
                      <option value="theory" <?php if(trim($type) == 'theory' ) echo 'selected'; ?>>Lý thuyết</option>
                      <option value="practice" <?php if(trim($type) == 'practice' ) echo 'selected'; ?>>Thực hành</option>
                      <option value="other" <?php if(trim($type) == 'other') echo 'selected'; ?>>Khác</option>
              </select>
            </div>
          </div>
          </div>

        </div>
    </div>
      </div>

    <table class="container table table-hover">
        <thead>
            <tr>
                <th>Tên tài liệu</th>
                <th>File</th>
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
        $type = $_POST['type'];
        if(!empty($key)){
            $list_LimitSubject=Detail::showSearchSubjectDetail($key,$id,$type,$item_per_page,$offset);
            $totalSubject=count(Detail::countSearchSubjectDetail($key,$id,$type));
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
                    if(isset($_GET['type'])){
                        $type=base64_decode($_GET['type']);
                    }
                    if(isset($_POST['type'])){
                        $type = $_POST['type']; 
                    }

                }
            $checkTim=base64_encode(true);
            
            if(!empty($key)){
              $list_LimitSubject=Detail::showSearchSubjectDetail($key,$id,$type,$item_per_page,$offset);
              $totalSubject=count(Detail::countSearchSubjectDetail($key,$id,$type));
            }  
        }
      else{
        $checkTim=false;
        $list_LimitSubject=Detail::showLimitSubjectDetail($id,$type,$item_per_page,$offset);
        $totalSubject=count(Detail::showSubjectDetail($id,$type));
      }
        $totalPage=ceil($totalSubject/$item_per_page);
        showListSubjectDetail($list_LimitSubject,$type);
      ?>               
        </tbody>
    </table>
    <div class="">
    <?php
        if($current_page>3){
            $firs_page=1;
        ?>
        <a class="page-item" href="?sid=<?=$id ?>&type=<?= base64_encode($type) ?> &per_page=<?=$item_per_page?>&page=<?=$firs_page?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>">First</a>
            <?php }?>
            
        <?php
        for($num=1;$num<=$totalPage;$num++){?>
            <?php if($num!=$current_page){ ?>
                <?php if ($num>$current_page-3 &&$num<$current_page+3){?>
                    <a class="page-item" href="?sid=<?=$id ?>&type=<?= base64_encode($type) ?>&per_page=<?=$item_per_page?>&page=<?=$num?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>"><?=$num?></a>
        <?php }?>
        <?php }else{ ?></else>
            <strong  class="current-page page-item"><?=$num?></strong>
            <?php }?>
        <?php } 
          if($current_page<$totalPage-3){
              $end_page=$totalPage;
          ?>
          <a class="page-item" href="?sid=<?=$id ?>&type=<?= base64_encode($type) ?>per_page=<?=$item_per_page?>&page=<?=$end_page?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>">Last</a>
              <?php }?>
    </div>
    </div>
    </div>
  </div> 
</div>
<!-- <script>
  document.getElementById('type').addEventListener('change', function() {
    var type = this.value;
    var fileGroup = document.getElementById('file-group');
    var videoGroup = document.getElementById('video-group');   
    if (type === 'other') {
      fileGroup.style.display = 'none';
      videoGroup.style.display = 'block';
    } else {
      fileGroup.style.display = 'block';
      videoGroup.style.display = 'none';
    }
  });
</script> -->
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var fileGroup = document.getElementById('file-group');
            var videoGroup = document.getElementById('video-group');
            var nameField = document.getElementById('name');
            var documentField = document.getElementById('document');
            var videoField = document.getElementById('video');
            
            // Đảm bảo các thông báo lỗi ẩn khi tải trang
            document.getElementById('nameError').style.display = 'none';
            document.getElementById('documentError').style.display = 'none';
            document.getElementById('videoError').style.display = 'none';

            typeSelect.addEventListener('change', function() {
                var type = this.value;
                if (type === 'other') {
                    fileGroup.style.display = 'none';
                    videoGroup.style.display = 'block';
                } else {
                    fileGroup.style.display = 'block';
                    videoGroup.style.display = 'none';
                }
            });

            document.querySelector('form').addEventListener('submit', function(event) {
                var isValid = true;
                
                // Kiểm tra tên tài liệu
                var name = nameField.value.trim();
                if (name === "") {
                    document.getElementById('nameError').style.display = 'inline';
                    isValid = false;
                } else {
                    document.getElementById('nameError').style.display = 'none';
                }

                // Kiểm tra file tài liệu nếu type không phải là "Khác"
                if (typeSelect.value !== 'other') {
                    var documentFile = documentField.value.trim();
                    if (documentFile === "") {
                        document.getElementById('documentError').style.display = 'inline';
                        isValid = false;
                    } else {
                        document.getElementById('documentError').style.display = 'none';
                    }
                }

                // Kiểm tra đường dẫn video nếu type là "Khác"
                if (typeSelect.value === 'other') {
                    var videoUrl = videoField.value.trim();
                    var urlPattern = /^https:/i;
                    if (videoUrl === "" || !urlPattern.test(videoUrl)) {
                        document.getElementById('videoError').style.display = 'inline';
                        isValid = false;
                    } else {
                        document.getElementById('videoError').style.display = 'none';
                    }
                }

                if (!isValid) {
                    event.preventDefault(); // Ngăn form submit nếu có lỗi
                }
            });
        });
    </script>
<script>
  function updateTypeValue(value) {
    document.getElementById('typeHiddenAccept').value = value;
    document.getElementById('typeHidden').value = value;
    document.getElementById('hiddenDelete').value = value;
  }
  document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('documentType');
    updateTypeValue(selectElement.value);
  });
</script>
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

  function validateForm1() {
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
      <!-- <script src="ckeditor5-build-classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create(document.querySelector("#editor"),{
            ckfinder:{
                uploadUrl:'fileupload.php'
            }
        })
        .then(editor=>{
            console.log(editor);
        })

        .catch(error=>{
            console.error(error)
        });
    </script> --> 
    <?php require_once("footer.php") ?>
</body>
</html>