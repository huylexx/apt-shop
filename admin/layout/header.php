<?php
  session_start();

  // Kiểm tra nếu người dùng đã đăng nhập
  if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];

    // Truy vấn để lấy thông tin người dùng từ bảng taikhoan
    $login = "SELECT * FROM taikhoan WHERE ID_USER = $userId";
    $result = mysqli_query($connect, $login);
    
    // Kiểm tra nếu truy vấn thành công
    if ($result) {
      $user = mysqli_fetch_assoc($result);

      // Kiểm tra vai trò của người dùng
      if (isset($user['VAI_TRO']) && $user['VAI_TRO'] != 1) {
        // Nếu vai trò không phải là 1, chuyển hướng về trang đăng nhập và thông báo lỗi
        echo "<script>
                alert('Bạn không có quyền truy cập!');
                window.location.href = 'index.php?act=login';  // Chuyển hướng về trang đăng nhập
              </script>";
        exit; // Dừng thực thi mã tiếp theo
      }
    } else {
      // Nếu truy vấn không thành công, thông báo và quay về trang đăng nhập
      echo "<script>alert('Không tìm thấy người dùng!'); window.location.href = 'index.php?act=login';</script>";
      exit;
    }
  } else {
    // Nếu không có phiên đăng nhập, yêu cầu người dùng đăng nhập
    echo "<script>alert('Vui lòng đăng nhập!'); window.location.href = 'index.php?act=login';</script>";
    exit;
  }
?>

<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo" href="index.php?act=home"><b>APT SHOP</b></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <div class="search-field d-none d-md-block">
      <form class="d-flex align-items-center h-100" action="#">
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <i class="input-group-text border-0 mdi mdi-magnify"></i>
          </div>
          <input type="text" class="form-control bg-transparent border-0" placeholder="Tìm sản phẩm">
        </div>
      </form>
    </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-text">
            <?php
              // Truy vấn để lấy thông tin người dùng
              $sql = "SELECT * FROM taikhoan WHERE ID_USER = $userId";
              $result = mysqli_query($connect, $sql);
            ?>
            <p class="mb-1 text-black">
              <?php
                if($result){
                  $user = mysqli_fetch_assoc($result);
                  if(isset($user['TEN'])){
                    echo $user['TEN'];
                  }
                }
              ?>
            </p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="index.php?act=logout">
            <i class="mdi mdi-logout me-2 text-primary"></i> Đăng xuất </a>
        </div>
      </li>
      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-email-outline"></i>
          <span class="count-symbol bg-warning"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <h6 class="p-3 mb-0">Messages</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
              <p class="text-gray mb-0"> 1 Minutes ago </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
              <p class="text-gray mb-0"> 15 Minutes ago </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
              <p class="text-gray mb-0"> 18 Minutes ago </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <h6 class="p-3 mb-0 text-center">4 new messages</h6>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-bell-outline"></i>
          <span class="count-symbol bg-danger"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0">Notifications</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="mdi mdi-calendar"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
              <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="mdi mdi-cog"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
              <p class="text-gray ellipsis mb-0"> Update dashboard </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="mdi mdi-link-variant"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
              <p class="text-gray ellipsis mb-0"> New admin wow! </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <h6 class="p-3 mb-0 text-center">See all notifications</h6>
        </div>
      </li>
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="index.php?act=logout">
          <i class="mdi mdi-power"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
