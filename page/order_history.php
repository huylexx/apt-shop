<?php
include('layout/header.php');

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Vui lòng đăng nhập để xem lịch sử đơn hàng!');</script>";
    echo "<script>window.location='index.php?act=login';</script>";
    exit;
}

$userId = $_SESSION['user']; 

$sql = "SELECT * FROM hoadon WHERE ID_USER = $userId ORDER BY NGAY_LAP_HD DESC";
$result = mysqli_query($connect, $sql);

$userSql = "SELECT * FROM taikhoan WHERE ID_USER = $userId";
$userResult = mysqli_query($connect, $userSql);
$userData = mysqli_fetch_assoc($userResult);
?>

<div class="container mt-5">
    <div class="row" style="margin-top: 100px; margin-bottom: 100px;">
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Thông tin cá nhân</h5>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> <?= htmlspecialchars($userData['TEN']); ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($userData['EMAIL']); ?></p>
                    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($userData['SDT']); ?></p>
                    <p><strong>Địa chỉ:</strong>
                        <?= !empty($userData['DIACHI']) ? htmlspecialchars($userData['DIACHI']) : 'Chưa cập nhật'; ?>
                    </p>
                    <hr>
                    <ul class="list-unstyled">
                        <li><a href="index.php?act=profile" class="btn btn-link">Chỉnh sửa thông tin</a></li>
                        <li><a href="index.php?act=order_history" class="btn btn-link">Lịch sử đơn hàng</a></li>
                        <li><a href="index.php?act=change_password" class="btn btn-link">Đổi mật khẩu</a></li>
                        <li><a href="index.php?act=logout" class="btn btn-link text-danger">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-md-8">
            <h3 class="text-center pb-4">Lịch sử đơn hàng</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày lập</th>
                            <th>Tổng tiền</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                switch ($row['TRANG_THAI']) {
                                    case '1': $trangThai = 'Đang chờ'; break;
                                    case '2': $trangThai = 'Đã hoàn thành'; break;
                                }

                                $phuongThucThanhToan = $row['PHUONG_THUC_THANH_TOAN'];
                                if ($phuongThucThanhToan == '1') {
                                    $pttt = "Thanh toán khi nhận hàng";
                                }

                                ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($row['MA_HD']); ?></td>
                                    <td><?= htmlspecialchars($row['NGAY_LAP_HD']); ?></td>
                                    <td><?= number_format($row['TONG_TIEN']); ?> VND</td>
                                    <td><?= $pttt; ?></td>
                                    <td><?= $trangThai; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">Không có đơn hàng nào.</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('layout/footer.php'); ?>
