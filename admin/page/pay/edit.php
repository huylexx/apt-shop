<?php
if (isset($_GET['id'])) {
  $invoice_id = $_GET['id'];

  // Lấy thông tin hóa đơn
  $query = "SELECT * FROM hoadon WHERE MA_HD = $invoice_id";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $invoice = mysqli_fetch_assoc($result);
  } else {
    echo "<script>alert('Hóa đơn không tồn tại');</script>";
    exit;
  }
}

if (isset($_POST['Capnhat'])) {
  // Lấy dữ liệu từ form
  $ten_khach_hang = $_POST['ten_khach_hang'];
  $ngay_lap = $_POST['ngay_lap'];
  $phuong_thuc = $_POST['phuong_thuc'];
  $trang_thai = $_POST['trang_thai'];
  $email = $_POST['email'];
  $sdt = $_POST['sdt'];
  $dia_chi = $_POST['dia_chi'];

  // Cập nhật thông tin hóa đơn
  $update_sql = "UPDATE hoadon SET 
                        HOTEN = '$ten_khach_hang',
                        NGAY_LAP_HD = '$ngay_lap',
                        PHUONG_THUC_THANH_TOAN = '$phuong_thuc',
                        TRANG_THAI = '$trang_thai',
                        EMAIL = '$email',
                        SDT = '$sdt',
                        DIACHI = '$dia_chi'
                        WHERE MA_HD = $invoice_id";

  if (mysqli_query($connect, $update_sql)) {
    echo "
      <script>
        alert('Cập nhật thành công!!!');
        window.location.href = 'index.php?act=pay';
    </script>
    ";
  } else {
    echo "<script>alert('Cập nhật thất bại: " . mysqli_error($connect) . "');</script>";
  }
}
?>

<div class="container-scroller">
  <!-- partial:../../partials/_navbar.html -->
  <?php include('layout/header.php'); ?>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
    <?php include('layout/sidebar.php'); ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php?act=pay">Hóa đơn</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sửa hóa đơn</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Sửa thông tin hóa đơn</h4>
                <form class="forms-sample" method="POST" action="index.php?act=edit-pay&id=<?php echo $invoice_id; ?>">
                  <div class="form-group">
                    <label for="ten_khach_hang">Tên khách hàng</label>
                    <input type="text" class="form-control" id="ten_khach_hang" name="ten_khach_hang"
                      value="<?php echo $invoice['HOTEN']; ?>" placeholder="Tên khách hàng...">
                  </div>
                  <div class="form-group">
                    <label for="ngay_lap">Ngày lập hóa đơn</label>
                    <input type="date" class="form-control" id="ngay_lap" name="ngay_lap"
                      value="<?php echo $invoice['NGAY_LAP_HD']; ?>" placeholder="Ngày lập...">
                  </div>
                  <div class="form-group">
                    <label for="phuong_thuc">Phương thức thanh toán</label>
                    <select class="form-control" id="phuong_thuc" name="phuong_thuc">
                      <option value="1" <?php echo $invoice['PHUONG_THUC_THANH_TOAN'] == 1 ? 'selected' : ''; ?>>Thanh toán khi nhận hàng</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="trang_thai">Trạng thái</label>
                    <select class="form-control" id="trang_thai" name="trang_thai">
                      <option value="1" <?php echo $invoice['TRANG_THAI'] == '1' ? 'selected' : ''; ?>>Đang chờ duyệt</option>
                      <option value="2" <?php echo $invoice['TRANG_THAI'] == '2' ? 'selected' : ''; ?>>Đã duyệt</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                      value="<?php echo $invoice['EMAIL']; ?>" placeholder="Email...">
                  </div>
                  <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" name="sdt"
                      value="<?php echo $invoice['SDT']; ?>" placeholder="Số điện thoại...">
                  </div>
                  <div class="form-group">
                    <label for="dia_chi">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi"
                      value="<?php echo $invoice['DIACHI']; ?>" placeholder="Địa chỉ...">
                  </div>
                  <button type="submit" class="btn btn-gradient-primary me-2" name="Capnhat">Cập nhật</button>
                  <button type="reset" class="btn btn-light" onclick="Huy()">Huỷ</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        function Huy() {
          window.location = "index.php?act=pay";
        }
      </script>
      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      <?php include('layout/footer.php'); ?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
