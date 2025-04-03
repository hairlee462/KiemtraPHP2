<?php
include 'db_connect.php';
$id = $_GET['id'];
$sv = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM SinhVien WHERE MaSV = '$id'"));

if (isset($_POST['submit'])) {
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];
    $password = $_POST['Password'];

    if ($_FILES['Hinh']['name']) {
        $target_dir = "uploads/";
        $hinh = basename($_FILES["Hinh"]["name"]);
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_dir . $hinh);
        $sql = "UPDATE SinhVien SET HoTen='$hoTen', GioiTinh='$gioiTinh', NgaySinh='$ngaySinh', 
                Hinh='$hinh', MaNganh='$maNganh', Password='$password' WHERE MaSV='$id'";
    } else {
        $sql = "UPDATE SinhVien SET HoTen='$hoTen', GioiTinh='$gioiTinh', NgaySinh='$ngaySinh', 
                MaNganh='$maNganh', Password='$password' WHERE MaSV='$id'";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa Sinh Viên</title>
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
        <h1 class="mb-4">Sửa Sinh Viên</h1>
        <form method="post" enctype="multipart/form-data" class="card p-4">
            <div class="mb-3">
                <input type="text" name="MaSV" class="form-control" value="<?php echo $sv['MaSV']; ?>" disabled>
            </div>
            <div class="mb-3">
                <input type="text" name="HoTen" class="form-control" value="<?php echo $sv['HoTen']; ?>" required>
            </div>
            <div class="mb-3">
                <select name="GioiTinh" class="form-select" required>
                    <option value="Nam" <?php echo $sv['GioiTinh'] == 'Nam' ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo $sv['GioiTinh'] == 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="date" name="NgaySinh" class="form-control" value="<?php echo $sv['NgaySinh']; ?>" required>
            </div>
            <div class="mb-3">
                <img src="uploads/<?php echo $sv['Hinh']; ?>" class="img-fluid mb-2" style="max-height: 100px;">
                <input type="file" name="Hinh" class="form-control">
            </div>
            <div class="mb-3">
                <select name="MaNganh" class="form-select" required>
                    <?php
                    $nganh = mysqli_query($conn, "SELECT * FROM NganhHoc");
                    while ($row = mysqli_fetch_assoc($nganh)) {
                        $selected = $row['MaNganh'] == $sv['MaNganh'] ? 'selected' : '';
                        echo "<option value='{$row['MaNganh']}' $selected>{$row['TenNganh']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <input type="password" name="Password" class="form-control" value="<?php echo $sv['Password']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>

</html>