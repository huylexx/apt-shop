<style>
  .bg-secondary {
    background-color: #6c757d !important;
    color: #fff !important;
  }

  .bg-dark {
    background-color: #343a40 !important;
    color: #fff !important;
  }

  .card-footer.text-white:hover {
    background-color: #454d55 !important;
    color: #e0e0e0 !important;
  }

  .container-fluid {
    padding: 20px;
    background-color: #f9f9f9;
  }

  .card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .card-body {
    text-align: center;
    padding: 15px;
    font-family: "Arial", sans-serif;
  }

  .card h2 {
    font-size: 36px;
    margin-bottom: 10px;
  }

  .card p {
    font-size: 16px;
    margin-bottom: 0;
  }

  .card-footer {
    background-color: #f5f5f5;
    border-top: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    font-size: 14px;
    color: #555;
  }

  .card-footer:hover {
    background-color: #e0e0e0;
    color: #000;
    text-decoration: none;
  }

  .bg-warning {
    background-color: #ffc107 !important;
    color: #fff !important;
  }

  .bg-success {
    background-color: #28a745 !important;
    color: #fff !important;
  }

  .bg-info {
    background-color: #17a2b8 !important;
    color: #fff !important;
  }

  .bg-danger {
    background-color: #dc3545 !important;
    color: #fff !important;
  }

  .bg-primary {
    background-color: #007bff !important;
    color: #fff !important;
  }

  .bg-teal {
    background-color: #20c997 !important;
    color: #fff !important;
  }

  .row {
    margin: 0 -15px;
  }

  .col-md-4,
  .col-lg-3 {
    padding: 15px;
  }
</style>

<div class="container-scroller">
  <?php include('layout/header.php'); ?>
  <div class="container-fluid page-body-wrapper">
    <?php include('layout/sidebar.php'); ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <h4 class="card-title text-center py-3">Tổng quan</h4>
        <div class="row">
          <div class="col-md-4 col-lg-3">
            <div class="card bg-warning">
              <?php

              ?>
              <div class="card-body">
                <h2>363</h2>
                <p>Sản phẩm</p>
              </div>
              <a href="index.php?act=product" class="card-footer">Chi tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card bg-success">
              <div class="card-body">
                <h2>12</h2>
                <p>Hóa đơn</p>
              </div>
              <a href="index.php?act=pay" class="card-footer">Chi tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card bg-info">
              <div class="card-body">
                <h2>5</h2>
                <p>Liên hệ</p>
              </div>
              <a href="index.php?act=contact" class="card-footer">Chi tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card bg-danger">
              <div class="card-body">
                <h2>2</h2>
                <p>Thành viên</p>
              </div>
              <a href="index.php?act=user" class="card-footer">Chi tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card bg-primary">
              <div class="card-body">
                <h2>5</h2>
                <p>Đơn hàng chờ xử lý</p>
              </div>
              <a href="#" class="card-footer">Chi tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card bg-teal">
              <div class="card-body">
                <h2>0</h2>
                <p>Lịch biểu</p>
              </div>
              <a href="#" class="card-footer">Chi tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card bg-secondary">
              <div class="card-body">
                <h2>10</h2>
                <p>Đơn hàng đã xử lý</p>
              </div>
              <a href="#" class="card-footer">Chi tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card bg-dark text-white">
              <div class="card-body">
                <?php
                $sql = "SELECT SUM(TONG_TIEN) AS tongdoanhthu FROM hoadon WHERE TRANG_THAI = 1";
                $result = $connect->query($sql);

                $tongDoanhThu = 0;
                
                if ($result && $result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $tongDoanhThu = $row['tongdoanhthu'];
                }

                $tongDoanhThuFormatted = number_format($tongDoanhThu, 0, ',', '.');

                echo "<h3>{$tongDoanhThuFormatted} VNĐ</h3>";
                ?>
                <p>Tổng doanh thu</p>
              </div>
            </div>
          </div>

        </div>
        <?php include('layout/footer.php'); ?>
      </div>
    </div>
  </div>