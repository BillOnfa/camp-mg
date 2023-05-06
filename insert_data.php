<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "camp-mg188";
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    for($i = 0; $i < 1000; $i++) {
        $randomString = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 10);
        $randomString2 = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 5);
        $phone = mt_rand(1000000000,9999999999);
        $ip = mt_rand(1000,9999);
        // $date = date('Y-m-d H:i:s', strtotime('-'.mt_rand(0,9).' days',time()));
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `data_customer`(`user_name`, `phone_number`, `ip`, `location`, `created_at`) VALUES ('$randomString','$phone','$ip','$randomString2', '$date')";
        if (mysqli_query($conn, $sql)) {
            echo "Dữ liệu đã được gửi thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    // Đóng kết nối
    mysqli_close($conn);
        
?>