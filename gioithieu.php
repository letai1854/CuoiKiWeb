<?php
require_once('entities/account.php');
$user = 'hahehiho9999@gmail.com';
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
}

$account = User::getInforAccount($user);

function truncateTextList($text, $limit = 50) {
    // Decode HTML entities to ensure all spaces are properly recognized
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    
    // Remove all HTML tags
    $text = strip_tags($text);
    
    // Split the text into words
    $words = preg_split('/\s+/', $text);
    
    // If there are more words than the limit, truncate the text
    if (count($words) > $limit) {
        $words = array_slice($words, 0, $limit);
        return implode(' ', $words) . '...';
    }
    
    return $text;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu giảng viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .profile {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        .profile img {
            border-radius: 50%;
            margin-right: 20px;
            border: 2px solid #ddd;
            padding: 5px;
        }
        .profile-info {
            max-width: 600px;
        }
        .profile-info h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .profile-info p {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #555;
        }
        .profile-info a {
            color: #007BFF;
            text-decoration: none;
        }
        .profile-info a:hover {
            text-decoration: underline;
        }
        .content-wrapper {
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div id="logo">
        <img src="./logo.png" alt="Logo">
        <div>
            <h2>ĐẠI HỌC<br>TÔN ĐỨC THẮNG</h2>
            <h4>GIẢNG VIÊN KHOA CÔNG NGHỆ THÔNG TIN</h4>
        </div>
    </div>

    <?php require_once("nav.php") ?>

    <div class="content-wrapper">
        <div class="profile">
            <img src="<?php echo htmlspecialchars($account[0]['image']); ?>" alt="Tin T. Tran" width="150" height="150">
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($account[0]['teacherName']); ?></h1>
                <p><?php echo truncateTextList($account[0]['info']); ?></p>
                <p>
                    <i class="fa fa-phone text-danger mr-3"></i>
                    <a id="footer-phone" href="tel:<?php echo htmlspecialchars($account[0]['phone']); ?>"><?php echo htmlspecialchars($account[0]['phone']); ?></a>
                    <br>
                    <i class="fas fa-envelope mr-3" aria-hidden="true"></i>
                    <a id="footer-email" href="mailto:<?php echo htmlspecialchars($account[0]['email']); ?>"><?php echo htmlspecialchars($account[0]['email']); ?></a>
                </p>
            </div>
        </div>
    </div>
    
    <?php require_once("footer.php") ?>

</body>
</html>
