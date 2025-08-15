<?php
include 'koneksi.php';

$id = intval($_GET['id']);
mysqli_query($koneksi, "UPDATE tasks SET status=1 WHERE id=$id");

header("Location: index.php");
exit;
?>
