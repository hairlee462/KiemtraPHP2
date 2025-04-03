<?php
session_start();
include 'db_connect.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$maSV = $_SESSION['MaSV'];

// Lấy danh sách học phần đã đăng ký
$result = mysqli_query($conn, "
    SELECT dk.MaDK, dk.NgayDK, hp.MaHP, hp.TenHP, hp.SoTinChi
    FROM DangKy dk
    JOIN ChiTietDangKy ctdk ON dk.MaDK = ctdk.MaDK
    JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
    WHERE dk.MaSV = '$maSV'
    ORDER BY dk.NgayDK DESC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Học Phần Đã Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Hệ thống Đăng ký</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Sinh Viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hocphan.php">Học Phần</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dangky.php">Đăng ký</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registered.php">Đã Đăng Ký</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h1 class="mb-4">Học Phần Đã Đăng Ký</h1>
        <?php if (mysqli_num_rows($result) == 0) { ?>
            <div class="alert alert-info">Bạn chưa đăng ký học phần nào.</div>
        <?php } else { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã Đăng Ký</th>
                        <th>Ngày Đăng Ký</th>
                        <th>Mã HP</th>
                        <th>Tên HP</th>
                        <th>Số Tín Chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['MaDK']; ?></td>
                            <td><?php echo $row['NgayDK']; ?></td>
                            <td><?php echo $row['MaHP']; ?></td>
                            <td><?php echo $row['TenHP']; ?></td>
                            <td><?php echo $row['SoTinChi']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <a href="dangky.php" class="btn btn-primary mt-3">Đăng ký thêm</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>