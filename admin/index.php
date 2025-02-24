<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>APT SHOP Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
<body id="page-top">

<?php
    include("../config/connect.php");
    $action = "login";
    if (isset($_GET["act"])) {
        $action = $_GET["act"];
    } 
    switch ($action) {
        case "home":
            include("page/home.php");
        break;
        case "login":
            include("page/login.php");
        break;
        case "product":
            include("page/product/index.php");
        break;
        case "pay":
            include("page/pay/index.php");
        break;
        case "edit-pay":
            include("page/pay/edit.php");
        break;
        case "add-pay":
            include("page/pay/add.php");
        break;
        case "add-product":
            include("page/product/add.php");
        break;
        case "edit-product":
            include("page/product/edit.php");
        break;
        case "user":
            include("page/user/index.php");
        break;
        case "edit-user":
            include("page/user/edit.php");
        break;
        case "add-user":
            include("page/user/add.php");
        break;
        case "contact":
            include("page/contact/index.php");
        break;
        case "edit-contact":
            include("page/contact/edit.php");
        break;
        case "add-contact":
            include("page/contact/add.php");
        break;
        case "detail-pay":
            include("page/detail/index.php");
        break;
        case "edit-detail-pay":
            include("page/detail/edit.php");
        break;
        case "add-detail-pay":
            include("page/detail/add.php");
        break;
        case "logout":
            session_unset();  
            session_destroy(); 
            include("page/login.php");
        break;
        
    }
?>
<!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/chart.umd.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>