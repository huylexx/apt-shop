<div class="hero_area">
  <!-- header section strats -->
  <?php include('layout/header.php'); ?>
  <!-- end header section -->

</div>
<!-- end hero area -->

<!-- shop section -->

<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Tất cả sản phẩm
      </h2>
    </div>
    <div class="row">
      <?php while ($row = mysqli_fetch_array($all_product)) { ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="index.php?act=detail&id=<?php echo $row['MA_XE']; ?>">
              <div class="img-box">
                <img src="./admin/images/uploads/<?php echo $row["HINH_ANH"]; ?>" alt="<?php $row["TEN_XE"]; ?>">
              </div>
              <div class="detail-box text-center">
                <div class="row">
                  <h6 class="col-sm-12">
                    <?php echo $row['TEN_XE']; ?>
                  </h6>
                  <h6 class="col-sm-12">
                    Giá:
                    <span><?php $formattedNumber = number_format($row['GIA']);
                    echo $formattedNumber; ?></span>
                  </h6>
                </div>
              </div>
              <div class="new">
                <span>
                  <?php echo $row['LOAI_HANG']; ?>
                </span>
              </div>
              <form method="POST" action="">
                <input type="hidden" name="ma_xe" value="<?php echo $row['MA_XE']; ?>">
                <button type="submit" name="add_to_cart" class="btn btn-primary w-100 mt-3">Thêm vào giỏ
                  hàng</button>
              </form>
            </a>
          </div>
        </div>
      <?php } ?>
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
    </div>
  </div>
</section>

<!-- end shop section -->

<!-- info section -->

<?php include('layout/footer.php'); ?>

<!-- end info section --> 