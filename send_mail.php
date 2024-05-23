
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
class mail_service
{
    public static function send_mail($address, $subject, $message)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP(); // Sử dụng SMTP để gửi mail
            $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
            $mail->SMTPAuth = true; // Bật xác thực SMTP
            $mail->Username = 'khoahoc5678@gmail.com'; // Tài khoản email
            $mail->Password = 'jxwoxvurybdqigry'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
            $mail->SMTPSecure = 'ssl'; // Mã hóa SSL
            $mail->Port = 465; // Cổng kết nối SMTP là 465
            $mail->SMTPDebug  = 0; //file đang mở
            //Recipients
            $mail->setFrom('khoahoc5678@gmail.com', 'khoa hoc'); // Địa chỉ email và tên người gửi
            $mail->addAddress($address); // Địa chỉ mail và tên người nhận

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject; // Tiêu đề
            $mail->Body = $message; // Nội dung

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
