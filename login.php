<?php
session_start();
include 'db_connect.php';
if (isset($_POST['submit'])) {
    $maSV = $_POST['MaSV'];
    $password = $_POST['Password'];
    $result = mysqli_query($conn, "SELECT * FROM SinhVien WHERE MaSV = '$maSV' AND Password = '$password'");
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['MaSV'] = $maSV;
        header("Location: dangky.php");
    } else {
        $error = "Sai thông tin đăng nhập!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">
    <div class="container">
        <h1 class="mb-4">Đăng nhập</h1>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="post" class="card p-4" style="max-width: 400px;">
            <div class="mb-3">
                <input type="text" name="MaSV" class="form-control" placeholder="Mã SV" required>
            </div>
            <div class="mb-3">
                <input type="password" name="Password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
</body>

</html>