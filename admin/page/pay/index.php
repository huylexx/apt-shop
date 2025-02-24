<div class="container-scroller">
  <!-- partial:../../partials/_navbar.html -->
  <?php include('layout/header.php'); ?>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
    <?php include('layout/sidebar.php'); ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body overflow-scroll">
                <h4 class="card-title text-center pb-4">Hóa đơn thanh toán</h4>
                
                <p class="card-description d-flex justify-content-end">
                  <a href="index.php?act=add-pay">
                    <button class="btn btn-primary" type="button">Thêm hóa đơn</button>
                  </a>
                </p>
                
                <?php
                if (isset($_GET['id'])) {
                  $ma_hd = $_GET['id'];

                  if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
                    $delete_sql = "DELETE FROM hoadon WHERE MA_HD = $ma_hd";

                    if (mysqli_query($connect, $delete_sql)) {
                      echo "Xóa hóa đơn thành công!";
                    } else {
                      echo "Xóa không thành công!";
                    }
                  } else {
                    echo "<script>
                        var result = confirm('Bạn có chắc chắn muốn xóa hóa đơn này?');
                        if (result) {
                          window.location.href = 'index.php?act=pay&id=" . $ma_hd . "&confirm=yes';
                        } else {
                          window.location.href = 'index.php?act=pay';
                        }
                      </script>";
                  }
                }
                ?>

                <style>
                  table.table td {
                    padding: 5px;
                    text-align: center;
                    font-size: 12px;
                  }

                  table.table th {
                    text-align: center;
                  }
                </style>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> Mã hóa đơn </th>
                      <th> Ngày lập </th>
                      <th> Phương thức </th>
                      <th> Trạng thái </th>
                      <th> Tổng số lượng </th>
                      <th> Tổng tiền </th>
                      <th> Họ tên </th>
                      <th> Email </th>
                      <th> Số điện thoại </th>
                      <th> Địa chỉ </th>
                      <th colspan="2" class="text-center"> Thao tác </th>
                    </tr>
                  </thead>

                  <?php
                  $sql = "SELECT * FROM hoadon";
                  $result = mysqli_query($connect, $sql);

                  if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['MA_HD'] . "</td>";
                        echo "<td>" . $row['NGAY_LAP_HD'] . "</td>";
                        
                        if($row['PHUONG_THUC_THANH_TOAN'] == 1){
                          $pttt = "Thanh toán khi nhận hàng";
                        }
                        echo "<td>" . $pttt . "</td>";

                        if ($row['TRANG_THAI'] == '1') {
                          $trangThai = 'Đang chờ duyệt';
                        } elseif ($row['TRANG_THAI'] == '2') {
                          $trangThai = 'Đã duyệt';
                        }
                        echo "<td>" . $trangThai . "</td>";
                        echo "<td>" . $row['TONG_SO_LUONG'] . "</td>";
                        echo "<td>" . number_format($row['TONG_TIEN'], 0, ',', '.') . " VND</td>";
                        echo "<td>" . $row['HOTEN'] . "</td>";
                        echo "<td>" . $row['EMAIL'] . "</td>";
                        echo "<td>" . $row['SDT'] . "</td>";
                        echo "<td>" . $row['DIACHI'] . "</td>";

                        echo "<td><a href='index.php?act=edit-pay&id=" . $row['MA_HD'] . "'><button class='btn btn-success p-2'>Sửa</button></a></td>";
                        echo "<td><a href='index.php?act=pay&id=" . $row['MA_HD'] . "'><button class='btn btn-danger p-2'>Xóa</button></a></td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='13' class='text-center'>Không có hóa đơn nào.</td></tr>";
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
      <?php include('layout/footer.php'); ?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
