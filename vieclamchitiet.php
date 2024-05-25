<?php
require_once('entities/account.php');
require_once('entities/subject.class.php');
require_once('entities/thongtin.class.php');

$list_subject = Detail::list_Subject();
$item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:5;
$current_page=!empty($_GET['page'])?$_GET['page']:1;
$offset=($current_page-1)*$item_per_page;
$checkTim=false;
$checkTim = isset($_GET['c']) ? base64_decode($_GET['c']) : false;
if(isset($_POST['btntimkiem'])){
    $checkTim=true;
    $key=$_POST['tim']; 
}
function truncateText($text, $limit = 50) {
    // Remove HTML tags và loại bỏ các ký tự không gian HTML (&nbsp;)
    $text = str_replace('&nbsp;', ' ', strip_tags($text));
    // Split the text into words
    $words = preg_split('/\s+/', $text);
    // If there are more words than the limit, truncate the text
    if (count($words) > $limit) {
        $words = array_slice($words, 0, $limit);
        return implode(' ', $words) . '...';
    }
    return $text;
}


function showListSubjectDetail($list_subject) {
    if (isset($list_subject)) {
        if (is_array($list_subject)) {
            foreach ($list_subject as $item) {
                // Get truncated content without HTML tags
                $truncatedContent = truncateText($item['infoContents']);
                echo '<div class="news-item">
                        <div class="news-img">
                            <img src="'.htmlspecialchars($item['infoImage']).'" alt="News Image">
                        </div>
                        <div class="news-content">
                            <a class="thea" style="text-decoration: none; color: black;" href="./noidungvieclam.php?sid='.htmlspecialchars($item['id']).'">
                                <h5>'.htmlspecialchars($item['infoTitle']).'</h5>
                            </a>
                            <p>'.htmlspecialchars($truncatedContent).'</p>
                        </div>  
                      </div>
                      <hr>';
            }
        }
    }
}

              ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Liệu Thầy Dzoãn Xuân Thanh</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #0056b3;
        }
        .navbar-nav .nav-link {
            color: white;
            font-weight: bold;
        }
        .container {
            margin-top: 20px;
        }
        .news-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .news-img {
            /* margin-top: 5px; */
        }
        .news-content {
            margin-left: 10px;
        }
        .news-content h5{
            font-weight: bold;
        }
        .news-item p {
            font-size: 0.9em;
        }
        .sidebar h5 {
    font-size: 1.8rem;
    color: red;
    font-weight: bold;
    margin-bottom: 16px;
    margin-top: 3px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    background-color: #f1f1f1;
    margin-bottom: 3px;
    padding: 10px;
    border-radius: 5px;
}

.sidebar ul li a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    display: block;
    font-size: 0.8rem;
}

.sidebar ul li a .new {
    color: red;
    font-weight: bold;
    float: right;
}
        .news-item {
            display: flex;
        }
        /* .news-item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.01);
            transition: 0.5s ease;
        } */
        .title {
            display: flex;
            margin-bottom: 30px;
        }
        .subject {
            white-space: nowrap;
        }
        #tim {
            margin-right: 10px;
            margin-left: 60px;
        }
        .news-content {
            margin-left: 10px;
            max-width: calc(100% - 160px); /* Adjust the width according to the image width */
            word-wrap: break-word;
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
        .container1{
            margin-bottom: 50px;
        }
        .thea:hover{
            color: #908E8E;
        }
        .sidebar ul li a .new {
            border-radius: 50%;
            padding: 1px 4px ;
            background-color: red;
            color: white;
            float: right;
            animation: blink 1.2s infinite;
            font-size: 0.5rem;
        }
        @keyframes blink {
            50% {
                opacity: 0;
            }
        }
        .xemthem{
            font-weight: bold;
            display: flex;
            align-items: flex-end;
            justify-content: end;
        }
        .news-item p {
            font-size: 0.9em;
            font-weight: normal; 
        }
        .sidebar ul li a .date {
            font-weight: normal; /* Đảm bảo rằng ngày không bị in đậm */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/150x50" alt="HUTECH Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Đào tạo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">NCKH</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Giảng viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sinh viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Doanh nghiệp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                </ul>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container container1">
        <div class="row ">
            <!-- Left Column -->
            <div class="col-lg-8 col-md-12 col-12">
                <div class="title">
                    <div class="subject">
                        <h2 style="color:red;font-weight: bold;"><i class="fas fa-newspaper"></i>  Việc làm</h2>
                    </div>
                    <div class="container-fluid tim">
                        <form class="d-flex" action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <input class="form-control me-2" type="search" id="tim" name="tim" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn1 btn btn-dark" type="submit" name="btntimkiem"><i class="fas fa-magnifying-glass"></i></button>
                        </form>
                        <div id="error-message" style="color: red; display: none;">Yêu cầu nhập dữ liệu</div>
                        </div>
                </div>
                <?php
                $totalSubject=1;
                $list_thongbao="";
                   
                   
                if(isset($_POST['btntimkiem'])){
                    $checkTim=true;
                    $key=$_POST['tim'];
                    if(!empty($key)){
                        $list_LimitSubject=thongTin::getSearchNewstDetail($key,'vieclam',$item_per_page,$offset);
                        $totalSubject=count(thongTin::countSearchNewstDetail($key,'vieclam'));
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
                    $list_LimitSubject=thongTin::getSearchNewstDetail($key,'vieclam',$item_per_page,$offset);
                    $totalSubject=count(thongTin::countSearchNewstDetail($key,'vieclam'));
                }  
                }
                else{
                    $checkTim=false;
                    $list_LimitSubject=thongTin::getListThongTinByTypeLimit('vieclam',$item_per_page,$offset);
                    $totalSubject=count(thongTin::getListThongTinByType('vieclam'));
                }
                $totalPage=ceil($totalSubject/$item_per_page);
                showListSubjectDetail($list_LimitSubject);
                ?>
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

            <!-- Right Column -->
            <div class="col-lg-4 col-md-12 col-12 sidebar">
                <h5><i class="fas fa-newspaper"></i> Việc làm mới</h5>
                <br>
                <ul>
                    <?php
                    $list_thongbao = ThongTin::getListThongTinByTypeLimit8("vieclam");
                    if(isset($list_thongbao))
                    {
                        if(is_array($list_thongbao))
                        {
                            foreach($list_thongbao as $item)
                            {
                                echo '<li><a href="./noidungvieclam.php?sid='.htmlspecialchars($item['id']).'">'.htmlspecialchars($item['infoTitle']).'<br><span class="date">'.htmlspecialchars($item['day']).'</span> <span class="new">mới</span></a></li>';
                            }
                        }
                    }
                    ?>
                </ul>
                <div class="xemthem"><a style="text-decoration: none;
                      color: red;" href="./vieclamchitiet.php"><i class="fas fa-square-plus"></i> Xem thêm</a></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfR+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJTY3V6j2VJEiik27V8a2nTGoEB1N3EmxpCIrJRp0Kg5TB7D" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfR+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
</body>
</html>
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