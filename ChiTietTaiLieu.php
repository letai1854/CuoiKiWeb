<?php
require_once('entities/account.php');
require_once('entities/subject.class.php');
require_once('entities/thongtin.class.php');
require_once('entities/account.php');

require_once('session.php');
if(isset($_SESSION['username'])){
$userName = user::get_teacherName($_SESSION['username']);
$owner = true;
} else {
$owner = false;
}
$id=$_GET['sid'];
$list_subject = Detail::list_Subject();
$item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:5;
$current_page=!empty($_GET['page'])?$_GET['page']:1;
$offset=($current_page-1)*$item_per_page;
// $list_Practice=Detail::list_SubjectDetailByType($id,'practice');
$list_other=Detail::list_SubjectDetailByType($id,'other');
$sub=Detail::get_Subject($id);
$nameTitle=$sub[0]['subjectName'];
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đại Học Tôn Đức Thắng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        
        header {
            background-color: #f5f5f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
        }

        header img {
            width: 50px;
            height: auto;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            color: white;
        }

        /* nav ul li {
            padding: 10px 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        } */

        main {
            flex: 1;
            display: flex;
            position: relative;
        }

        .course-container {
            flex: 3;
            padding: 20px;
            /* margin-left: 20px;
            margin-right: 20px; */
        
        }

        .my-courses {
            background-color: #F8F8F8;
            padding: 20px;
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            width: 300px; /* Adjust the width as needed */
            transition: transform 0.3s ease;
            transform: translateX(100%);
            overflow-y: auto; /* Allows scrolling if content overflows */
        }

        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }

        .search-bar input {
            flex: 1;
            padding: 10px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px;
        }

        #toggle-courses {
            background-color: #0073e6;
            color: white;
            border: none;
            width: 25px;
            height: 45px;
            cursor: pointer;
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            z-index: 1000; /* Ensure the button stays on top */
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        #course-list {
            list-style-type: none;
            padding: 0;
            text-decoration: none;
        }

        #course-list li {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
            text-decoration: none;
        }
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
    color: white;
    font-weight: bold;
    float: right;
}
        .news-item {
            display: flex;
        }
        .title1{
            margin-bottom: 40px;
        }
        #course-list ul li {
            list-style-type: none; /* Remove bullets from both lists */
        }
        .icon-container {
            display: inline-block;
            background-color: #0073e6;
            padding: 5px;
            border-radius: 50%; /* Make it circular */
            color: white; /* Ensure the icon color is white */
        }
        .video-title{
            text-align: center;
            color: #0073e6;
        }
        .thea:hover{
            color: #908E8E;
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
    <!-- <header>
        <img src="logo.png" alt="TDT Logo">
        <h1> KHOA CÔNG NGHỆ THÔNG TIN</h1>
        <div class="user-info">
            <div class="notifications">
            </div>
        </div>
    </header> -->
    <main>
        <div class="course-container ">
            <div class="row">
                <div class="col-xl-8 col-md-6 col-sm-12 col-12">
                   <div class="title1">
                   <h3 style="color:red; font-weight: bold;">     <i class="fas fa-school"></i> <?php echo $nameTitle ?></h3>
                   </div>
            <div class="course-list">
                <h3 style="color:#1177d1;">Lý thuyết</h3>
                <ul>
                    <?php
                    $list_Theory=Detail::list_SubjectDetailByType($id,'theory');
                    if(isset($list_Theory))
                    {
                        if(is_array($list_Theory))
                        {
                            foreach($list_Theory as $item)
                            {
                                $url=htmlspecialchars($item['file']) ;
                                $file_name = basename($url); 
                    echo ' <p style="list-style-type: none; text-decoration:none"><i class="fas fa-file icon-container"></i>
                    <a style="text-decoration: none;" href="'.htmlspecialchars($item['file']).'">'.htmlspecialchars($item['subjectTitle']).'</a>
                    <a href="'.htmlspecialchars($item['file']).'" download="'.htmlspecialchars($file_name).'"><img src="./image/file.png" alt="" width="20" height="20"> </a></p>';
                                
                            }
                        }
                    } 
                    ?>

                    <!-- Add more course items as needed -->
                </ul>
            </div>
            <hr>
            <div class="course-list">
                <h3 style="color:#1177d1;">Thực hành</h3>
                <ul>
                <?php
                    $list_Theory=Detail::list_SubjectDetailByType($id,'practice');
                    if(isset($list_Theory))
                    {
                        if(is_array($list_Theory))
                        {
                            foreach($list_Theory as $item)
                            {
                                $url=htmlspecialchars($item['file']) ;
                                $file_name = basename($url); 
                    echo ' <p style="list-style-type: none; text-decoration:none"><i class="fas fa-file icon-container"></i>
                    <a style="text-decoration: none;" href="'.htmlspecialchars($item['file']).'">'.htmlspecialchars($item['subjectTitle']).'</a>
                    <a href="'.htmlspecialchars($item['file']).'" download="'.htmlspecialchars($file_name).'"><img src="./image/file.png" alt="" width="20" height="20"> </a></p>';
                                
                            }
                        }
                    } 
                    ?>

                    <!-- Add more course items as needed -->
                </ul>
            </div>
            <hr>
            <div class="course-list">
    <h3 style="color:#1177d1;">Khác</h3>
    <div class="row">
        <?php 
            $list_Theory = Detail::list_SubjectDetailByType($id, 'other');
            if (isset($list_Theory)) {
                foreach ($list_Theory as $item) {
                    echo '<div class="col-xl-4 col-md-6 col-12 mb-4">
                            <div class="video-container">
                                <iframe width="100%" height="100%" src="'.htmlspecialchars($item['file']).'" frameborder="0" allowfullscreen></iframe>
                                <div class="video-title">
                                    <p>'.htmlspecialchars($item['subjectTitle']).'</p>
                                </div>
                            </div>
                          </div>';
                }
            }
        ?>
    </div>
</div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 sidebar">
                <h5 style="color:red;"><i class="fas fa-newspaper"></i> Thông báo mới</h5>
                <br>
                <ul>
                    <?php
                    $list_thongbao = ThongTin::getListThongTinByTypeLimit8("thongbao");
                    if(isset($list_thongbao))
                    {
                        if(is_array($list_thongbao))
                        {
                            foreach($list_thongbao as $item)
                            {
                                echo '<li><a href="./noidungthongbao.php?sid='.htmlspecialchars($item['id']).'">'.htmlspecialchars($item['infoTitle']).'<br><span class="date">'.htmlspecialchars($item['day']).'</span> <span class="new">mới</span></a></li>';
                            }
                        }
                    }
                    ?>
                </ul>
                <div class="xemthem"><a style="text-decoration: none;
                      color: red;" href="./thongbaochitiet.php"><i class="fas fa-square-plus"></i> Xem thêm</a></div>
            </div>
            </div>
        </div>
        <div class="my-courses" id="my-courses">
        <h3 style="color:red;"><i class="fas fa-book"></i> Môn học</h3>
            <ul id="course-list">
                <?php
                    $list_LimitSubject=Detail::showLimitSubject10();
                    if(isset($list_LimitSubject))
                    {
                        if(is_array($list_LimitSubject))
                        {
                            foreach($list_LimitSubject as $item)
                            {
                                echo '<li class="thea" style="color:#0073e6;"> <i class="fas fa-graduation-cap"></i> <a class="thea" style="color:#0073e6;" href="./ChiTietTaiLieu.php?sid='.htmlspecialchars($item['subjectCode']).'">'.htmlspecialchars($item['subjectName']).'</a></li>';
                            }
                        }
                    }
                ?>
                <!-- Add more course items as needed -->
            </ul>
            <div class="xemthem"><a style="text-decoration: none;
                      color: red;" href="./MonHoc.php"><i class="fas fa-square-plus"></i> Xem thêm</a></div>
        </div>
        <button id="toggle-courses">➤</button>
    </main>
    <script>
        document.getElementById('toggle-courses').addEventListener('click', function() {
            const myCourses = document.getElementById('my-courses');
            const isHidden = myCourses.style.transform === 'translateX(0%)';
            myCourses.style.transform = isHidden ? 'translateX(100%)' : 'translateX(0%)';
            this.innerHTML = isHidden ? '➤' : '◄';
            this.style.right = isHidden ? '0' : '300px'; // Adjust button position to include 50px margin
        });
    </script>

<?php require_once("footer.php") ?>

</body>
</html>
