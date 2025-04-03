<?php
session_start();
include 'db_connect.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$maSV = $_SESSION['MaSV'];

// Kiểm tra MaSV có tồn tại trong bảng SinhVien không
$check = mysqli_query($conn, "SELECT MaSV FROM SinhVien WHERE MaSV = '$maSV'");
if (mysqli_num_rows($check) == 0) {
    $message = "Mã sinh viên không hợp lệ!";
    header("Location: dangky.php?error=" . urlencode($message));
    exit();
}

if (!empty($_SESSION['cart'])) {
    $ngayDK = date('Y-m-d');
    $sql = "INSERT INTO DangKy (NgayDK, MaSV) VALUES ('$ngayDK', '$maSV')";
    if (mysqli_query($conn, $sql)) {
        $maDK = mysqli_insert_id($conn);

        foreach ($_SESSION['cart'] as $maHP) {
            // Kiểm tra số lượng dự kiến trước khi đăng ký
            $hp_check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SoLuongDuKien FROM HocPhan WHERE MaHP = '$maHP'"));
            if ($hp_check['SoLuongDuKien'] > 0) {
                $sql = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ($maDK, '$maHP')";
                mysqli_query($conn, $sql);
                // Giảm số lượng dự kiến
                mysqli_query($conn, "UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHP = '$maHP'");
            }
        }
        $_SESSION['cart'] = [];
        $message = "Đăng ký thành công!";
    } else {
        $message = "Lỗi khi đăng ký: " . mysqli_error($conn);
    }
} else {
    $message = "Giỏ hàng trống!";
}

header("Location: dangky.php?message=" . urlencode($message));
