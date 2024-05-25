<?php
    include_once('entities/research.class.php');
    $list_research = Research::getCongBo();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Công trình NCKH</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fb;
            margin: 0;
            padding: 20px 0;
        }
        .container {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            padding: 20px;
            margin-bottom: 20px;
        }
        .header {
            background-color: #eef3fb;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #ddd;
        }
        .project {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .project:last-child {
            border-bottom: none;
        }
        .project-title {
            font-size: 18px;
            color: #0066cc;
            margin-bottom: 5px;
        }
        .project-content {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Công bố khoa học
        </div>
        <div class="content">
            <?php 
                foreach($list_research as $item) {
                    echo '<div class="project">
                          <p><strong>Tên đề tài:</strong> '.htmlspecialchars($item['title']).'</p>
                          <p><strong>Nội dung:</strong> '.htmlspecialchars($item['content']).'</p>
                          <p><strong>Ngày đăng:</strong> '.htmlspecialchars($item['day']).'</p>
                          </div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
