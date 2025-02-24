<?php
include('layout/header.php');

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Vui lòng đăng nhập để xem thông tin cá nhân!');</script>";
    echo "<script>window.location='index.php?act=login';</script>";
    exit;
}

$userId = $_SESSION['user'];

$sql = "SELECT * FROM taikhoan WHERE ID_USER = $userId";
$result = mysqli_query($connect, $sql);
$userData = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hoTen = $_POST['hoTen'];
    $email =$_POST['email'];
    $soDienThoai =$_POST['soDienThoai'];
    $diaChi = $_POST['diaChi'];

    $updateSql = "UPDATE taikhoan SET 
                  TEN = '$hoTen', 
                  EMAIL = '$email', 
                  SDT = '$soDienThoai', 
                  DIACHI = '$diaChi' 
                  WHERE ID_USER = $userId";

    if (mysqli_query($connect, $updateSql)) {
        echo "<script>alert('Cập nhật thông tin thành công!');</script>";
        echo "<script>window.location='index.php?act=profile';</script>";
    } else {
        echo "<script>alert('Cập nhật thất bại. Vui lòng thử lại!');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row" style="margin-top: 100px; margin-bottom: 100px;">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Thông tin cá nhân</h5>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> <?php echo $userData['TEN']; ?></p>
                    <p><strong>Email:</strong> <?php echo $userData['EMAIL']; ?></p>
                    <p><strong>Số điện thoại:</strong> <?php echo $userData['SDT']; ?></p>
                    <p><strong>Địa chỉ:</strong>
                        <?php
                        if (!empty($userData['DIACHI'])) {
                            echo $userData['DIACHI'];
                        } else {
                            echo 'Chưa cập nhật';
                        }
                        ?>
                    </p>
                    <hr>
                    <ul class="list-unstyled">
                        <li><a href="index.php?act=profile" class="btn btn-link">Chỉnh sửa thông tin</a></li>
                        <li><a href="index.php?act=order_history" class="btn btn-link">Lịch sử đơn hàng</a></li>
                        <li><a href="index.php?act=profile" class="btn btn-link">Đổi mật khẩu</a></li>
                        <li><a href="index.php?act=logout" class="btn btn-link text-danger">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-md-9">
            <h3 class="text-center pb-4">Cập nhật thông tin cá nhân</h3>
            <form method="POST" action="" class="form-horizontal">
                <div class="form-group">
                    <label for="hoTen">Họ tên:</label>
                    <input type="text" name="hoTen" id="hoTen" class="form-control"
                        value="<?php echo $userData['TEN']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?php echo $userData['EMAIL']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="soDienThoai">Số điện thoại:</label>
                    <input type="text" name="soDienThoai" id="soDienThoai" class="form-control"
                        value="<?php echo $userData['SDT']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="diaChi">Địa chỉ:</label>
                    <input type="text" name="diaChi" id="diaChi" class="form-control"
                        value="<?php echo $userData['DIACHI']; ?>" required>
                </div>
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('layout/footer.php'); ?>