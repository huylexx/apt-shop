<div class="hero_area">
  <!-- header section strats -->
  <?php include('layout/header.php'); ?>
  <!-- end header section -->

</div>
<!-- end hero area -->

<!-- register section -->

<div class="login_section layout_padding" style="background: linear-gradient(to right, #f89cab, #f74d95)">
  <div class="container pt-3">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration"
          style="border-radius: 15px; background-color: white; box-shadow: 0px 3px 10px 2px black;">
          <div class="card-body p-4 p-md-5">
            <h3 class="pb-md-0 mb-md-2 text-center">Đăng ký tài khoản</h3>
            <?php
            if (isset($_POST['register'])) {
              $fullname = $_POST['fullname'];
              $cccd = $_POST['CCCD'];
              $username_reg = $_POST['username_reg'];
              $password_reg = $_POST['password_reg'];
              $email_reg = $_POST['email_reg'];
              $phone_reg = $_POST['phone_reg'];


              $checked_acount = mysqli_query($connect, "SELECT * FROM taikhoan WHERE CCCD = '$cccd' OR TENDANGNHAP = '$username_reg'");

              if (mysqli_num_rows($checked_acount) == 0) {
                $register = "INSERT INTO taikhoan(TENDANGNHAP, CCCD, MATKHAU, TEN, SDT, EMAIL) VALUES ('$username_reg', '$cccd', '$password_reg', '$fullname', '$phone_reg', '$email_reg')";
                if (mysqli_query($connect, $register)) {
                  echo "<div class='text-success text-center p-1'><i class='fa-regular fa-circle-check'></i> Đăng ký thành công!!</div>";
                } else {
                  echo "<div class='text-danger text-center p-1'><i class='fa-solid fa-circle-exclamation'></i> Đăng ký không thành công!!</div>";
                }
              } else {
                echo "<div class='text-danger text-center p-1'><i class='fa-regular fa-circle-check'></i> CCCD hoặc tài khoản đã tồn tại!</div>";
              }
            }
            ?>
            <form class="mt-3" method="post" action="index.php?act=register">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="fullname" name="fullname" class="form-control form-control-lg" />
                    <label class="form-label" for="fullname">Họ và tên</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="CCCD" name="CCCD" class="form-control form-control-lg" />
                    <label class="form-label" for="CCCD">CCCD</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">
                  <div class="form-outline w-100">
                    <input type="text" class="form-control form-control-lg" name="username_reg" id="username_reg" />
                    <label for="username_reg" class="form-label">Tài khoản</label>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="password_reg" minlength="6" maxlength="20" name="password_reg" class="form-control form-control-lg" />
                    <label class="form-label" for="password_reg">Mật khẩu</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                  <div class="form-outline">
                    <input type="email" id="email_reg" name="email_reg" class="form-control form-control-lg" />
                    <label class="form-label" for="email_reg">Email</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4 pb-2">
                  <div class="form-outline">
                    <input type="tel" id="phone_reg" name="phone_reg" class="form-control form-control-lg" />
                    <label class="form-label" for="phone_reg">Số điện thoại</label>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-center">
                <button class="btn btn-primary mb-2" type="submit" name="register">Đăng ký</button>
              </div>

              <div class="d-flex justify-content-center pt-2">
                <a href="index.php?act=login">Đăng nhập</a> &nbsp;nếu đã có tài khoản
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- end register section -->

<!-- info section -->

<?php include('layout/footer.php'); ?>

<!-- end info section -->