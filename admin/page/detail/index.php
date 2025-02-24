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
                                <h4 class="card-title text-center pb-4">Chi tiết tất cả hóa đơn</h4>

                                <!-- Nút Thêm chi tiết hóa đơn -->
                                <p class="card-description d-flex justify-content-end">
                                    <a href="index.php?act=add-detail-pay">
                                        <button class="btn btn-primary" type="button">Thêm chi tiết hóa đơn</button>
                                    </a>
                                </p>
                                
                                <?php
                                if (isset($_GET['delete']) && isset($_GET['ma_xe'])) {
                                    $ma_hd = intval($_GET['delete']);
                                    $ma_xe = intval($_GET['ma_xe']);

                                    // Xác nhận hành động xóa
                                    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
                                        $delete_sql = "DELETE FROM cthd WHERE MA_HD = $ma_hd AND MA_XE = $ma_xe";

                                        if (mysqli_query($connect, $delete_sql)) {
                                            echo "<script>alert('Xóa chi tiết hóa đơn thành công!');</script>";
                                            echo "<script>window.location.href = 'index.php?act=detail-pay';</script>";
                                        } else {
                                            echo "<script>alert('Xóa không thành công: " . mysqli_error($connect) . "');</script>";
                                        }
                                    }
                                }
                                ?>

                                <?php
                                // Lấy tất cả chi tiết hóa đơn từ bảng cthd
                                $sql_cthd = "SELECT cthd.*, xe.TEN_XE FROM cthd
                                             JOIN xe ON cthd.MA_XE = xe.MA_XE";
                                $result_cthd = mysqli_query($connect, $sql_cthd);

                                if ($result_cthd && mysqli_num_rows($result_cthd) > 0) {
                                    echo "<table class='table table-bordered'>";
                                    echo "<thead><tr>
                                            <th>Mã HD</th>
                                            <th>Mã Xe</th>
                                            <th>Tên Xe</th>
                                            <th>Số Lượng</th>
                                            <th>Giá Bán</th>
                                            <th>Thành Tiền</th>
                                            <th colspan='2'>Thao tác</th>
                                          </tr></thead>";
                                    echo "<tbody>";

                                    while ($row_cthd = mysqli_fetch_assoc($result_cthd)) {
                                        $thanhTien = $row_cthd['SO_LUONG'] * $row_cthd['GIA_BAN'];
                                        echo "<tr>";
                                        echo "<td>" . $row_cthd['MA_HD'] . "</td>";
                                        echo "<td>" . $row_cthd['MA_XE'] . "</td>";
                                        echo "<td>" . $row_cthd['TEN_XE'] . "</td>";
                                        echo "<td>" . $row_cthd['SO_LUONG'] . "</td>";
                                        echo "<td>" . number_format($row_cthd['GIA_BAN'], 0, ',', '.') . " VND</td>";
                                        echo "<td>" . number_format($thanhTien, 0, ',', '.') . " VND</td>";

                                        // Nút Sửa
                                        echo "<td><a href='index.php?act=edit-detail-pay&id=" . $row_cthd['MA_HD'] . "&ma_xe=" . $row_cthd['MA_XE'] . "'>
                                                <button class='btn btn-success p-2'>Sửa</button></a></td>";

                                        // Nút Xóa
                                        echo "<td><a href='index.php?act=detail-pay&delete=" . $row_cthd['MA_HD'] . "&ma_xe=" . $row_cthd['MA_XE'] . "&confirm=yes' 
                                                onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\");'>
                                                <button class='btn btn-danger p-2'>Xóa</button></a></td>";

                                        echo "</tr>";
                                    }
                                    echo "</tbody></table>";
                                } else {
                                    echo "<p>Không có chi tiết hóa đơn nào. Vui lòng kiểm tra lại dữ liệu hoặc thử thêm mới.</p>";
                                }
                                ?>
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
