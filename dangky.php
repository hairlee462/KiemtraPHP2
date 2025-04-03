<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$maSV = $_SESSION['MaSV'];
$result = mysqli_query($conn, "SELECT * FROM HocPhan WHERE SoLuongDuKien > 0");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (isset($_GET['add'])) {
    $maHP = $_GET['add'];
    if (!in_array($maHP, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $maHP;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
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
        <h1 class="mb-4">Đăng ký Học Phần</h1>
        <?php
        if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
        }
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
        ?>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['TenHP']; ?></h5>
                            <p class="card-text">
                                Mã HP: <?php echo $row['MaHP']; ?><br>
                                Số tín chỉ: <?php echo $row['SoTinChi']; ?><br>
                                Còn lại: <?php echo $row['SoLuongDuKien']; ?>
                            </p>
                            <a href="?add=<?php echo $row['MaHP']; ?>" class="btn btn-primary">Thêm</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a href="cart.php" class="btn btn-success mt-3">Xem giỏ hàng</a>
        <a href="logout.php" class="btn btn-danger mt-3">Đăng xuất</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>