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
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Quản lý sản phẩm</h4>
                <p class="card-description d-flex justify-content-end"><a href="index.php?act=add-product"><button
                      class="btn btn-primary" type="button">Thêm sản phẩm</button></a>
                </p>
                <?php
                  if (isset($_GET['id'])) {
                    $product_id = $_GET['id'];

                    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
                      $delete_sql = "DELETE FROM xe WHERE MA_XE = $product_id";
                      
                      if (mysqli_query($connect, $delete_sql)) {
                        echo "Xoá sản phẩm thành công!";
                      } else {
                        echo "Xoá không thành công!!!";
                      }
                    } else {
                      echo "<script>
                        var result = confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');
                        if (result) {
                          window.location.href = 'index.php?act=product&id=" . $product_id . "&confirm=yes';
                        } else {
                          window.location.href = 'index.php?act=product';
                        }
                      </script>";
                    }
                  }
                ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> Số thứ tự </th>
                      <th> Tên sản phẩm </th>
                      <th> Hình ảnh </th>
                      <th> Giá </th>
                      <th> Hãng sản xuất </th>
                      <th> Năm sản xuất </th>
                      <th> Số lượng có </th>
                      <th> Loại xe </th>
                      <th colspan="2" class="text-center">Thao tác</th>
                    </tr>
                  </thead>
                  <?php
                  $sql = "SELECT * FROM xe";
                  $result = mysqli_query($connect, $sql);
 
                  if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                      $stt = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $stt++ . "</td>";
                        echo "<td>" . $row['TEN_XE'] . "</td>";
                        echo "<td><img src='images/uploads/" . $row['HINH_ANH'] . "' alt='" . htmlspecialchars($row['TEN_XE']) . "' style='width: 50px; height: auto;'></td>";
                        echo "<td>" . number_format($row['GIA'], 0, ',', '.') . " VND</td>";
                        echo "<td>" . $row['NHA_SX'] . "</td>";
                        echo "<td>" . $row['NAM_SX'] . "</td>";
                        echo "<td>" . $row['SO_LUONG_CO'] . "</td>";
                        echo "<td>" . $row['LOAI_XE'] . "</td>";
                        echo "<td><a href='index.php?act=edit-product&id=" . $row['MA_XE'] . "'><button class='btn btn-success p-2'>Sửa</button></a></td>";
                        echo "<td><a href='index.php?act=product&id=" . $row['MA_XE'] . "'><button class='btn btn-danger p-2'>Xoá</button></a></td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='9'>Không có sản phẩm nào.</td></tr>";
                    }
                  } else {
                    echo "Lỗi kết nối cơ sở dữ liệu.";
                  }

                  ?>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
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