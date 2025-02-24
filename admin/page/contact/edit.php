<?php

if (isset($_GET['id'])) {
  $id_lienhe = $_GET['id'];

  $query = "SELECT * FROM lienhe WHERE ID_LIENHE = $id_lienhe";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $lienhe = mysqli_fetch_assoc($result);
  } else {
    echo "<script>alert('Liên hệ không tồn tại');</script>";
    exit;
  }
}

if (isset($_POST['Capnhat'])) {
  $ten = $_POST['ten'];
  $email_tinnhan = $_POST['email_tinnhan'];
  $sdt = $_POST['sdt'];
  $tinhnan = $_POST['tinhnan'];

  $update_sql = "UPDATE lienhe SET 
                        TEN = '$ten',
                        EMAIL_TINNHAN = '$email_tinnhan',
                        SDT = '$sdt',
                        TINNHAN = '$tinhnan'
                        WHERE ID_LIENHE = $id_lienhe";
  if (mysqli_query($connect, $update_sql)) {
    echo "
      <script>
        alert('Cập nhật thành công!!!');
        window.location.href = 'index.php?act=contact';
    </script>
    ";
  } else {
    echo "<script>alert('Cập nhật thất bại: " . mysqli_error($connect) . "');</script>";
  }
}
?>

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
        <div class="page-header">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php?act=contact">Liên hệ</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sửa liên hệ</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Sửa thông tin liên hệ</h4>
                <form class="forms-sample" method="POST" action="index.php?act=edit-contact&id=<?php echo $id_lienhe; ?>">
                  <div class="form-group">
                    <label for="ten">Tên liên hệ</label>
                    <input type="text" class="form-control" id="ten" name="ten" value="<?php echo $lienhe['TEN']; ?>" placeholder="Tên liên hệ...">
                  </div>
                  <div class="form-group">
                    <label for="email_tinnhan">Email</label>
                    <input type="email" class="form-control" id="email_tinnhan" name="email_tinnhan" value="<?php echo $lienhe['EMAIL_TINNHAN']; ?>" placeholder="Email...">
                  </div>
                  <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" name="sdt" value="<?php echo $lienhe['SDT']; ?>" placeholder="Số điện thoại...">
                  </div>
                  <div class="form-group">
                    <label for="tinhnan">Tin nhắn</label>
                    <textarea class="form-control" id="tinhnan" name="tinhnan" placeholder="Tin nhắn..."><?php echo $lienhe['TINNHAN']; ?></textarea>
                  </div>
                  <button type="submit" class="btn btn-gradient-primary me-2" name="Capnhat">Cập nhật</button>
                  <button type="reset" class="btn btn-light" onclick="Huy()">Huỷ</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        function Huy() {
          window.location = "index.php?act=contact";
        }
      </script>
      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      <?php include('layout/footer.php'); ?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
