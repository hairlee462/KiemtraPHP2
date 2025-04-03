<?php
include 'db_connect.php';
$id = $_GET['id'];
$sv = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sv.*, nh.TenNganh 
    FROM SinhVien sv 
    LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
    WHERE MaSV = '$id'"));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chi tiết Sinh Viên</title>
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
        <h1 class="mb-4">Chi tiết Sinh Viên</h1>
        <div class="card">
            <img src="uploads/<?php echo $sv['Hinh']; ?>" class="card-img-top" style="max-height: 200px;" alt="">
            <div class="card-body">
                <h5 class="card-title"><?php echo $sv['HoTen']; ?></h5>
                <p class="card-text">
                    Mã SV: <?php echo $sv['MaSV']; ?><br>
                    Ngành: <?php echo $sv['TenNganh']; ?><br>
                    Giới tính: <?php echo $sv['GioiTinh']; ?><br>
                    Ngày sinh: <?php echo $sv['NgaySinh']; ?>
                </p>
                <a href="index.php" class="btn btn-primary">Quay lại</a>
            </div>
        </div>
    </div>
</body>

</html>