<?php
    require_once('entities/account.php');
    require_once('entities/thongtin.class.php');
    $id=$_GET['sid'];
    $thongtin = ThongTin::getThongTinById($id);
    require_once('entities/account.php');

    require_once('session.php');
    if(isset($_SESSION['username'])){
    $userName = user::get_teacherName($_SESSION['username']);
    $owner = true;
    } else {
    $owner = false;
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


<link rel="stylesheet" href="style.css">
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
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
            display: flex;
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
            /* background-color: #0073e6; */
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
        .c1{
            margin-bottom: 100px;
        }
   </style>
</head>
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
<div class="c1" >
    <div class="container">
        <div class="titleh1">
            <?php
              if ($thongtin && isset($thongtin[0]['infoTitle'])) {
                  echo '<h2>'.htmlspecialchars($thongtin[0]['infoTitle']).'</h2>';
              } else {
                  echo '<h2>Title Not Available</h2>'; // Display a default message or handle the case where the title is not available
              }
            ?>
        </div>
        
        <p>
            <?php
              if ($thongtin && isset($thongtin[0]['day'])) {
                  echo htmlspecialchars($thongtin[0]['day']);
              } else {
                  echo 'Day not availabel'; // Display a default message or handle the case where the title is not available
              }
            ?>
        </p>
        <hr style="color: red; border-top: 2px solid black; font-weight: bold;"> </p>
    </div>
        <div class="container">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-12">
              <?php
                  if ($thongtin && isset($thongtin[0]['infoContents'])) {
                      echo $thongtin[0]['infoContents'];
                  } else {
                      echo 'Error'; 
                  }
                ?>
              </div>
    
              <div class="col-lg-12 col-md-12 col-12 sidebar">
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
</div>



      

<?php require_once("footer.php") ?>
    
</body>
</html>



