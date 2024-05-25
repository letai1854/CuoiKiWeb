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
        session_write_close();

    if (isset($_POST['btnSubmit'])) {
        $infoTitle = $_POST['title'];
        $date = date('Y-m-d H:i:s');
        $infoImage = $_FILES['image'];
        $infoType = $_POST['infotype'];
        $infoContent = $_POST['content'];

        $result = ThongTin::saveThongTin($infoTitle, $date, $infoImage, $infoType, $infoContent);
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
    $item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:3;
    $current_page=!empty($_GET['page'])?$_GET['page']:1;
    $offset=($current_page-1)*$item_per_page;
    $type = isset($_GET['type']) ? base64_decode($_GET['type']) : '';
    $checkTim=false;
    if($type==''){
    $type='vieclam';
    }
session_start();
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
    if(isset($_POST['btntimkiem']))
    {
            $checkTim=true;
            $key=$_POST['tim'];
            $type = $_POST['type'];
    }
    if(isset($_POST['Delete'])){
        $i=$_POST['Id'];
        $type=$_POST['type'];
        $result = thongtin::deleteThongTin($i);
    }
    function showListSubjectDetail($info){

        if(isset($info))
        {
           if(is_array($info))
           {
             foreach($info as $item)
             {
                  echo'<tr colspan="2"><td>'.htmlspecialchars($item['infoTitle']).'</td>'.
                '<td> <img src="'.htmlspecialchars($item['infoImage']).'" width="50px" height="50px" alt=""></td>'.'
                <td>
                <div class="AED">
                    <div class="two">
                    <a href="javascript:void(0);" onclick="delete_btn(\'' . htmlspecialchars($item['id']) . '\', \'' . htmlspecialchars($item['infoType']) . '\')">
                    <i class="fad fa-trash" style="color:red;"></i>
                </a>
                    </div>
                    <div class="three">
                    <a href="capnhatthongtin.php?sid='.$item['id'].'&type='.base64_encode($item['infoType']).'" ><i class="fas fa-pen-to-square"style="color:green;"></i></a>
                    </div>
                </div>
            </td> </tr>';
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
            if (confirm('Bạn có chắc muốn xóa bài đăng?')) {
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
    <title>Editor</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
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
            color: white;
        }
        .btn1:hover{
            transform: scale(1.1) ;
            color: #eeeded;
            background-color: black;
        }
        .tim{
            margin-bottom: 20px;
            /* width: 400px; */
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
    .label1{
        /* display: flex; */
        text-align: center;
        background-color: black;
        color: #fff;
        border-top-left-radius: 5px; 
        border-top-right-radius: 5px; 
    }
    .container1{
        width: 100px;
        margin-bottom: 20px;
    }
    .title1{
        margin-top: 40px;
    }
    th{
        white-space: nowrap;
    }
    .container2{
        margin-bottom: 30px;
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
                <h6 style="color:black;    text-transform: uppercase;">thông tin<span> cá nhân</span></h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single" >
          <a href="./Them_Xoa_SuaMonHoc.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-book"></i></div>
        <h6 style="color:black;    text-transform: uppercase;">thông tin<span> môn học</span></h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="./nghiencuu.php" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-microscope"></i></div>
        <h6 style="color:black;    text-transform: uppercase;">thông tin<span> nghiên cứu</span></h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>

      </div>
</div>
<div class="container container2">
    <div class="row container">
        <div class="col-xl-7 col-md-6 col-12">
        <div class="titleh1" style="text-align:center">
        <h1 class=" " style="">THÊM BÀI ĐĂNG</h1>
      </div>
          <div class="container ">
          <form action="#" method="post" class="formSubject" enctype="multipart/form-data" onsubmit="return validateForm2()">
    <div class="form-group">
        <label for="heading">Tiêu đề:</label>
        <input type="text" id="title" name="title"><br>
        <small id="nameError" style="color: red; display: none;">Vui lòng nhập tiêu đề</small>
    </div>
    <div class="form-group">
        <label for="job-type" style="margin-right: 26px;">Loại:</label>
        <select id="job-type" name="infotype">
            <option value="vieclam">Việc làm</option>
            <option value="thongbao">Thông báo</option>
            <option value="tintuc">Tin tức</option>
        </select>
    </div>
    <div class="form-group">
        <label for="txt_image">Hình đại diện:</label>
        <input type="file" name="image" id="txt_image" accept=".PNG,.GIF,.JPG,.JPEG,.jpg,.png,.jpeg">
        <small id="imageError" style="color: red; display: none;">Vui lòng chọn ảnh</small>
    </div>
    <div class="form-group">
        <textarea id="content" name="content" placeholder="Nhập nội dung thông tin" style="width:700px"></textarea>
    </div>

    







    <div class="form-group1">
        <button type="submit" class="btn1 btn" name="btnSubmit">Xác nhận</button>
    </div>
</form>
            <div id="notification" style="display: none;">
              <p id="notification-message"></p>
          </div>
          </div>
        </div>
        <div class="title1 col-lg-5 col-md-6 col-12">
      <div class="">
        <div class="row">
      <div class="col-lg-7 col-md-6 col-12">
          <div class="container-fluid tim">
              <div class="timkiem">
                  <form class="d-flex" action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm1()">
                  <input class="form-control me-2" type="search" id="tim"  name="tim" placeholder="Tìm kiếm" aria-label="Search">
                  <input type="hidden" name="type" id="typeHidden">
                  <button class="btn1 btn btn-dark" type="submit" name="btntimkiem"><i class="fas fa-magnifying-glass"></i></button>
                  </form>
                  <div id="error-message" style="color: red; display: none;">Yêu cầu nhập dữ liệu</div>
              </div>
          </div>
      </div>
        <div class="col-lg-5 col-md-6 col-12">
          <div class="danhmuc container">
          <div class="container1">
            <div class="label1">BÀI ĐĂNG</div>
            <select id="documentType" onchange="getOption(this.value)" onchange="updateTypeValue(this.value)">
                    <option value="vieclam" <?php if(trim($type) == 'vieclam' ) echo 'selected'; ?>>Việc làm</option>
                    <option value="thongbao" <?php if(trim($type) == 'thongbao' ) echo 'selected'; ?>>Thông báo</option>
                    <option value="tintuc" <?php if(trim($type) == 'tintuc' ) echo 'selected'; ?>>Tin tức</option>
            </select>
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
    //   if(isset($_POST['btntimkiem'])){
    //     $key=$_POST['tim'];
    //     $type = $_POST['type'];
    //     if(!empty($key)){
    //         $list_LimitSubject=Detail::showSearchSubjectDetail($key,$id,$type,$item_per_page,$offset);
    //     }  
    //   }
    //   else{
        $totalSubject=1;
        $list_thongbao="";
        if(isset($_POST['btntimkiem']))
        {
                $key= $_POST['tim'];
                $type = $_POST['type'];
            $checkTim=true;
            
            if(!empty($key)){
                $list_thongbao=thongTin::getSearchNewstDetail($key,$type,$item_per_page,$offset);
                $totalSubject=count(thongTin::countSearchNewstDetail($key,$type));
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
                $list_thongbao=thongTin::getSearchNewstDetail($key,$type,$item_per_page,$offset);
                $totalSubject=count(thongTin::countSearchNewstDetail($key,$type));
            }  
        }
        else{
            $checkTim=false;
            $list_thongbao=thongTin::getListThongTinByTypeLimit($type,$item_per_page,$offset);
            $totalSubject=count(thongTin::getListThongTinByType($type));
        }
        $totalPage=ceil($totalSubject/$item_per_page);
    //   }
        showListSubjectDetail($list_thongbao);
      ?>               
        </tbody>
    </table>
    <div class="">
    <?php
        if($current_page>3){
            $firs_page=1;
        ?>
        <a class="page-item" href="?type=<?= base64_encode($type)?> &per_page=<?=$item_per_page?>&page=<?=$firs_page?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>">First</a>
            <?php }?>
            
        <?php
        for($num=1;$num<=$totalPage;$num++){?>
            <?php if($num!=$current_page){ ?>
                <?php if ($num>$current_page-3 &&$num<$current_page+3){?>
                    <a class="page-item" href="?type=<?= base64_encode($type) ?>&per_page=<?=$item_per_page?>&page=<?=$num?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>"><?=$num?></a>
        <?php }?>
        <?php }else{ ?></else>
            <strong  class="current-page page-item"><?=$num?></strong>
            <?php }?>
        <?php } 
          if($current_page<$totalPage-3){
              $end_page=$totalPage;
          ?>
          <a class="page-item" href="?type=<?= base64_encode($type) ?>&per_page=<?=$item_per_page?>&page=<?=$end_page?>&c=<?= base64_encode($checkTim) ?><?= $checkTim ? "&key=".base64_encode($key) : '' ?>">Last</a>
              <?php }?>
    </div>
    </div>


      </div>
</div>
   </div>

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








<?php require_once("footer.php") ?>
</body>
</html>
<script>
        function updateTypeValue(value)
    {
                // document.getElementById('typeHiddenAccept').value = value;
                document.getElementById('typeHidden').value = value;
                // document.getElementById('hiddenDelete').value = value;
    }
    document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('documentType');
    updateTypeValue(selectElement.value);
  });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    function validateForm() {
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
  function validateForm2() {
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

        // Kiểm tra trường chọn ảnh
        var image = document.getElementById('txt_image').value.trim();
        var imageError = document.getElementById('imageError');
        if (image === "") {
            imageError.style.display = 'inline';
            isValid = false;
        } else {
            imageError.style.display = 'none';
        }

        // Kiểm tra trường nội dung
        return isValid;
    }

    // Loại bỏ thông báo lỗi khi người dùng nhập dữ liệu vào các trường
    document.getElementById('title').addEventListener('input', function() {
        document.getElementById('nameError').style.display = 'none';
    });

    document.getElementById('txt_image').addEventListener('input', function() {
        document.getElementById('imageError').style.display = 'none';
    });

   
</script>