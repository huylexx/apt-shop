<?php
// Kiểm tra nếu form được submit
if (isset($_POST['Them'])) {
    // Lấy dữ liệu từ form và loại bỏ ký tự đặc biệt để tránh SQL Injection
    $ma_hd = $_POST['MA_HD'];
    $ma_xe = $_POST['MA_XE'];
    $so_luong = $_POST['SO_LUONG'];
    $gia_ban = $_POST['GIA_BAN'];

    // Kiểm tra dữ liệu đầu vào
    if (empty($ma_hd) || empty($ma_xe) || empty($so_luong) || empty($gia_ban)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
    } else {
        // Kiểm tra xem mã hóa đơn có tồn tại hay không
        $sql_check_hd = "SELECT * FROM hoadon WHERE MA_HD = '$ma_hd'";
        $result_check_hd = mysqli_query($connect, $sql_check_hd);

        if (mysqli_num_rows($result_check_hd) == 0) {
            echo "<script>alert('Mã Hóa Đơn không tồn tại!');</script>";
        } else {
            // Thực hiện thêm chi tiết hóa đơn
            $sql_insert_cthd = "INSERT INTO cthd (MA_HD, MA_XE, SO_LUONG, GIA_BAN) 
                                VALUES ('$ma_hd', '$ma_xe', $so_luong, $gia_ban)";

            if (mysqli_query($connect, $sql_insert_cthd)) {
                echo "<script>alert('Thêm chi tiết hóa đơn thành công!'); window.location.href='index.php?act=detail-pay&id=$ma_hd';</script>";
            } else {
                echo "<script>alert('Lỗi: " . mysqli_error($connect) . "');</script>";
            }
        }
    }
}
?>

<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <?php include('layout/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center pb-4">Thêm Chi Tiết Hóa Đơn</h4>

                                <form action="index.php?act=add-detail-pay" method="post">
                                    <!-- Mã hóa đơn -->
                                    <div class="form-group">
                                        <label for="MA_HD">Mã Hóa Đơn</label>
                                        <input type="text" class="form-control" id="MA_HD" name="MA_HD" required>
                                    </div>

                                    <!-- Mã xe -->
                                    <div class="form-group">
                                        <label for="MA_XE">Mã Xe</label>
                                        <select class="form-control" id="MA_XE" name="MA_XE" required>
                                            <?php
                                            // Lấy danh sách xe từ cơ sở dữ liệu
                                            $sql_xe = "SELECT * FROM xe";
                                            $result_xe = mysqli_query($connect, $sql_xe);
                                            while ($row_xe = mysqli_fetch_assoc($result_xe)) {
                                                echo "<option value='" . $row_xe['MA_XE'] . "'>" . $row_xe['TEN_XE'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Số lượng -->
                                    <div class="form-group">
                                        <label for="SO_LUONG">Số Lượng</label>
                                        <input type="number" class="form-control" id="SO_LUONG" name="SO_LUONG" required>
                                    </div>

                                    <!-- Giá bán -->
                                    <div class="form-group">
                                        <label for="GIA_BAN">Giá Bán</label>
                                        <input type="number" class="form-control" id="GIA_BAN" name="GIA_BAN" required>
                                    </div>

                                    <!-- Nút Submit -->
                                    <button type="submit" name="Them" class="btn btn-primary">Thêm Chi Tiết</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <?php include('layout/footer.php'); ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
