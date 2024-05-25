<?php
    include_once('entities/research.class.php');
    $list_research = Research::getNCKH();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Công trình NCKH</title>
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

    </style>
</head>
<body>
    <div>
        <div id="logo">
        <div>    
            <img src="./logo.png" alt="Logo"></div>
            <div><h2 style="margin-left: 6px;">ĐẠI HỌC <br> TÔN ĐỨC THẮNG</h2>
                <h4 style="margin-left: 6px;">GIẢNG VIÊN KHOA CÔNG NGHỆ THÔNG TIN</h4>
            </div>
        </div>
        <!-- <img src="./images/user1.jpg" alt="User Image"> -->
    </div>
    <div id="info" class="container">
        <div class="header">
            Công trình NCKH
        </div>
        <div class="content">
            <?php 
                foreach($list_research as $item) {
                    echo '<div class="project">
                          <div class="project-title">'.htmlspecialchars($item['title']).'</div>
                          <div class="project-content"><strong>Nội dung:</strong> '.htmlspecialchars($item['content']).'</div>
                          <div class="project-content"><strong>Ngày đăng:</strong> '.htmlspecialchars($item['day']).'</div>
                          </div>';
                }
            ?>
        </div>
    </div>
    <?php
        require_once('footer.php');
    ?>
</body>
</html>
