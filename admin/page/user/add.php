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
              <li class="breadcrumb-item"><a href="index.php?act=user">Người dùng</a></li>
              <li class="breadcrumb-item active" aria-current="page">Thêm người dùng</li>
            </ol>
          </nav>
        </div>
        <?php
        $error = [];

        if (isset($_POST['Them'])) {
          $ho_ten = $_POST['ho_ten'];
          $ten_dn = $_POST['ten_dn'];
          $mat_khau = $_POST['mat_khau'];
          $email = $_POST['email'];
          $cccd = $_POST['cccd'];
          $sdt = $_POST['sdt'];
          $vai_tro = $_POST['vai_tro'];

          if (empty($ho_ten)) {
            $error['ho_ten'] = "*Họ tên không được để trống";
          }

          if (empty($ten_dn)) {
            $error['ten_dn'] = "*Tên đăng nhập không được để trống";
          }
          if (empty($error)) {
            $sql_check_ten_dn = "SELECT * FROM taikhoan WHERE TENDANGNHAP = '$ten_dn'";
            $result_check_ten_dn = mysqli_query($connect, $sql_check_ten_dn);
            if (mysqli_num_rows($result_check_ten_dn) > 0) {
              $error['ten_dn'] = "*Tên đăng nhập đã tồn tại";
            }
          }

          if (empty($mat_khau)) {
            $error['mat_khau'] = "*Mật khẩu không được để trống";
          }
          if (empty($email)) {
            $error['email'] = "*Email không được để trống";
          } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "*Email không đúng định dạng";
          }

          if (empty($cccd)) {
            $error['cccd'] = "*CCCD không được để trống";
          }
          if (empty($error)) {
            $sql_check_cccd = "SELECT * FROM taikhoan WHERE CCCD = '$cccd'";
            $result_check_cccd = mysqli_query($connect, $sql_check_cccd);
            if (mysqli_num_rows($result_check_cccd) > 0) {
              $error['cccd'] = "*CCCD này đã tồn tại";
            }
          }

          if (empty($sdt)) {
            $error['sdt'] = "*Số điện thoại không được để trống";
          }
          if (empty($vai_tro)) {
            $error['vai_tro'] = "*Vai trò không được để trống";
          }


          if (empty($error)) {
            $insert_user = "INSERT INTO taikhoan (TEN, TENDANGNHAP, MATKHAU, EMAIL, CCCD, SDT, VAI_TRO) 
                            VALUES ('$ho_ten', '$ten_dn', '$mat_khau', '$email', '$cccd', '$sdt', '$vai_tro')";

            if (mysqli_query($connect, $insert_user)) {
              echo "
              <script>
              alert('Thêm người dùng thành công!!')
              window.location = 'https://huylexx.id.vn/admin/index.php?act=user';
              </script>";
            } else {
              echo "<script>alert('Lỗi khi thêm người dùng!')</script>";
            }
          }
        }
        ?>

        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Thêm người dùng mới</h4>
                <form class="forms-sample" method="POST" action="index.php?act=add-user">
                  <div class="form-group">
                    <label for="ho_ten">Họ tên</label>
                    <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Họ tên...">
                    <?php if (isset($error['ho_ten'])) {
                      echo "<span class='text-danger'> " . $error['ho_ten'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="ten_dn">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="ten_dn" name="ten_dn" placeholder="Tên đăng nhập...">
                    <?php if (isset($error['ten_dn'])) {
                      echo "<span class='text-danger'> " . $error['ten_dn'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="mat_khau">Mật khẩu</label>
                    <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Mật khẩu...">
                    <?php if (isset($error['mat_khau'])) {
                      echo "<span class='text-danger'> " . $error['mat_khau'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email...">
                    <?php if (isset($error['email'])) {
                      echo "<span class='text-danger'> " . $error['email'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="cccd">CCCD</label>
                    <input type="text" class="form-control" id="cccd" name="cccd" placeholder="CCCD...">
                    <?php if (isset($error['cccd'])) {
                      echo "<span class='text-danger'> " . $error['cccd'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Số điện thoại...">
                    <?php if (isset($error['sdt'])) {
                      echo "<span class='text-danger'> " . $error['sdt'] . " </span>";
                    } ?>
                  </div>
                  <div class="form-group">
                    <label for="vai_tro">Vai trò</label>
                    <select class="form-control" id="vai_tro" name="vai_tro">
                      <option value="">-- Chọn vai trò --</option>
                      <option value="2">Người dùng</option>
                      <option value="1">Quản trị viên</option>
                    </select>
                    <?php if (isset($error['vai_tro'])) {
                      echo "<span class='text-danger'> " . $error['vai_tro'] . " </span>";
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
          window.location = "https://huylexx.id.vn/admin/index.php?act=user";
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