<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
}

if (isset($_GET['remove'])) {
    $maHP = $_GET['remove'];
    if (($key = array_search($maHP, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">
    <div class="container">
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
        <h1 class="mb-4">Giỏ hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã HP</th>
                    <th>Tên HP</th>
                    <th>Số tín chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION['cart'])) {
                    $in = "'" . implode("','", $_SESSION['cart']) . "'";
                    $result = mysqli_query($conn, "SELECT * FROM HocPhan WHERE MaHP IN ($in)");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['MaHP']}</td>
                            <td>{$row['TenHP']}</td>
                            <td>{$row['SoTinChi']}</td>
                            <td><a href='?remove={$row['MaHP']}' class='btn btn-danger btn-sm'>Xóa</a></td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="dangky.php" class="btn btn-primary">Tiếp tục đăng ký</a>
        <a href="?clear=1" class="btn btn-danger">Xóa hết</a>
        <a href="save.php" class="btn btn-success">Lưu đăng ký</a>
    </div>
</body>

</html>