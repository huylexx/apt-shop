<style>
  .cart-badge {
    display: inline-block;
    padding: 5px 10px;
    font-size: 14px;
    font-weight: bold;
    color: white;
    background-color: red;
    border-radius: 50%;
    min-width: 25px;
    height: 25px;
    text-align: center;
    line-height: 25px;
    box-sizing: border-box;
    position: relative;
  }

  .cart-badge:empty {
    display: none;
  }
</style>
<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container fixed-top">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=home">Trang chủ <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=shop">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=about">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=contact">Liên hệ</a>
                </li>
            </ul>

            <div class="user_option">

                <form id="search-form" class="form-inline" action="index.php?act=search" method="POST">
                    <input class="form-control" type="search" name="search_value" placeholder="Tìm kiếm..." required
                        aria-label="Tìm kiếm">
                        <button class="btn mr-4" type="submit" name="search">Tìm</button>
                    </form>
                    <?php
                    
                    if (isset($_POST['search'])) {
                        $search_value = $_POST['search_value'];

                        $search_product = mysqli_query($connect, "SELECT * FROM xe WHERE TEN_XE LIKE '%$search_value%' OR NHA_SX LIKE '%$search_value%' ORDER BY RAND()");
                    }
                ?>

                <?php

                if (isset($_SESSION['user'])) {
                    $userId = $_SESSION['user'];

                    $login = "SELECT * FROM taikhoan WHERE ID_USER = $userId";

                    $result = mysqli_query($connect, $login);

                    if ($result) {
                        $user = mysqli_fetch_assoc($result);
                        if (isset($user['TENDANGNHAP'])) {
                            echo '<i class="fa fa-user" aria-hidden="true"></i> &nbsp <a href="index.php?act=profile"><span>' . $user['TENDANGNHAP'] . ' &nbsp</span></a>';
                            echo '<span><a href="index.php?act=logout"> Đăng xuất </a></span>';
                        }
                    }
                } else {
                    echo '<a href="index.php?act=login"><i class="fa fa-user" aria-hidden="true"></i><span>Đăng nhập</span></a>';
                }
                ?>

                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="index.php?act=cart" class="cart-icon">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <?php
                        $cart_count_query = "SELECT SUM(SO_LUONG) AS total_products FROM giohang WHERE ID_USER = $userId";
                        $cart_result = mysqli_query($connect, $cart_count_query);
                        $cart_count = 0;
                        if ($cart_result) {
                            $cart_data = mysqli_fetch_assoc($cart_result);
                            if (isset($cart_data['total_products'])) {
                                $cart_count = $cart_data['total_products'];
                            }
                        }
                        if ($cart_count > 0) {
                            echo '<span class="cart-badge">' . $cart_count . '</span>';
                        }
                        ?>
                    </a>
                <?php } else { ?>

                    <a href="index.php?act=cart">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    </a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>