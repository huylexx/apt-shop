<?php
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  $query = "SELECT * FROM xe WHERE MA_XE = $product_id";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
  } else {
    echo "<script>alert('Sản phẩm không tồn tại');</script>";
    exit;
  }
}

if (isset($_POST['Capnhat'])) {
  $ten_sp = $_POST['ten_sp'];
  $phan_khoi = $_POST['phan_khoi'];
  $nha_sx = $_POST['nha_sx'];
  $nam_sx = $_POST['nam_sx'];
  $gia = $_POST['gia'];
  $loai_xe = $_POST['loai_xe'];
  $so_luong_co = $_POST['so_luong_co'];
  $loai_hang = $_POST['loai_hang'];

  if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
    $hinh_anh = $_FILES['hinh_anh']['name'];
    $target_dir = "images/uploads/";
    $target_file = $target_dir . basename($_FILES['hinh_anh']['name']);

    if (move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $target_file)) {
      $update_sql = "UPDATE xe SET 
                            TEN_XE = '$ten_sp',
                            PHAN_KHOI_XE = '$phan_khoi',
                            NHA_SX = '$nha_sx',
                            NAM_SX = '$nam_sx',
                            GIA = $gia,
                            LOAI_XE = '$loai_xe',
                            SO_LUONG_CO = $so_luong_co,
                            HINH_ANH = '$hinh_anh',
                            LOAI_HANG = '$loai_hang'
                            WHERE MA_XE = $product_id";
    } else {
      echo "<script>alert('Lỗi khi tải lên hình ảnh');</script>";
    }
  } else {
    $update_sql = "UPDATE xe SET 
                        TEN_XE = '$ten_sp',
                        PHAN_KHOI_XE = '$phan_khoi',
                        NHA_SX = '$nha_sx',
                        NAM_SX = '$nam_sx',
                        GIA = $gia,
                        LOAI_XE = '$loai_xe',
                        SO_LUONG_CO = $so_luong_co,
                        LOAI_HANG = '$loai_hang'
                        WHERE MA_XE = $product_id";
  }

  if (mysqli_query($connect, $update_sql)) {
    echo "
      <script>
        alert('Cập nhật thành công!!!');
        window.location.href = 'index.php?act=edit-product&id=" . $product_id . "';
    </script>
    ";
  } else {
    echo "<script>alert('Cập nhật thất bại: " . mysqli_error($connect) . "');</script>";
  }
}
?>

<div class="container-scroller">
  <!-- partial:../../partials/_navbar.html -->
  <?php
  include('layout/header.php');
  ?>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
    <?php
    include('layout/sidebar.php');
    ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php?act=product">Sản phẩm</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Sửa thông tin sản phẩm</h4>
                <form class="forms-sample" method="POST" enctype="multipart/form-data"
                  action="index.php?act=edit-product&id=<?php echo $product_id; ?>">
                  <div class="form-group">
                    <label for="ten_sp">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="ten_sp" name="ten_sp"
                      value="<?php echo $product['TEN_XE']; ?>" placeholder="Tên sản phẩm...">
                  </div>
                  <div class="form-group">
                    <label for="phan_khoi">Phân khối xe</label>
                    <input type="text" class="form-control" id="phan_khoi" name="phan_khoi"
                      value="<?php echo $product['PHAN_KHOI_XE']; ?>" placeholder="Phân khối xe...">
                  </div>
                  <div class="form-group">
                    <label for="nha_sx">Nhà sản xuất</label>
                    <input type="text" class="form-control" id="nha_sx" name="nha_sx"
                      value="<?php echo $product['NHA_SX']; ?>" placeholder="Nhà sản xuất...">
                  </div>
                  <div class="form-group">
                    <label for="nam_sx">Năm sản xuất</label>
                    <input type="text" class="form-control" id="nam_sx" name="nam_sx"
                      value="<?php echo $product['NAM_SX']; ?>" placeholder="Năm sản xuất...">
                  </div>
                  <div class="form-group">
                    <label for="gia">Giá</label>
                    <input type="number" class="form-control" id="gia" name="gia" value="<?php echo $product['GIA']; ?>"
                      placeholder="Giá...">
                  </div>
                  <div class="form-group">
                    <label for="loai_xe">Loại xe</label>
                    <input type="text" class="form-control" id="loai_xe" name="loai_xe"
                      value="<?php echo $product['LOAI_XE']; ?>" placeholder="Loại xe...">
                  </div>
                  <div class="form-group">
                    <label for="so_luong_co">Số lượng có</label>
                    <input type="number" class="form-control" id="so_luong_co" name="so_luong_co"
                      value="<?php echo $product['SO_LUONG_CO']; ?>" placeholder="Số lượng có...">
                  </div>
                  <div class="form-group">
                    <label for="hinh_anh">Hình ảnh</label>
                    <input type="file" class="form-control" id="hinh_anh" name="hinh_anh">
                    <img src="images/uploads/<?php echo $product['HINH_ANH']; ?>" alt="image" style="width: 30%;">
                  </div>
                  <div class="form-group">
                    <label for="loai_hang">Loại hàng</label>
                    <input type="text" class="form-control" id="loai_hang" name="loai_hang"
                      value="<?php echo $product['LOAI_HANG']; ?>" placeholder="Loại hàng...">
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
          window.location = "https://huylexx.id.vn/admin/index.php?act=product";
        }
      </script>
      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      <?php
      include('layout/footer.php');
      ?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>