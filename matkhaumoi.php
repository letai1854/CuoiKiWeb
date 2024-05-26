<?php
require_once('Config/db.class.php');
require_once('entities/account.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'], $_POST['email'])) {
        $encodedEmail = $_GET['a'];
        $email = urldecode($encodedEmail);
        $pass = $_POST['password'];
        
        $result = User::suaMathau($pass, $email);
        if ($result) {
            echo '<script>alert("Đổi mật khẩu thành công");</script>';
            // Chuyển hướng người dùng đến trang khác sau khi đổi mật khẩu thành công
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Đổi mật khẩu không thành công");</script>';
        }
    } else {
        echo '<script>alert("Dữ liệu không hợp lệ");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Information Portal</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    .errorMessage {
      color: rgb(216, 49, 49);
      font-size: 14px;
    }
    .hidden {
      display: none;
    }
    .container {
      display: flex;
      width: 50%;
      height: 50vh;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
      background-color: white;
      position: relative;
    }
    .right-panel {
      background-color: white;
      flex: 1.5;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      padding: 20px;
    }
    .login-box h2 {
      color: #d32f2f;
      margin-bottom: 20px;
    }
    .header {
      position: absolute;
      top: 15px;
      right: 10px;
      font-size: 30px;
    }
    .login-box {
      width: 80%;
      max-width: 400px;
      text-align: center;
      position: relative;
    }
    .social-login {
      display: inline-block;
      background-color: #3b5998;
      color: white;
      padding: 10px;
      border-radius: 50%;
      margin-bottom: 20px;
      text-decoration: none;
      font-size: 24px;
    }
    .input-group {
      position: relative;
      margin-bottom: 20px;
    }
    .input-group i {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #d32f2f;
    }
    .input-group input {
      width: 100%;
      padding: 10px 10px 10px 40px;
      border: 1px solid #d32f2f;
      border-radius: 5px;
    }
    button {
      width: 50%;
      padding: 10px;
      background-color: #d32f2f;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      display: block;
      margin: 0 auto;
    }
    button:hover {
      background-color: #b71c1c;
    }
    .mascot {
      width: 100px;
      position: absolute;
      bottom: -10px;
      right: -130px;
    }
    @media (max-width: 1400px) {
      .container {
        flex-direction: column;
        width: 70%;
        height: auto;
      }
      .mascot {
        position: static;
      }
    }
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        width: 90%;
        height: auto;
      }
      .right-panel {
        padding: 10px;
        width: 100%;
      }
      .login-box {
        width: 90%;
      }
      .mascot {
        position: static;
        margin-top: 20px;
      }
    }
    @media (max-width: 480px) {
      .login-box {
        width: 100%;
      }
      button {
        font-size: 14px;
      }
      .container {
        width: 100%;
        height: 100vh;
      }
      .right-panel {
        width: 100%;
        height: 100vh;
      }
    }
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
      overflow-x: hidden;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="right-panel">
      <div class="header">
        <a href="./index.php" style="color: #b71c1c;"><i class="fas fa-house-user"></i></a>
      </div>
      <div class="login-box">
        <h2>XIN CHÀO!</h2>
        <a href="#" class="social-login"><i class="fab fa-facebook"></i></a>
        <form action="" method="post" onsubmit="return validate()">
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="text" name="password" id="password" placeholder="Nhập mật khẩu mới" >
                    </div>
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($encodedEmail); ?>">
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="text" placeholder="Nhập lại mật khẩu" id="newpassword" name="new password">
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <button type="submit" name="btnlogin" style="border-radius: 5px;">xác nhận</button>
                    </div>
                    <div class="errorMessage hidden" id="passwordError">Mật khẩu không hợp lệ (ít nhất 6 ký tự)</div>
                    </div>

                </form>
        <img src="./image/meo-Photoroom.png-Photoroom.png" alt="Mascot" class="mascot">
      </div>
    </div>
  </div>


  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var passwordField = document.querySelector('#password');
    var newPasswordField = document.querySelector('#newpassword');

    passwordField.addEventListener('input', function() {
      hideErrorMessage();
    });

    newPasswordField.addEventListener('input', function() {
      hideErrorMessage();
    });

    function hideErrorMessage() {
      document.getElementById('passwordError').classList.add('hidden');
      document.getElementById('newPasswordError').classList.add('hidden');
    }

    function validate() {
      var password = passwordField.value;
      var newPassword = newPasswordField.value;
      var passwordError = document.getElementById('passwordError');
      
      // Kiểm tra mật khẩu không được để trống và phải có ít nhất 6 ký tự
      if (password.trim() === '' || password.length < 6) {
        passwordError.classList.remove('hidden');
        passwordError.textContent = 'Mật khẩu không hợp lệ (ít nhất 6 ký tự)';
        return false;
      } else {
        passwordError.classList.add('hidden');
      }

      // Kiểm tra mật khẩu mới không được để trống và phải có ít nhất 6 ký tự
      if (newPassword.trim() === '' || newPassword.length < 6) {
        passwordError.classList.remove('hidden');
        passwordError.textContent = 'Mật khẩu nhập lại không hợp lệ (ít nhất 6 ký tự)';
        return false;
      } else {
        passwordError.classList.add('hidden');
      }

      // Kiểm tra hai mật khẩu có trùng nhau không
      if (password !== newPassword) {
        passwordError.classList.remove('hidden');
        passwordError.textContent = 'Hai mật khẩu không khớp';
        return false;
      } else {
        passwordError.classList.add('hidden');
      }

      return true;
    }

    document.querySelector('form').addEventListener('submit', function(event) {
      if (!validate()) {
        event.preventDefault();
      }
    });
  });
</script>
