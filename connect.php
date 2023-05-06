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
?>