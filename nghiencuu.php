<?php
require_once('entities/account.php');
require_once('entities/subject.class.php');
require_once('entities/thongtin.class.php');
require_once('session.php');
if(isset($_SESSION['username'])){
    $userName = user::get_teacherName($_SESSION['username']);
    $owner = true;
} else {
    $owner = false;
}
session_write_close();
$list_subject = Detail::list_Subject();
$item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:10;
$current_page=!empty($_GET['page'])?$_GET['page']:1;
$offset=($current_page-1)*$item_per_page;


$checkTim=false;
$checkTim = isset($_GET['c']) ? base64_decode($_GET['c']) : false;
$type = isset($_GET['type']) ? base64_decode($_GET['type']) : '';
if($type==''){
$type=1;
}
$tieuDe = "THÊM BÀI NGHIÊN CỨU";
$anHinhDaiDien = false;
switch($type) {
    case '1':
        $tieuDe = "THÊM BÀI HỘI NGHỊ KHOA HỌC";
        break;
    case '2':
        $tieuDe = "THÊM BÀI CÔNG TRÌNH NCKH";
        $anHinhDaiDien = true;
        break;
    case '3':
        $tieuDe = "THÊM BÀI CÔNG BỐ KHOA HỌC";
        $anHinhDaiDien = true;
        break;
    default:
        $tieuDe = "THÊM BÀI NGHIÊN CỨU";
}
if(isset($_POST['btntimkiem'])){
    $checkTim=true;
    $key=$_POST['tim']; 
}


if(isset($_POST['btnSubmit'])){
    $title=$_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');
    switch($type) {
        case 1:
            $txt_image=$_FILES['image'];
            $newresearch=thongtin::addThongTinHoiNghi($title,$content,$date,$txt_image); 
            break;
        case 2: 
            $newresearch=thongtin::addThongTinCongTrinhCongBo($title,$content, $date,2);
            break;
        case 3:
            $newresearch=thongtin::addThongTinCongTrinhCongBo($title,$content, $date,3);
            break;
    }
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
    $result = thongtin::deleteThongTinNghienCuu($id);
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
            echo'<tr colspan="2"><td>'.htmlspecialchars($item['title']).'</td>'.'
            <td>
            <div class="AED">
                <div class="two">
                    <a href="javascript:void(0);" ><i class="fad fa-trash" style="color:red; " onclick="delete_btn(\''.htmlspecialchars($item['id']).'\')"></i></a>
                </div>
                <div class="three">
                    <a href="suathongtinnghiencuu.php?sid='.htmlspecialchars($item['id']).'&type='.base64_encode(htmlspecialchars($item['type'])).'" ><i class="fas fa-pen-to-square"style="color:green;"></i></a>
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
            if (confirm('Bạn có chắc muốn xóa thông tin nghiên cứu?')) {
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
    .ck-editor__editable[role="textbox"] {
                /* Editing area */
                min-height: 300px;
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
        border: 1px solid  #eeeded;
        border-radius: 6px;
        background-color:  #eeeded;
        margin-bottom: 30px;
        justify-content:center ;
        font-size: 10px;
        white-space: nowrap;
        padding: 8px;
        color: #fff;
        background-color: black;
    }
    .single1:hover{
        transform: scale(1.1) ;
        background-color: #202020;
        color:#eeeded;
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
    .title1{
        text-align: center;
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
    th{
        white-space: nowrap;
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
      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single" >
            <a href="./themgiangvien.php" style=" text-decoration: none;
        color: black;">
                <div class="single-how-works-icon"><i class="fas fa-user"></i></div>
                <h6 style="    text-transform: uppercase;">thông tin <br> cá nhân</span></h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single" >
          <a href="./themthongtin.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-newspaper"></i></div>
        <h6 style="    text-transform: uppercase;">thông tin <br> bài đăng</span></h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="./Them_Xoa_SuaMonHoc.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-book"></i></div>
        <h6 style="    text-transform: uppercase;">thông tin <br>    môn học</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>

      </div>
</div>
<div class="title1 container">
    <h2>NGHIÊN CỨU</h2>
</div>
<div class="infor container text-center py-1 mt-1">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single1" >
          <a href="?type=<?php echo base64_encode(1) ?>" style=" text-decoration: none;
        color: black;">
        <h6 style=" color: #fff;   text-transform: uppercase;">HỘI NGHỊ KHOA HỌC</span></h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single1" >
            <a href="?type=<?php echo base64_encode(2) ?>" style=" text-decoration: none;
        color: black;">
                <h6 style=" color: #fff;   text-transform: uppercase;">CÔNG TRÌNH  NCKH</span></h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="single1">
          <a href="?type=<?php echo base64_encode(3) ?>" style=" text-decoration: none;
        color: black;">
        <h6 style=" color: #fff;   text-transform: uppercase;">CÔNG BỐ KHOA HỌC</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>

      </div>
</div>
<div class="container">
    <div class="row">
    <div class="col-lg-7 col-md-12 col-12 "style="margin-bottom:30px;">
    <div class="container them">
            <h2 class="text-center" style=""><?php echo $tieuDe; ?></h2>
            <form action="#" method="post" class="formSubject" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="heading" >Tiêu đề:</label>
                    <input type="text" id="title" name = "title"><br>
                    <small id="nameError" class="error" style="color:red; display: none;">Vui lòng nhập tiêu đề</small>
              </div>
              <?php if (!$anHinhDaiDien): ?>
              <div class="form-group">
                    <label for="txt_image" >Hình đại diện:</label>
                    <input type="file" name="image" id="txt_image" accept=".PNG,.GIF,.JPG,.JPEG,.jpg,.png,.jpeg">	
                    <small id="imageError" class="error" style="color:red; display: none;">Vui lòng chọn ảnh đại diện</small>
              </div>
              <?php endif; ?>
              <div class="form-group">
                    <label for="txt_image" >Nội dung:</label>
                    <textarea id="content" name="content" placeholder="Nhập nội dung thông tin" style="width:700px"></textarea>
              </div>              
              <div class="form-group1">
                <button type="submit" class="btn1 btn" name="btnSubmit">Xác nhận</button>
              </div>
            </form>
    </div>
    <div id="notification" style="display: none;">
    <p id="notification-message"></p>
    </div>
    </div>
    <div class="col-lg-5 col-md-12 col-12">
    <div class="">
    <div class="container-fluid tim">
    <form class="d-flex" action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
      <input class="form-control me-2" type="search" id="tim" name="tim" placeholder="Tìm kiếm" aria-label="Search">
      <button class="btn1 btn btn-dark" type="submit" name="btntimkiem"><i class="fas fa-magnifying-glass"></i></button>
    </form>
    <div id="error-message" style="color: red; display: none;">Yêu cầu nhập dữ liệu</div>
    </div>
    <table class="container table table-hover">
        <thead>
            <tr>
                <th>Tiêu đề</th>
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
                        $list_LimitSubject=thongtin::getSearchThongTinNghienCuu($type,$key,$item_per_page,$offset);
                        $totalSubject=count(thongtin::countSearchThongTinNghienCuu($type,$key));
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
                    $list_LimitSubject=thongtin::getSearchThongTinNghienCuu($type,$key,$item_per_page,$offset);
                    $totalSubject=count(thongtin::countSearchThongTinNghienCuu($type,$key));
                }  
                }
                else{
                    $checkTim=false;
                    $list_LimitSubject=thongtin::getThongTinNghienCuu($type,$item_per_page,$offset);
                    $totalSubject=count(thongtin::countThongTinNghienCuu($type));
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
</body>
</html>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    function validateForm1() {
        var fileInput = document.getElementById('txt_image');
        if (fileInput.files.length === 0) {
            alert('Vui lòng upload ảnh đại diện cho thông tin.');
            return false;
        }
        return true;
    }   
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
<script>
document.querySelector('.formSubject').addEventListener('submit', function(event) {
    let isValid = true;

    // Kiểm tra tiêu đề
    const title = document.getElementById('title').value.trim();
    const nameError = document.getElementById('nameError');
    if (!title) {
        nameError.style.display = 'inline';
        isValid = false;
    } else {
        nameError.style.display = 'none';
    }

    // Kiểm tra hình đại diện nếu $anHinhDaiDien là false
    <?php if (!$anHinhDaiDien): ?>
    const image = document.getElementById('txt_image').files[0];
    const imageError = document.getElementById('imageError');
    if (!image) {
        imageError.style.display = 'inline';
        isValid = false;
    } else {
        imageError.style.display = 'none';
    }
    <?php endif; ?>

    // Kiểm tra nội dung

    // Ngăn gửi form nếu có lỗi
    if (!isValid) {
        event.preventDefault();
    }
});

// Ẩn lỗi khi người dùng bắt đầu nhập
document.getElementById('title').addEventListener('input', function() {
    document.getElementById('nameError').style.display = 'none';
});

<?php if (!$anHinhDaiDien): ?>
document.getElementById('txt_image').addEventListener('change', function() {
    document.getElementById('imageError').style.display = 'none';
});
<?php endif; ?>

</script>