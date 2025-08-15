<?php
include 'koneksi.php';

$id = intval($_GET['id']);
mysqli_query($koneksi, "DELETE FROM tasks WHERE id=$id");

header("Location: index.php");
exit;
?>
