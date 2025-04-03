<?php
session_start();
include 'db_connect.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;
$offset = ($page - 1) * $limit;
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM SinhVien"))['total'];
$pages = ceil($total / $limit);

$result = mysqli_query($conn, "SELECT sv.*, nh.TenNganh 
    FROM SinhVien sv 
    LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
    LIMIT $offset, $limit");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lý Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .student-img {
            height: 100px;
            object-fit: cover;
        }

        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
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
        <h1 class="mb-4">Danh sách Sinh Viên</h1>
        <a href="create.php" class="btn btn-primary mb-3">Thêm Sinh Viên</a>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col">
                    <div class="card">
                        <img src="uploads/<?php echo $row['Hinh']; ?>" class="card-img-top student-img" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['HoTen']; ?></h5>
                            <p class="card-text">
                                Mã SV: <?php echo $row['MaSV']; ?><br>
                                Ngành: <?php echo $row['TenNganh']; ?><br>
                                Giới tính: <?php echo $row['GioiTinh']; ?><br>
                                Ngày sinh: <?php echo $row['NgaySinh']; ?>
                            </p>
                            <a href="detail.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">Chi tiết</a>
                            <a href="edit.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="delete.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Phân trang -->
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>