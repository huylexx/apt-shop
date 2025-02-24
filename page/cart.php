<div class="hero_area">
    <!-- header section strats -->
    <?php include('layout/header.php'); ?>
    <!-- end header section -->

    <?php
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];

        $tongTien = 0;

        $sql = "SELECT xe.*, giohang.* FROM giohang JOIN xe ON giohang.MA_XE = xe.MA_XE WHERE ID_USER = $userId";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $tong_sp = mysqli_num_rows($result);

            ?>
            <section class="h-100 gradient-custom mt-5">
                <form action="index.php?act=cart" method="post">
                    <div class="container py-5">
                        <div class="row d-flex justify-content-center my-4">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-header py-3">
                                        <h5 class="mb-0">Giỏ hàng - <?php echo $tong_sp ?> sản phẩm</h5>
                                    </div>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                                    <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                                        data-mdb-ripple-color="light">
                                                        <a href="index.php?act=detail&id=<?php echo $row['MA_XE']; ?>">
                                                            <img src="./admin/images/uploads/<?php echo $row["HINH_ANH"]; ?>"
                                                                class="w-100" alt="<?php echo $row['TEN_XE']; ?>" />
                                                        </a>
                                                        <a href="#!">
                                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)">
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                                    <p><strong><?php echo $row['TEN_XE']; ?></strong></p>
                                                    <p>Hãng: <?php echo $row['NHA_SX']; ?></p>
                                                    <p>Loại hàng: <?php echo $row['LOAI_HANG']; ?></p>
                                                    <p>Ngày thêm: <?php echo $row['NGAY_THEM']; ?></p>
                                                    <a href="index.php?act=cart&product_id=<?php echo $row['MA_XE']; ?>">
                                                        <i class="fas fa-trash"></i></a>
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                                    <!-- Quantity -->
                                                    <div class="d-flex mb-4 align-items-center" style="max-width: 300px;">
                                                        <div class="px-2 form-outline">
                                                            <input name="quantity[<?php echo $row['MA_XE']; ?>]"
                                                                value="<?php echo $row['SO_LUONG']; ?>" type="number" min="1"
                                                                class="form-control text-center" />

                                                        </div>
                                                    </div>

                                                    <!-- Price -->
                                                    <p class="text-start text-md-center">
                                                        <strong id="price-<?php echo $row['MA_XE']; ?>">
                                                            <?php echo number_format($row['GIA'] * $row['SO_LUONG']); ?> VND
                                                        </strong>
                                                    </p>
                                                </div>
                                                <?php
                                                $tongTien_sp = $row['GIA'] * $row['SO_LUONG'];
                                                $tongTien += $tongTien_sp;
                                                ?>

                                            </div>
                                            <!-- Single item -->

                                            <hr class="my-4" />

                                        </div>
                                    <?php } ?>
                                    <div class="d-flex justify-content-end p-4">
                                        <button type="submit" class="btn btn-primary" name="update_cart">Cập nhật giỏ
                                            hàng</button>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['product_id'])) {
                                    $product_id = $_GET['product_id'];
                                    $sql_remove = "DELETE FROM giohang WHERE MA_XE = $product_id AND ID_USER = $userId";
                                    $result_remove = mysqli_query($connect, $sql_remove);

                                    if ($result_remove) {
                                        echo "<script>alert('Sản phẩm đã được xóa khỏi giỏ hàng!');</script>";
                                        echo "<script>window.location='index.php?act=cart';</script>";
                                    } else {
                                        echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại!');</script>";
                                    }
                                }

                                if (isset($_POST['update_cart'])) {
                                    if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
                                        foreach ($_POST['quantity'] as $product_id => $quantity) {
                                            $product_id = mysqli_real_escape_string($connect, $product_id);
                                            $quantity = intval($quantity);

                                            $update_cart = "UPDATE giohang 
                                                            SET SO_LUONG = $quantity
                                                            WHERE MA_XE = '$product_id' AND ID_USER = '$userId'";

                                            if (!mysqli_query($connect, $update_cart)) {
                                                die("Lỗi khi cập nhật giỏ hàng: " . mysqli_error($connect));
                                            }
                                        }
                                        echo "<script>window.location='index.php?act=cart';</script>";
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header py-3 text-center">
                                        <h5 class="mb-0">Hoá đơn</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <?php
                                            $query = "SELECT xe.*, giohang.* FROM giohang JOIN xe ON giohang.MA_XE = xe.MA_XE WHERE ID_USER = $userId";
                                            $result_total = mysqli_query($connect, $query);
                                            if (mysqli_num_rows($result_total) > 0) {
                                                while ($row = mysqli_fetch_assoc($result_total)) {
                                                    ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                        <?php echo $row['TEN_XE']; ?>
                                                        <span><?php echo number_format($row['GIA']); ?> VND</span>
                                                    </li>
                                                    <?php
                                                }
                                            } else {
                                                echo "<li class='list-group-item'>Không có sản phẩm nào.</li>";
                                            }
                                            ?>

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                                <div>
                                                    <strong>Tổng tiền</strong>
                                                </div>
                                                <span>
                                                    <strong>
                                                        <?php
                                                        echo number_format($tongTien);
                                                        ?> VND
                                                    </strong>
                                                </span>
                                            </li>
                                        </ul>
                                        <a href="index.php?act=checkout&id=<?php echo $userId; ?>">
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-lg btn-block">
                                                Thanh toán
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <?php
        } else {
            echo "<div class='text-center pt-5 p-5 mt-5'>";
            echo "<img src='images/cart-empty.png' width='20%' alt='Giỏ hàng trống'>";
            echo "<h3>Giỏ hàng của bạn hiện đang trống!!</h3>";
            echo "</div>";
        }
    } else {
        echo "<script>alert('Bạn cần đăng nhập để xem giỏ hàng!');</script>";
        echo "<script>window.location='index.php?act=login';</script>";
        exit;
    }
    ?>

    <?php include('layout/footer.php'); ?>

</div>