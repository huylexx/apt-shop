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
                <h4 class="card-title text-center">Quản lý liên hệ</h4>
                <p class="card-description d-flex justify-content-end"><a href="index.php?act=add-contact"><button
                      class="btn btn-primary" type="button">Thêm liên hệ</button></a>
                </p>
                <?php
                  if (isset($_GET['id'])) {
                    $contact_id = $_GET['id'];

                    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
                      $delete_sql = "DELETE FROM lienhe WHERE ID_LIENHE = $contact_id";
                      
                      mysqli_query($connect, $delete_sql);
                    } else {
                      echo "<script>
                        var result = confirm('Bạn có chắc chắn muốn xóa liên hệ này không?');
                        if (result) {
                          window.location.href = 'index.php?act=contact&id=" . $contact_id . "&confirm=yes';
                        } else {
                          window.location.href = 'index.php?act=contact';
                        }
                      </script>";
                    }
                  }
                ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> Số thứ tự </th>
                      <th> Tên người liên hệ </th>
                      <th> Email </th>
                      <th> Số điện thoại </th>
                      <th> Tin nhắn </th>
                      <th colspan="2" class="text-center">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM lienhe";
                    $result = mysqli_query($connect, $sql);

                    if ($result) {
                      if (mysqli_num_rows($result) > 0) {
                        $stt = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>" . $stt++ . "</td>";
                          echo "<td>" . $row['TEN'] . "</td>";
                          echo "<td>" . $row['EMAIL_TINNHAN'] . "</td>";
                          echo "<td>" . $row['SDT'] . "</td>";
                          echo "<td>" . $row['TINNHAN'] . "</td>";

                          echo "<td><a href='index.php?act=edit-contact&id=" . $row['ID_LIENHE'] . "'><button class='btn btn-success p-2'>Sửa</button></a></td>";
                          echo "<td><a href='index.php?act=contact&id=" . $row['ID_LIENHE'] . "'><button class='btn btn-danger p-2'>Xoá</button></a></td>";
                          echo "</tr>";
                        }
                      }
                    } else {
                      echo "Lỗi kết nối cơ sở dữ liệu.";
                    }
                    ?>
                  </tbody>
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
