<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Aplikasi To-Do List</h2>

    <!-- Form Tambah Task -->
    <form method="POST" action="tambah.php" class="border p-3 mb-4 bg-light rounded">
        <div class="mb-2">
            <label class="form-label">Nama Task</label>
            <input type="text" name="task" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Prioritas</label>
            <select name="priority" class="form-select" required>
                <option value="">-- Pilih Prioritas --</option>
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Tanggal</label>
            <!-- Batasi tanggal minimal hari ini -->
            <input type="date" name="due_date" class="form-control" 
                   value="<?= date('Y-m-d') ?>" 
                   min="<?= date('Y-m-d') ?>" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah</button>
    </form>

    <!-- Tabel Task -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
        <tr>
            <th>No</th>
            <th>Task</th>
            <th>Prioritas</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $today = date('Y-m-d');
        $result = mysqli_query($koneksi, "SELECT * FROM tasks ORDER BY due_date ASC");
        while ($row = mysqli_fetch_assoc($result)) {
            // Cek apakah task lewat deadline
            $isLate = ($row['status'] == 0 && $row['due_date'] < $today);
        ?>
        <tr class="<?= $row['status'] ? 'table-success' : ($isLate ? 'table-danger' : '') ?>">
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['task']) ?></td>
            <td>
                <?php
                    if ($row['priority'] == 1) echo "Low";
                    elseif ($row['priority'] == 2) echo "Medium";
                    elseif ($row['priority'] == 3) echo "High";
                ?>
            </td>
            <td><?= $row['due_date'] ?></td>
            <td class="text-center">
                <?php if ($row['status'] == 1): ?>
                    <span class="badge bg-success">Selesai</span>
                <?php elseif ($isLate): ?>
                    <span class="badge bg-danger">Lewat Deadline</span>
                <?php else: ?>
                    <span class="badge bg-warning text-dark">Belum</span>
                <?php endif; ?>
            </td>
            <td class="text-center">
                <?php if ($row['status'] == 0 && !$isLate): ?>
                    <a href="selesai.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Selesai</a>
                <?php endif; ?>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus task ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
