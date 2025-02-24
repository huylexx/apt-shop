<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/abc.png" type="image/x-icon">

    <title>
        Bán xe máy
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/style.min.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">


        <?php
        include 'config/connect.php';
        $action = "home";
        if (isset($_GET['act'])) {
            $action = $_GET['act'];
        }
        switch ($action) {
            case 'home':
                include 'page/home.php';
                break;
            case 'contact':
                include 'page/contact.php';
                break;
            case 'about':
                include 'page/about.php';
                break;
            case 'shop':
                include 'page/shop.php';
                break;
            case 'login':
                include 'page/login.php';
                break;
            case 'register':
                include 'page/register.php';
                break;
            case 'search':
                include 'page/search.php';
                break;
            case 'cart':
                include 'page/cart.php';
                break;
            case 'detail':
                include 'page/detail.php';
                break;
            case 'checkout':
                include 'page/checkout.php';
                break;
            case 'order_history':
                include 'page/order_history.php';
                break;
            case 'cancel_order':
                include 'page/cancel_order.php';
                break;
            case 'profile':
                include 'page/profile.php';
                break;
            case "logout":
                session_unset();
                session_destroy();
                include("page/login.php");
                break;
        }
        ?>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="js/custom.js"></script>


</body>

</html>