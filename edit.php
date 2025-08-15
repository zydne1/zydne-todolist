<?php
include 'koneksi.php';

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM tasks WHERE id=$id");
$task_data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = mysqli_real_escape_string($koneksi, $_POST['task']);
    $priority = intval($_POST['priority']);
    $due_date = $_POST['due_date'];

    if (!empty($task) && !empty($priority) && !empty($due_date)) {
        mysqli_query($koneksi, "UPDATE tasks SET task='$task', priority=$priority, due_date='$due_date' WHERE id=$id");
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Edit Task</h2>

    <form method="POST" class="border p-3 bg-light rounded">
        <div class="mb-2">
            <label class="form-label">Nama Task</label>
            <input type="text" name="task" class="form-control" value="<?= htmlspecialchars($task_data['task']) ?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Prioritas</label>
            <select name="priority" class="form-select" required>
                <option value="1" <?= $task_data['priority'] == 1 ? 'selected' : '' ?>>Low</option>
                <option value="2" <?= $task_data['priority'] == 2 ? 'selected' : '' ?>>Medium</option>
                <option value="3" <?= $task_data['priority'] == 3 ? 'selected' : '' ?>>High</option>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Tanggal</label>
            <input type="date" name="due_date" class="form-control" value="<?= $task_data['due_date'] ?>" required>
        </div>
        <button type="submit" class="btn btn-warning w-100">Edit</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
    </form>
</div>
</body>
</html>
