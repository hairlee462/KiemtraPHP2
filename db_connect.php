<?php
$conn = mysqli_connect("localhost", "root", "", "Test1");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
