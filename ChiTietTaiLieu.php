<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webpage with Bootstrap</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .left-column, .right-column {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .left-column h3, .right-column h3 {
            margin-top: 0;
        }
        .left-column a, .right-column a {
            display: block;
            margin-bottom: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .left-column a:hover, .right-column a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 left-column">
            <h3>Thầy Thanh</h3>
            <a href="#">Slides</a>
            <a href="#">Tài liệu tham khảo</a>
            <a href="#">Bài tập 1: Thiết kế Layout với Html5, Css3,..</a>
            <a href="#">Bài tập 2: Sử dụng bootstrap để thiết kế template</a>
            <a href="#">Bài tập Javascript cơ bản</a>
            <a href="#">Javascript nâng cao</a>
            <hr>
            <h3>Chương 1. Giao thức HTTP (Thầy Mạnh)</h3>
            <a href="#" class="text-danger">Đề cương chi tiết môn học</a>
            <a href="#" class="text-danger">Slide bài giảng Chương 1</a>
            <a href="#">Tài liệu chính thức của môn học</a>
            <a href="#" class="text-purple">Diễn đàn thảo luận về Chương 1</a>
        </div>
        <div class="col-md-6 right-column">
            <h3>Môn Học</h3>
            <div>
                <h4>Lập trình hướng đối tượng</h4>
                <p>Lập trình hướng đối tượng (Object Oriented Programming - OOP) là một trong những kỹ thuật lập trình rất quan trọng và sử dụng nhiều hiện nay. Hầu hết các ngôn ngữ lập trình hiện nay như Java, PHP, .NET, Ruby, Python... đều hỗ trợ OOP. Vậy lập trình hướng đối tượng là gì? Và các nguyên lý cơ bản trong OOP cần biết là gì?</p>
            </div>
            <div>
                <h4>Cấu Trúc Dữ liệu Và Giải Thuật</h4>
                <p>Cấu trúc dữ liệu & giải thuật (Data Structure & Algorithms) là sự kết hợp và áp dụng một hoặc nhiều cấu trúc dữ liệu nào đó vào một hoặc nhiều thuật toán nào đó để có được đầu ra mong muốn một cách tối ưu và tốt nhất khi dữ liệu có số lượng cực lớn.</p>
            </div>
            <div>
                <h4>Lập Trình Web phiên bản nâng cao</h4>
                <p>Lập trình web là gì? Lập trình web là công việc của một Web Developer (Lập trình viên website) có nhiệm vụ nhận bộ dữ liệu (Giao diện web tĩnh) từ bộ phận thiết kế web để chuyển thành một hệ thống website hoàn chỉnh có tương tác với CSDL và tương tác với người dùng dựa trên ngôn ngữ máy tính.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
