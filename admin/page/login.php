<?php
  if(isset($_SESSION['user'])){
    $userId = $_SESSION['user'];

    $login = "SELECT * FROM taikhoan WHERE ID_USER = $userId";

    $result = mysqli_query($connect, $login);

    if($result){
      Header("Location: index.php?act=home");
    }
  }
?>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5">

            <h3 class="mb-5 text-center">Đăng nhập</h3>
            <form action="index.php?act=login" method="POST" >
            <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="typeEmailX-2">Tài khoản</label>
              <input type="text" id="typeEmailX-2" name="username" class="form-control form-control-lg" />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="typePasswordX-2">Mật khẩu</label>
              <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" />
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-start mb-4">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
              <label class="form-check-label" for="form1Example3"> Nhớ lại mật khẩu </label>
            </div>

            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" name="login" type="submit">Đăng nhập</button>

            </form>
            <?php 
              if(isset($_POST['login'])){
                $username = $_POST['username'];
                $password = $_POST['password'];

                $login = "SELECT * FROM taikhoan WHERE TENDANGNHAP = '$username' AND MATKHAU = '$password'";
                $result = mysqli_query($connect, $login);
                if(mysqli_num_rows($result) > 0){
                  $user = mysqli_fetch_assoc($result);
                  if($user['VAI_TRO'] == 1){
                    $_SESSION["user"] = $user["ID_USER"];
                    Header("Location: index.php?act=home");
                  }else{
                    echo "<div class='text-danger text-center p-1 mt-3'><i class='fa-solid fa-circle-exclamation'></i> Tài khoản này không có quyền truy cập!!</div>";
                  }
                }else{
                  echo "<div class='text-danger text-center p-1 mt-3'><i class='fa-solid fa-circle-exclamation'></i> Tài khoản hoặc mật khẩu không đúng!!</div>";
                }
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>