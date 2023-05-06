<?php
// Khai báo username và password cho Authentication Basic
    $user = '1';
    $pass = '2';

    // Kiểm tra xem username và password đã được submit hay chưa
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
        || $_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pass) 
    {
        // Nếu chưa, yêu cầu người dùng nhập username và password
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Bạn phải xác thực bằng username và password để truy cập tài nguyên này.';
        exit;
    }
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
    $today = date('Y-m-d');
    $sql = "SELECT * FROM `data_customer` WHERE created_at > '$today'";
    $result = $conn->query($sql);
    // Chuyển đổi kết quả thành định dạng JSON
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    // Đóng kết nối đến cơ sở dữ liệu MySQL
    $conn->close();
    unset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
?>
<head>
    <meta charset="utf-8">
    <title>Google Ads - List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script async src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="get-data.php">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="exampleInputdate" class="form-label">Input Date</label>
                                    <input name="select_date" type="date" class="form-control" id="exampleInputdate">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Chọn</button>
                                </div>
                            </div>
                        </form>
                        <div class="listjs-table" id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search" placeholder="Search..." />
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive table-card mt-3 mb-1" id="table_responsive">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="customer_name">IP</th>
                                            <th class="sort" data-sort="email">Vị trí</th>
                                            <th class="sort" data-sort="phone">Ngày</th>
                                            <th class="sort" data-sort="date">Điện thoại</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <?php foreach($data as $key => $item) { ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child" value="option$key" />
                                                </div>
                                            </th>
                                            <td class="customer_name"><?php echo $item['ip'] ?></td>
                                            <td class="email"><?php echo $item['location'] ?></td>
                                            <td class="phone"><?php echo $item['created_at'] ?></td>
                                            <td class="date"><?php echo $item['phone_number'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div id="result" class="noresult" style="display: none;">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 75px; height: 75px;"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end" id="find_data">
                                <div class="pagination-wrap hstack gap-2">
                                    <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                                        Previous
                                    </a>
                                    <ul class="pagination listjs-pagination mb-0">
                                        <li class="active"><a class="page" href="#" data-i="10" data-page="8">1</a></li>
                                    </ul>
                                    <a class="page-item pagination-next" href="javascrpit:void(0)">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Loading -->
    <div class="overlay" id="loading">
        <div class="loading">
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <script async src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script async src="assets/libs/simplebar/simplebar.min.js"></script>
    <script async src="assets/libs/node-waves/waves.min.js"></script>
    <script async src="assets/libs/feather-icons/feather.min.js"></script>
    <script async src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script async src="assets/js/plugins.js"></script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script async type="text/javascript" src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script async type="text/javascript" src="assets/libs/flatpickr/flatpickr.min.js"></script>
    <script async src="assets/libs/prismjs/prism.js"></script>
    <script async src="assets/libs/list.js/list.min.js"></script>
    <script async src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <script async src="assets/js/pages/listjs.init.js"></script>
    <script async src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script async src="assets/js/app.js"></script>
    <script async src="assets/js/jquery.js"></script>
    <script async src="assets/js/get-data.js"></script>
</body>
