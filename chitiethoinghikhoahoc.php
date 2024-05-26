<?php
    include_once('entities/research.class.php');
    require_once('entities/account.php');

    require_once('session.php');
    if(isset($_SESSION['username'])){
    $userName = user::get_teacherName($_SESSION['username']);
    $owner = true;
    } else {
    $owner = false;
    }
    $item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:4;
$current_page=!empty($_GET['page'])?$_GET['page']:1;
$offset=($current_page-1)*$item_per_page;
$checkTim=false;
$checkTim = isset($_GET['c']) ? base64_decode($_GET['c']) : false;
if(isset($_POST['btntimkiem'])){
    $checkTim=true;
    $key=$_POST['tim']; 
}
    function truncateTextList($text, $limit = 100) {
        // Decode HTML entities to ensure all spaces are properly recognized
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        
        // Remove all HTML tags
        $text = strip_tags($text);
        
        // Split the text into words
        $words = preg_split('/\s+/', $text);
        
        // If there are more words than the limit, truncate the text
        if (count($words) > $limit) {
            $words = array_slice($words, 0, $limit);
            return implode(' ', $words) . '...';
        }
        
        return $text;
    }
    
    
    function showList($list) {
        if (isset($list)) {
            if (is_array($list)) {
                foreach ($list as $item) {
                    // Get truncated content without HTML tags
                    $truncatedContent = truncateTextList($item['content']);
                          echo '<div class="news-item">
              <div class="news-img">
              <img src="'.htmlspecialchars($item['image']).'" alt="News Image">
              </div>
              <div class="news-content"><a class="thea" href="./noidunghoinghikhoahoc.php?sid='.htmlspecialchars($item['id']).'"><h5 class="thea">'.htmlspecialchars($item['title']).'</h5></a>
              <p> '.$truncatedContent.'</p> <div class="project-content"><strong>Ngày đăng:</strong> '.htmlspecialchars($item['day']).'</div>
              </div>  
          </div>
          <hr>';
                }
            }
        }
    }
    
      ?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hội nghị khoa học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css" />
    <style>
        #info {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            padding: 50px;
            margin-bottom: 20px;
        }

        #info .header {
            background-color: #eef3fb;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #ddd;
        }

        #info .project {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        #info .project:last-child {
            border-bottom: none;
        }

        #info .project-title {
            font-size: 18px;
            color: #0066cc;
            margin-bottom: 5px;
        }

        #info .project-content {
            font-size: 14px;
            color: #666;
        }
        .header{
            margin-bottom: 30px;
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
        .thea:hover {
            color: red;
        }
        .thea {
            text-decoration: none;
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
    <div id="info" class="container">
        <div class="header">
            Hội nghị khoa học
        </div>
        <div class="content">
            

            <?php
              $totalSubject=1;
              $list_thongbao="";
              $list_research = Research::getHoiNghi($item_per_page,$offset);
              $totalSubject=count(Research::countgetHoiNghi());
              $totalPage=ceil($totalSubject/$item_per_page);
            showList($list_research); ?>
        </div>
    
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
    <?php
        require_once('footer.php');
    ?>
</body>
</html>
