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
              <li class="breadcrumb-item"><a href="index.php?act=pay">Hóa đơn</a></li>
              <li class="breadcrumb-item active" aria-current="page">Thêm hóa đơn</li>
            </ol>
          </nav>
        </div>
        <?php
        $error = [];

        if (isset($_POST['Them'])) {
          $id_user = $_POST['id_user'];
          $ngay_lap_hd = $_POST['ngay_lap_hd'];
          $phuong_thuc_tt = $_POST['phuong_thuc_tt'];
          $trang_thai = $_POST['trang_thai'];
          $tong_so_luong = $_POST['tong_so_luong'];
          $ho_ten = $_POST['ho_ten'];
          $email = $_POST['email'];
          $sdt = $_POST['sdt'];
          $dia_chi = $_POST['dia_chi'];

          if (empty($id_user)) {
            $error['id_user'] = "*ID người dùng không được để trống";
          }
          if (empty($ngay_lap_hd)) {
            $error['ngay_lap_hd'] = "*Ngày lập hóa đơn không được để trống";
          }
          if (empty($phuong_thuc_tt)) {
            $error['phuong_thuc_tt'] = "*Phương thức thanh toán không được để trống";
          }
          if (empty($trang_thai)) {
            $error['trang_thai'] = "*Trạng thái không được để trống";
          }
          if (empty($tong_so_luong) || $tong_so_luong < 0) {
            $error['tong_so_luong'] = "*Số lượng không hợp lệ";
          }
          if (empty($ho_ten)) {
            $error['ho_ten'] = "*Họ tên không được để trống";
          }
          if (empty($email)) {
            $error['email'] = "*Email không được để trống";
          }
          if (empty($sdt)) {
            $error['sdt'] = "*Số điện thoại không được để trống";
          }
          if (empty($dia_chi)) {
            $error['dia_chi'] = "*Địa chỉ không được để trống";
          }

          if (empty($error)) {
            $insert_hoadon = "INSERT INTO hoadon (ID_USER, NGAY_LAP_HD, PHUONG_THUC_THANH_TOAN, TRANG_THAI, TONG_SO_LUONG, HOTEN, EMAIL, SDT, DIACHI) 
            VALUES ('$id_user', '$ngay_lap_hd', '$phuong_thuc_tt', '$trang_thai', $tong_so_luong, '$ho_ten', '$email', '$sdt', '$dia_chi')";

            mysqli_query($connect, $insert_hoadon);
            echo "<script>alert('Thêm hóa đơn thành công!!'); </script>";
          }
        }
        ?>

        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Thêm hóa đơn mới</h4>
                <form class="forms-sample" method="POST" action="index.php?act=add-pay">
                  <div class="form-group">
                    <label for="id_user">ID người dùng</label>
                    <input type="text" class="form-control" id="id_user" name="id_user" placeholder="ID người dùng...">
                    <?php if (isset($error['id_user'])) {
                      echo "<span class='text-danger'> " . $error['id_user'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="ngay_lap_hd">Ngày lập hóa đơn</label>
                    <input type="date" class="form-control" id="ngay_lap_hd" name="ngay_lap_hd"
                      placeholder="Ngày lập...">
                    <?php if (isset($error['ngay_lap_hd'])) {
                      echo "<span class='text-danger'> " . $error['ngay_lap_hd'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="phuong_thuc_tt">Phương thức thanh toán</label>
                    <select class="form-control" id="phuong_thuc_tt" name="phuong_thuc_tt">
                      <option value="">--Chọn phương thức thanh toán--</option>
                      <option value="1">Thanh toán khi nhận hàng</option>
                    </select>
                    <?php if (isset($error['phuong_thuc_tt'])) {
                      echo "<span class='text-danger'> " . $error['phuong_thuc_tt'] . " </span>";
                    } ?>
                  </div>

                  <div class="form-group">
                    <label for="trang_thai">Trạng thái</label>
                    <select class="form-control" name="trang_thai" id="trang_thai">
                      <option value="">--Chọn trạng thái--</option>
                      <option value="2">Đã duyệt</option>
                      <option value="1">Đang chờ duyệt</option>
                    </select>
                    <?php if (isset($error['trang_thai'])) {
                      echo "<span class='text-danger'> " . $error['trang_thai'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="tong_so_luong">Tổng số lượng</label>
                    <input type="number" class="form-control" id="tong_so_luong" name="tong_so_luong"
                      placeholder="Tổng số lượng...">
                    <?php if (isset($error['tong_so_luong'])) {
                      echo "<span class='text-danger'> " . $error['tong_so_luong'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="ho_ten">Họ tên</label>
                    <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                      placeholder="Họ tên khách hàng...">
                    <?php if (isset($error['ho_ten'])) {
                      echo "<span class='text-danger'> " . $error['ho_ten'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email khách hàng...">
                    <?php if (isset($error['email'])) {
                      echo "<span class='text-danger'> " . $error['email'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" name="sdt"
                      placeholder="Số điện thoại khách hàng...">
                    <?php if (isset($error['sdt'])) {
                      echo "<span class='text-danger'> " . $error['sdt'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="dia_chi">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi"
                      placeholder="Địa chỉ khách hàng...">
                    <?php if (isset($error['dia_chi'])) {
                      echo "<span class='text-danger'> " . $error['dia_chi'] . " </span>";
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
        function Huy() {
          window.location = "index.php?act=pay";
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