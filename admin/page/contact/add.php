<?php

if (isset($_POST['Them'])) {
  $ten = $_POST['ten'];
  $email_tinnhan = $_POST['email_tinnhan'];
  $sdt = $_POST['sdt'];
  $tinhnan = $_POST['tinhnan'];

  $insert_sql = "INSERT INTO lienhe (TEN, EMAIL_TINNHAN, SDT, TINNHAN) 
                 VALUES ('$ten', '$email_tinnhan', '$sdt', '$tinhnan')";

  if (mysqli_query($connect, $insert_sql)) {
    echo "
      <script>
        alert('Thêm thành công!!!');
        window.location.href = 'index.php?act=contact';
    </script>
    ";
  } else {
    echo "<script>alert('Thêm thất bại: " . mysqli_error($connect) . "');</script>";
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
              <li class="breadcrumb-item active" aria-current="page">Thêm liên hệ</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-md grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Thêm mới liên hệ</h4>
                <form class="forms-sample" method="POST" action="index.php?act=add-contact">
                  <div class="form-group">
                    <label for="ten">Tên liên hệ</label>
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="Tên liên hệ..." required>
                  </div>
                  <div class="form-group">
                    <label for="email_tinnhan">Email</label>
                    <input type="email" class="form-control" id="email_tinnhan" name="email_tinnhan" placeholder="Email..." required>
                  </div>
                  <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Số điện thoại..." required>
                  </div>
                  <div class="form-group">
                    <label for="tinhnan">Tin nhắn</label>
                    <textarea class="form-control" id="tinhnan" name="tinhnan" placeholder="Tin nhắn..." required></textarea>
                  </div>
                  <button type="submit" class="btn btn-gradient-primary me-2" name="Them">Thêm</button>
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
