<?php

$id = $_GET['id']; 

$sql = "SELECT * FROM xe WHERE MA_XE = $id";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Sản phẩm không tồn tại.";
}
?>
<div class="hero_area">
  <!-- header section starts -->
  <?php include('layout/header.php'); ?>
  <!-- end header section -->
</div>
<!-- end hero area -->

<div class="container product-detail mb-5 py-5" style="background-color: #fff; border-radius: 15px; margin-top: 100px; box-shadow: 5px 10px 30px rgba(0, 0, 0, 0.1); padding-top: 200px;">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="./admin/images/uploads/<?php echo $row['HINH_ANH']; ?>" alt="<?php echo $row['TEN_XE']; ?>" class="img-fluid rounded-lg shadow-sm" style="max-height: 400px; object-fit: cover; border-radius: 15px;">
        </div>
        <div class="col-md-6" style="padding-left: 30px;">
            <h1 class="product-title" style="font-size: 2.5rem; font-weight: 700; color: #333; margin-bottom: 20px; line-height: 1.3;"><?php echo $row['TEN_XE']; ?></h1>
            <p class="lead" style="font-size: 1.1rem; color: #666; margin-bottom: 12px; line-height: 1.8;"><strong>Phân khối:</strong> <?php echo $row['PHAN_KHOI_XE']; ?>cc</p>
            <p style="font-size: 1.1rem; color: #666; margin-bottom: 12px; line-height: 1.8;"><strong>Nhà sản xuất:</strong> <?php echo $row['NHA_SX']; ?></p>
            <p style="font-size: 1.1rem; color: #666; margin-bottom: 12px; line-height: 1.8;"><strong>Năm sản xuất:</strong> <?php echo $row['NAM_SX']; ?></p>
            <p style="font-size: 1.1rem; color: #666; margin-bottom: 12px; line-height: 1.8;"><strong>Giá:</strong> <?php echo number_format($row['GIA'], 0, ',', '.'); ?> VND</p>
            <p style="font-size: 1.1rem; color: #666; margin-bottom: 12px; line-height: 1.8;"><strong>Loại xe:</strong> <?php echo $row['LOAI_XE']; ?></p>
            <p style="font-size: 1.1rem; color: #666; margin-bottom: 12px; line-height: 1.8;"><strong>Số lượng còn:</strong> <?php echo $row['SO_LUONG_CO']; ?> chiếc</p>
            <p style="font-size: 1.1rem; color: #666; margin-bottom: 20px; line-height: 1.8;"><strong>Loại hàng:</strong> <?php echo $row['LOAI_HANG']; ?></p>
            <form method="POST" action="">
                            <input type="hidden" name="ma_xe" value="<?php echo $row['MA_XE']; ?>">
            <button type="submit" href="index.php?act=cart&product_id=<?php echo $row['MA_XE']; ?>" name="add_to_cart" class="btn btn-primary btn-lg purchase-btn" style="background-color: #007bff; color: white; font-size: 1.3rem; padding: 12px 30px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3); transition: background-color 0.3s, transform 0.3s; display: inline-block;">
                Mua ngay
            </button>
        </form>
        </div>
    </div>
</div>
<?php
        if (isset($_POST['add_to_cart'])) {
            $product_id = $_POST['ma_xe'];
            $userId = $_SESSION['user'];

            $sql = "SELECT * FROM giohang WHERE ID_USER = $userId AND MA_XE = $product_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $sql = "UPDATE giohang SET SO_LUONG = SO_LUONG + 1 WHERE ID_USER = $userId AND MA_XE = $product_id";
                $connect->query($sql);
            } else {
                $sql = "INSERT INTO giohang (ID_USER, MA_XE, SO_LUONG, NGAY_THEM) VALUES ($userId, $product_id, 1, NOW())";
                $connect->query($sql);
            }

            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng');</script>";
            echo "<script>window.location = 'https://huylexx.id.vn/index.php?act=cart'</script>";
        }
        ?>

<!-- info section -->
<?php include('layout/footer.php'); ?>
<!-- end info section -->
