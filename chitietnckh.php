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
    
</body>
</html>
