<?php
if (isset($_POST['btnlogin'])) {
    if (isset($_POST['email'])) {
        require_once('reset_password.php');
        $code6 = random_int(100000, 999999);
        $check_success = reset_password($_POST['email'], $code6);
        if ($check_success) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var verificationPopup = new bootstrap.Modal(document.getElementById("verificationPopup"));
                        verificationPopup.show();
                        window.code6 = ' . $code6 . ';
                    });
                  </script>';
        } else {
            echo '<script>alert("Gửi email thất bại!")</script>';
        }
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
            <i class="fas fa-user"></i>
            <input type="text" name="email" id="email" placeholder="Nhập email" oninput="hideErrorMessage()">
          </div>
          <div class="form-group d-flex justify-content-center align-items-center">
            <button type="submit" name="btnlogin" style="border-radius: 5px;">Gửi</button>
          </div>
          <div class="errorMessage hidden">Hãy nhập email hợp lệ</div>
        </form>
        <img src="./image/meo-Photoroom.png-Photoroom.png" alt="Mascot" class="mascot">
      </div>
    </div>
  </div>

  <div class="modal fade" id="verificationPopup" tabindex="-1" aria-labelledby="verificationPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="verificationPopupLabel">Xác thực</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Nhập 6 số xác thực:</p>
          <input type="text" class="form-control" id="verificationCode">
          <div id="countdown">Thời gian còn lại: 05:00</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" onclick="verifyCode()">Xác nhận</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function validate() {
      const email = document.getElementById('email').value;
      const errorMessage = document.querySelector('.errorMessage');
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!email) {
        errorMessage.textContent = 'Hãy nhập email';
        errorMessage.classList.remove('hidden');
        return false;
      } else if (!emailPattern.test(email)) {
        errorMessage.textContent = 'Hãy nhập email hợp lệ';
        errorMessage.classList.remove('hidden');
        return false;
      } else {
        errorMessage.classList.add('hidden');
        return true;
      }
    }

    function hideErrorMessage() {
      const errorMessage = document.querySelector('.errorMessage');
      errorMessage.classList.add('hidden');
    }

    var countdownElement = document.getElementById('countdown');
    var verificationPopup = new bootstrap.Modal(document.getElementById('verificationPopup'));
    var secondsRemaining = 300;
    var countdownFinished = false;

    function startCountdown() {
      var countdownInterval = setInterval(function() {
        if (secondsRemaining > 0) {
          secondsRemaining--;
          var minutes = Math.floor(secondsRemaining / 60);
          var seconds = secondsRemaining % 60;
          countdownElement.textContent = 'Thời gian còn lại: ' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
        } else {
          clearInterval(countdownInterval);
          verificationPopup.hide();
          countdownFinished = true;
        }
      }, 1000);
    }

    function verifyCode() {
      var inputCode = document.getElementById('verificationCode').value;
      if (countdownFinished) {
        alert('Thời gian xác thực đã hết.');
      } else if (inputCode == window.code6) {
        window.location.href = './index.php';
      } else {
        alert('Mã xác thực không đúng.');
      }
    }

    document.addEventListener("DOMContentLoaded", function() {
      if (window.code6) {
        startCountdown();
      }
    });
  </script>
</body>
</html>
