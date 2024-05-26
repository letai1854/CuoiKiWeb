<?php
session_start(); // Khởi đầu session
require_once('Config/db.class.php');
require_once('entities/account.php');
if (isset($_POST['btnlogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
            try {
                $result=User::checkLogin($email,$password);

                if ($result->num_rows === 1) {
                    $_SESSION['username'] = $email;
                    header("Location: index.php");
                    exit();
                } else {
echo '<script>alert("Sai tài khoản hoặc mật khẩu");</script>';
                    
                }
              
            } catch (Exception $e) {
                echo "<p class='error'>Lỗi: " . $e->getMessage() . "</p>";
            }
        }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
    <style>
        .errorMessage{
            color: rgb(216, 49, 49);
            font-size: 14px;
        }
        .quen{
            margin-top: 15px;
           
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <img src="./image/logoTruong-Photoroom.png-Photoroom.png" alt="Logo" class="logo">
            <h1>CỔNG THÔNG TIN GIẢNG VIÊN</h1>
        </div>
        
        <div class="right-panel">
        <div class="header">
                <a href="./index.php" style="color: #b71c1c;"><i class="fas fa-house-user"></i></a>
        </div>
            <div class="login-box">
                <h2>XIN CHÀO!</h2>
                <a href="#" class="social-login"><i class="fab fa-facebook"></i></a>
                <form action="" method="post" onsubmit="return validate()">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" id="email" placeholder="Nhập email" >
                    </div>
    
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Nhập mật khẩu" id="password" name="password">
                        <div class="eye">
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <button type="submit" name="btnlogin" style="border-radius: 5px;">ĐĂNG NHẬP</button>
                    </div>
                    <div class="d-none errorMessage my-3" >Hãy nhập mật khẩu</div>
                </form>
                <div class="quen">
                <a style=" text-decoration: none;" href="./sendMail.php">Quên mật khẩu</a>
                </div>
                
                <img src="./image/meo-Photoroom.png-Photoroom.png" alt="Mascot" class="mascot">
            </div>
        </div>
    </div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var emailField = document.querySelector('#email');
    var passwordField = document.querySelector('#password');

    emailField.addEventListener('input', function() {
        hideError();
    });

    passwordField.addEventListener('input', function() {
        hideError();
    });
    togglePassword.addEventListener('click', function() {
            var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    function showError(message) {
        let error = document.querySelector('.errorMessage');
        if (message == null || message == undefined) {
            if (!error.classList.contains('d-none')) {
                error.classList.add('d-none');
            }
        } else {
            error.classList.remove('d-none');
            error.innerHTML = message;
        }
    }

    function hideError() {
        let error = document.querySelector('.errorMessage');
        if (!error.classList.contains('d-none')) {
            error.classList.add('d-none');
        }
    }

    function validate() {
        var email = emailField.value;
        var password = passwordField.value;
        var isValid = true;
        if (email === "") {
            showError('Vui lòng nhập email');
            isValid = false;
            return false;
        } else if (!/\b[A-Za-z0-9._%+-]+@gmail\.com\b/.test(email)) {
            showError('Email không hợp lệ');
            isValid = false;
            return false;
        }
        if (password === "") {
            showError('Vui lòng nhập mật khẩu');
            isValid = false;
            return false;
        } else if (password.length < 6) {
            showError('Mật khẩu từ 6 kí tự trở lên');
            isValid = false;
            return false;
        }
        if (isValid) {
            document.getElementById("login").submit();
        }
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        if (!validate()) {
            event.preventDefault();
        }
    });
});



    </script>
