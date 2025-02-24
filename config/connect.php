<?php

$connect = mysqli_connect('localhost', 'root', '') or die("Lỗi kết nối");
mysqli_set_charset($connect, 'utf8');
if (!$connect) {
    echo "<div class='alert alert-danger'>Lỗi kết nối: " . mysqli_connect_error() . "</div>";
}

// Tạo database
$db = "CREATE DATABASE quanlyxe";
mysqli_query($connect, $db);
$connect = mysqli_connect('localhost', 'root', '', 'quanlyxe');
mysqli_set_charset($connect, "utf8");
if (!$connect) {
    echo "<div class='alert alert-danger'>Lỗi kết nối: " . mysqli_connect_error() . "</div>";
}

// Hiển thị tất cả sản phẩm
$all_product = mysqli_query($connect, "SELECT * FROM xe ORDER BY RAND()");

// Hiển thị sản phẩm mới
$new_product = mysqli_query($connect, "SELECT * FROM xe WHERE LOAI_HANG = 'Mới' ORDER BY RAND() LIMIT 8");

// Hiển thị sản phẩm hot
$hot_product = mysqli_query($connect, "SELECT * FROM xe WHERE LOAI_HANG = 'Nóng' ORDER BY RAND() LIMIT 8");


//Tin nhắn liên hệ
if (isset($_POST['message_send'])) {
    $fullname_mess = $_POST['fullname_mess'];
    $email_mess = $_POST['email_mess'];
    $phone_mess = $_POST['phone_mess'];
    $message = $_POST['message'];

    $message_query = "INSERT INTO lienhe(TEN, EMAIL_TINNHAN, SDT, TINNHAN) VALUES
        ('$fullname_mess', '$email_mess', '$phone_mess', '$message')";
    mysqli_query($connect, $message_query);

    ?>
    <script>
        alert("Gửi lời nhắn thành công!!")
    </script>
    <?php
}



?>