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
    $select_date = isset($_POST['date']) ? $_POST['date'] : '';
    // Chuyển đổi giá trị của biến thành đối tượng DateTime
    $select_date2 = new DateTime($select_date);

    // Cộng thêm một ngày vào giá trị của đối tượng DateTime
    $select_date2->add(new DateInterval('P1D'));

    // Hiển thị giá trị mới của biến kiểu 'date'
    $next_day = $select_date2->format('Y-m-d');
    $sql = "SELECT * FROM `data_customer` WHERE created_at > '" .$conn->real_escape_string($select_date) ."' && created_at <'".$next_day."'";
    $result = $conn->query($sql);
    // Chuyển đổi kết quả thành định dạng JSON
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);

    // Đóng kết nối đến cơ sở dữ liệu MySQL
    $conn->close();
?>