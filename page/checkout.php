<div class="hero_area">
    <!-- header section starts -->
    <?php include('layout/header.php'); ?>
    <!-- end header section -->

    <div class="container mt-5">
    <div class="row" style="margin-top: 100px; margin-bottom: 50px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="mb-0">Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php
                        $tongTien = 0;
                        $tongSoLuong = 0;
                        $userId = $_SESSION['user'];
                        $sql = "SELECT xe.*, giohang.* FROM giohang JOIN xe ON giohang.MA_XE = xe.MA_XE WHERE ID_USER = $userId";
                        $result = mysqli_query($connect, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tongTien += $row['GIA'] * $row['SO_LUONG'];
                                $tongSoLuong += $row['SO_LUONG'];
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo $row['TEN_XE']; ?> (x<?php echo $row['SO_LUONG']; ?>)
                                    <span><?php echo number_format($row['GIA'] * $row['SO_LUONG']); ?> VND</span>
                                </li>
                                <?php
                            }
                        } else {
                            echo "<li class='list-group-item text-center'>Giỏ hàng trống</li>";
                        }
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <strong>Tổng tiền</strong>
                            <span><strong><?php echo number_format($tongTien); ?> VND</strong></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="mb-0">Thông tin thanh toán</h5>
                </div>
                <div class="card-body">
                    <form action="index.php?act=checkout" method="post">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="payment-method" class="form-label">Phương thức thanh toán</label>
                            <select class="form-select" id="payment-method" name="payment_method" required>
                                <option value="1">Thanh toán khi nhận hàng (COD)</option>
                            </select>
                        </div>
                        <button type="submit" name="checkout" class="btn btn-primary btn-block">Thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['checkout'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['payment_method'];
    $userId = $_SESSION['user'];

    $query_cart = "SELECT * FROM giohang WHERE ID_USER = $userId";
    $result_cart = mysqli_query($connect, $query_cart);

    if (mysqli_num_rows($result_cart) > 0) {
        $ngayLapHD = date('Y-m-d');
        $trangThai = '1'; 

        $sql_insert_hoadon = "INSERT INTO hoadon (ID_USER, NGAY_LAP_HD, PHUONG_THUC_THANH_TOAN, TRANG_THAI, TONG_SO_LUONG, TONG_TIEN, HOTEN, EMAIL, SDT, DIACHI)
                              VALUES ($userId, '$ngayLapHD', '$paymentMethod', '$trangThai', $tongSoLuong, $tongTien, '$fullname', '$email', '$phone', '$address')";
        mysqli_query($connect, $sql_insert_hoadon);

        $maHD = mysqli_insert_id($connect);

        while ($row = mysqli_fetch_assoc($result_cart)) {
            $maXe = $row['MA_XE'];
            $soLuong = $row['SO_LUONG'];

            $query_gia = "SELECT GIA FROM xe WHERE MA_XE = $maXe";
            $result_gia = mysqli_query($connect, $query_gia);
            $giaBan = mysqli_fetch_assoc($result_gia)['GIA'];

            $sql_insert_cthd = "INSERT INTO cthd (MA_HD, MA_XE, SO_LUONG, GIA_BAN)
                                VALUES ($maHD, $maXe, $soLuong, $giaBan)";
            mysqli_query($connect, $sql_insert_cthd);
        }

        $sql_delete_cart = "DELETE FROM giohang WHERE ID_USER = $userId";
        mysqli_query($connect, $sql_delete_cart);

        echo "<script>alert('Thanh toán thành công!');</script>";
        echo "<script>window.location='https://huylexx.id.vn/index.php?act=order_history';</script>";
    } else {
        echo "<script>alert('Giỏ hàng trống!');</script>";
        echo "<script>window.location='index.php?act=cart';</script>";
    }
}
?>

<?php include('layout/footer.php'); ?>

</div>
