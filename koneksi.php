<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'ukk2025_todolist');
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
