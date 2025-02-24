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
              <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
            </ol>
          </nav>
        </div>
        <?php
        $error = [];

        if (isset($_POST['Them'])) {
          $ten_sp = $_POST['ten_sp'];
          $phan_khoi = $_POST['phan_khoi'];
          $nha_sx = $_POST['nha_sx'];
          $nam_sx = $_POST['nam_sx'];
          $gia = $_POST['gia'];
          $loai_xe = $_POST['loai_xe'];
          $so_luong_co = $_POST['so_luong_co'];
          $loai_hang = $_POST['loai_hang'];

          if (empty($ten_sp)) {
            $error['ten_sp'] = "*Tên sản phẩm không được để trống";
          }
          if (empty($phan_khoi)) {
            $error['phan_khoi'] = "*Phân khối không được để trống";
          }
          if (empty($nha_sx)) {
            $error['nha_sx'] = "*Nhà sản xuất không được để trống";
          }
          if (empty($nam_sx)) {
            $error['nam_sx'] = "*Năm sản xuất không được để trống";
          }
          if (empty($gia) || $gia < 0) {
            $error['gia'] = "*Giá không được để trống";
          }
          if (empty($loai_xe)) {
            $error['loai_xe'] = "*Loại xe không được để trống";
          }
          if (empty($so_luong_co) || $so_luong_co < 0) {
            $error['so_luong_co'] = "*Tên sản phẩm không được để trống";
          }
          if (empty($loai_hang)) {
            $error['loai_hang'] = "*Loại hàng không được để trống";
          }

          $hinh_anh = "";
          if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
            $hinh_anh = $_FILES['hinh_anh']['name'];
            $target_dir = "images/uploads/";
            $target_file = $target_dir . basename($_FILES['hinh_anh']['name']);

            if (!move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $target_file)) {
              $error['hinh_anh'] = "*Lỗi khi tải lên hình ảnh!";
            }
          } else {
            $error['hinh_anh'] = "*Vui lòng chọn tệp hình ảnh!";
          }

          if (empty($error)) {
            $insert_products = "INSERT INTO xe (TEN_XE, PHAN_KHOI_XE, NHA_SX, NAM_SX, GIA, LOAI_XE, SO_LUONG_CO, HINH_ANH, LOAI_HANG) VALUES 
            ('$ten_sp', '$phan_khoi', '$nha_sx', '$nam_sx', $gia, '$loai_xe', $so_luong_co, '$hinh_anh', '$loai_hang')";

            mysqli_query($connect, $insert_products);
            echo "<script>alert('Thêm sản phẩm thành công!!')</script>";
          }
        }
        ?>

        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Thêm sản phẩm mới</h4>
                <form class="forms-sample" method="POST" enctype="multipart/form-data"
                  action="index.php?act=add-product">
                  <div class="form-group">
                    <label for="exampleInputUsername1">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" name="ten_sp"
                      placeholder="Tên sản phẩm...">
                    <?php if (isset($error['ten_sp'])) {
                      echo "<span class='text-danger'> " . $error['ten_sp'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phân khối xe</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="phan_khoi"
                      placeholder="Phân khối xe...">
                    <?php if (isset($error['phan_khoi'])) {
                      echo "<span class='text-danger'> " . $error['phan_khoi'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nhà sản xuất</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="nha_sx"
                      placeholder="Nhà sản xuất...">
                    <?php if (isset($error['nha_sx'])) {
                      echo "<span class='text-danger'> " . $error['nha_sx'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Năm sản xuất</label>
                    <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="nam_sx"
                      placeholder="Năm sản xuất...">
                    <?php if (isset($error['nam_sx'])) {
                      echo "<span class='text-danger'> " . $error['nam_sx'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Giá</label>
                    <input type="number" class="form-control" id="exampleInputConfirmPassword1" name="gia"
                      placeholder="Giá...">
                    <?php if (isset($error['gia'])) {
                      echo "<span class='text-danger'> " . $error['gia'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Loại xe</label>
                    <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="loai_xe"
                      placeholder="Loại xe...">
                    <?php if (isset($error['loai_xe'])) {
                      echo "<span class='text-danger'> " . $error['loai_xe'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Số lượng có</label>
                    <input type="number" class="form-control" id="exampleInputConfirmPassword1" name="so_luong_co"
                      placeholder="Số lượng có...">
                    <?php if (isset($error['so_luong_co'])) {
                      echo "<span class='text-danger'> " . $error['so_luong_co'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Hình ảnh</label>
                    <input type="file" class="form-control" id="exampleInputConfirmPassword1" name="hinh_anh">
                    <?php if (isset($error['hinh_anh'])) {
                      echo "<span class='text-danger'> " . $error['hinh_anh'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Loại hàng</label>
                    <select class="form-control" name="loai_hang" id="loai_hang">
                      <option value="">--Chọn loại hàng--</option>
                      <option value="Mới">Mới</option>
                      <option value="Nóng">Nóng</option>
                    </select>
                    <?php if (isset($error['loai_hang'])) {
                      echo "<span class='text-danger'> " . $error['loai_hang'] . " </span>";
                    } ?>
                  </div>
                  <button type="submit" class="btn btn-gradient-primary me-2" name="Them">Thêm</button>
                  <button type="reset" class="btn btn-light" onclick="Huy()">Huỷ</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        function Huy(){
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