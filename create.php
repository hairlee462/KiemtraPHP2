<?php
include 'db_connect.php';
if (isset($_POST['submit'])) {
    $maSV = $_POST['MaSV'];
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];
    $password = $_POST['Password'];

    $target_dir = "uploads/";
    if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
    $hinh = basename($_FILES["Hinh"]["name"]);
    move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_dir . $hinh);

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh, Password) 
            VALUES ('$maSV', '$hoTen', '$gioiTinh', '$ngaySinh', '$hinh', '$maNganh', '$password')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sinh Viên</title>
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
        <h1 class="mb-4">Thêm Sinh Viên</h1>
        <form method="post" enctype="multipart/form-data" class="card p-4">
            <div class="mb-3">
                <input type="text" name="MaSV" class="form-control" placeholder="Mã SV" required>
            </div>
            <div class="mb-3">
                <input type="text" name="HoTen" class="form-control" placeholder="Họ Tên" required>
            </div>
            <div class="mb-3">
                <select name="GioiTinh" class="form-select" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="date" name="NgaySinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="file" name="Hinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <select name="MaNganh" class="form-select" required>
                    <?php
                    $nganh = mysqli_query($conn, "SELECT * FROM NganhHoc");
                    while ($row = mysqli_fetch_assoc($nganh)) {
                        echo "<option value='{$row['MaNganh']}'>{$row['TenNganh']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <input type="password" name="Password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</body>

</html>