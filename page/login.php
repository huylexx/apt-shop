<div class="hero_area">
    <!-- header section strats -->
    <?php include('layout/header.php'); ?>
    <!-- end header section -->

</div>
<!-- end hero area -->

<!-- login section -->

<div class="login_section layout_padding" style="background: linear-gradient(to right, #f89cab, #f74d95)">
    <div class="container pt-2" style="display: flex; justify-content: center; ">
        <form action="index.php?act=login" method="POST">
            <div class="box-login p-5 mt-5"
                style="border-radius: 15px; background-color: white; box-shadow: 0px 3px 10px 2px black; width: 500px;">
                <h2 align="center">Đăng nhập</h2>
                <?php
                if (isset($_POST['login'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $login = "SELECT * FROM taikhoan WHERE TENDANGNHAP = '$username' AND MATKHAU = '$password'";
                    $result = mysqli_query($connect, $login);

                    if (mysqli_num_rows($result) > 0) {
                        $user = mysqli_fetch_assoc($result);

                        $_SESSION["user"] = $user["ID_USER"];
                        echo "<script>window.location = 'https://huylexx.id.vn/index?act=home'</script>";
                    } else {
                        echo "<div class='text-danger text-center p-1 mt-3'><i class='fa-solid fa-circle-exclamation'></i> Tài khoản hoặc mật khẩu không đúng!!</div>";
                    }
                }
                ?>
                <div class="username pt-2">
                    <label for="username">Tên đăng nhập: </label>
                    <div><input class="form-control" type="text" name="username" id="username" size="30" required></div>
                </div>
                <br>
                <div class="password">
                    <label for="password">Mật khẩu: </label>
                    <div><input class="form-control" type="password" name="password" id="password" size="30" required>
                    </div>
                </div>
                <div class=" d-flex justify-content-center"><button class="btn btn-primary mt-4 mb-4" type="submit"
                        name="login">Đăng nhập</button></div>
                <div class="pt-2" align="center"><a href="index.php?act=register">Đăng ký</a> nếu chưa có tài khoản
                </div>
                <div class="social_container d-flex justify-content-center pt-4">
                    <div class="social_box">
                        <a href="https://www.facebook.com/">
                            <i class="fa fa-facebook p-3" aria-hidden="true"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="https://www.google.com.vn/?hl=vi">
                            <i class="fa fa-google p-3" aria-hidden="true"></i>
                            <span>Google</span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
    </form>

</div>

<!-- end login section -->

<!-- info section -->

<?php include('layout/footer.php'); ?>

<!-- end info section -->