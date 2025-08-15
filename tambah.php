<?php
include 'koneksi.php';

$task = mysqli_real_escape_string($koneksi, $_POST['task']);
$priority = intval($_POST['priority']);
$due_date = $_POST['due_date'];

if (!empty($task) && !empty($priority) && !empty($due_date)) {
    // Validasi: tanggal tidak boleh lebih kecil dari hari ini
    if (strtotime($due_date) < strtotime(date('Y-m-d'))) {
        echo "<script>alert('Tanggal sudah lewat, tidak bisa digunakan!'); window.location='index.php';</script>";
        exit;
    }

    mysqli_query($koneksi, "INSERT INTO tasks (task, priority, due_date, status) 
                            VALUES ('$task', $priority, '$due_date', 0)");
}

header("Location: index.php");
exit;
?>
