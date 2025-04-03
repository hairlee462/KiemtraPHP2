<?php
include 'db_connect.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM SinhVien WHERE MaSV = '$id'");
header("Location: index.php");
