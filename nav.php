<?php
// Include session management at the top before any output
require_once('session.php');
require_once("entities/thongtin.class.php");
require_once('entities/account.php');

if(isset($_SESSION['username'])){
    $userName = user::get_teacherName($_SESSION['username']);
    $owner = true;
} else {
    $owner = false;
}
session_write_close();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>

</style>

<nav class="navbar navbar-expand-lg py-3">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarColor01">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link active" href="./index.php">TRANG CHỦ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./gioithieu.php">GIỚI THIỆU</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./MonHoc.php">MÔN HỌC</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./tintucchitiet.php">TIN TỨC</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./thongbaochitiet.php">THÔNG BÁO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./vieclamchitiet.php">VIỆC LÀM</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        NGHIÊN CỨU
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="chitiethoinghikhoahoc.php">HỘI NGHỊ KHOA HỌC</a>
                        <a class="dropdown-item" href="chitietnckh.php">CÔNG TRÌNH NGHIÊN CỨU KHOA HỌC</a>
                        <a class="dropdown-item" href="chitietcongbokhoahoc.php">CÔNG BỐ KHOA HỌC</a>
                    </div>
                </li>
                <?php if ($owner) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="./Admin.php">ADMIN</a>
                    </li>
                <?php } ?>
            </ul>
            <div class="user-info ms-auto">
                <a class="nav-link" href="./login.php"><i class="fas fa-user"></i></a>
                <?php if($owner) { echo '<p class="text-white mb-0">'. $userName.'</p>';
              echo '  <a class="nav-link" href="logout.php"><i class="fas fa-right-from-bracket"></i></a>';
                
                } ?>
            </div>
        </div>
    </div>
</nav>
