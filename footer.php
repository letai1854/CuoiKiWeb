<?php
// if(session_status() === PHP_SESSION_NONE) {
//     session_start();
// }
// $sdt = isset($_SESSION['footer_sdt']) ? $_SESSION['footer_sdt'] : "123456789";
// $email = isset($_SESSION['footer_email']) ? $_SESSION['footer_email'] : "DzoanXuanThanh@gmail.com";
if(isset($_POST['email']) && isset($_POST['sdt'])){
    echo '<script>
    document.getElementById("footer-email").textContent = "' . $_POST['email'] . '";
    document.getElementById("footer-phone").textContent = "' . $_POST['sdt'] . '";
    </script>';
}
?>


<footer id="footer" class="pt-4 footer divider layer-overlay  bg-theme-colored-gray mt-30" style="background-color: rgba(12, 12, 12, 0.905);">
    <div class="container">
        <div class="row ">
            <div class="col-md-4">
                <div class="widget text-white">
                  <h4 class="widget-title text-white font-16 "><b>Đại học Tôn Đức Thắng</b></h4>
                        <div class="opening-hours" style="margin-top: 13px;">
                            <ul class="list-border">
                                <li class="clearfix">
                                  <img src="./logo.png" alt="">
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="text-white">
                        <div class="widget ">
                            <h4 class="widget-title text-white font-17 font-weight-bold "><b>Liên hệ:</b></h4>
                            <div class="opening-hours">
                                <ul class="list-border">
                                    <li class="clearfix">
                                        <li class="m-0 pl-0 no-border"> <i class="fa fa-phone text-danger mr-3"></i> <a id="footer-phone" class="info"  <?php isset($_POST['email'])?$_POST['email']:123456789 ?>>123456789</a> </li>
                                        <li class="m-0 pl-0 no-border"> <i class="fas fa-envelope mr-3" aria-hidden="true"></i>
                                        <a id="footer-email" class="info">DzoanXuanThanh@gmail.com</a> </li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="text-white">
                        <div class="widget ">
                            <h4 class="widget-title text-white font-17 font-weight-bold sm-display-none"><b>Khoa công nghệ thông tin</b></h4>
                            <div class="opening-hours">
                                <ul class="list-border">
                                    <li class="clearfix">
                                        <li class="m-0 pl-0 no-border"> <i class="fa fa-home"></i><div class="info"> Địa chỉ: Phòng C004, Số 19 Nguyễn Hữu Thọ, P. Tân Phong, Quận 7, Tp. Hồ Chi Minh. </div></li>
                                        <li class="m-0 pl-0 no-border"> <i class="fa fa-phone"></i><div class="info"> Điện thoại: (028) 37755046</div></li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom bg-black-333">
            <div class="container pt-20 pb-20">
                <div class="row">
                    <div class="col-md-6">
                        <p class="font-11 m-0 text-white">
                            Copyright ©2024 52200020_52200045
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>  