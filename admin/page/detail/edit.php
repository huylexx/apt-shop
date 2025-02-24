<?php
// Kiểm tra nếu có ID và MA_XE được truyền qua URL
if (isset($_GET['id']) && isset($_GET['ma_xe'])) {
  $ma_hd = $_GET['id'];
  $ma_xe = $_GET['ma_xe'];

  // Lấy thông tin chi tiết hóa đơn từ cơ sở dữ liệu
  $query = "SELECT * FROM cthd WHERE MA_HD = $ma_hd AND MA_XE = '$ma_xe'";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $cthd = mysqli_fetch_assoc($result);
  } else {
    echo "<script>alert('Không tìm thấy chi tiết hóa đơn này!'); window.location.href = 'index.php?act=detail-pay';</script>";
    exit;
  }
}

if (isset($_POST['Capnhat'])) {
  $ma_xe = $_POST['ma_xe'];
  $so_luong = $_POST['so_luong'];
  $gia_ban = $_POST['gia_ban'];

  // Lấy tổng số lượng trong hóa đơn
  $total_query = "SELECT SUM(SO_LUONG) AS total_quantity FROM cthd WHERE MA_HD = $ma_hd";
  $total_result = mysqli_query($connect, $total_query);
  $total_row = mysqli_fetch_assoc($total_result);
  $total_quantity = $total_row['total_quantity'];

  // Loại bỏ điều kiện kiểm tra giới hạn số lượng mới (không kiểm tra vượt quá tổng số lượng)
  // Cập nhật chi tiết hóa đơn
  $update_sql = "UPDATE cthd SET 
                  MA_XE = '$ma_xe', 
                  SO_LUONG = '$so_luong', 
                  GIA_BAN = '$gia_ban' 
                  WHERE MA_HD = $ma_hd AND MA_XE = '$ma_xe'";

  if (mysqli_query($connect, $update_sql)) {
    echo "
      <script>
        alert('Cập nhật thành công!!!');
        window.location.href = 'index.php?act=detail-pay';
      </script>
    ";
  } else {
    echo "<script>alert('Cập nhật thất bại: " . mysqli_error($connect) . "');</script>";
  }
}
?>

<div class="container-scroller">
  <?php include('layout/header.php'); ?>
  <div class="container-fluid page-body-wrapper">
    <?php include('layout/sidebar.php'); ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Chi tiết hóa đơn</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sửa chi tiết hóa đơn</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Sửa chi tiết hóa đơn</h4>
                <form class="forms-sample" method="POST" action="index.php?act=edit-detail-pay&id=<?php echo $ma_hd; ?>&ma_xe=<?php echo $ma_xe; ?>">
                  <div class="form-group">
                    <label for="ma_xe">Mã Xe</label>
                    <input type="text" class="form-control" id="ma_xe" name="ma_xe" value="<?php echo $cthd['MA_XE']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="so_luong">Số Lượng</label>
                    <input type="number" class="form-control" id="so_luong" name="so_luong" value="<?php echo $cthd['SO_LUONG']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="gia_ban">Giá Bán</label>
                    <input type="number" class="form-control" id="gia_ban" name="gia_ban" value="<?php echo $cthd['GIA_BAN']; ?>" required>
                  </div>
                  <button type="submit" class="btn btn-gradient-primary me-2" name="Capnhat">Cập nhật</button>
                  <a href="index.php?act=detail-pay" class="btn btn-light">Hủy</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>
</div>
