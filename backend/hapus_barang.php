<?php
require_once __DIR__ . '/auth.php';
require_role('owner'); // Khusus Owner yang berhak menghapus data barang

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        http_response_code(403);
        exit('Token sesi tidak valid.');
    }

    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = db()->prepare('DELETE FROM barang WHERE id = ?');
        $stmt->execute([$id]);
    }

    header('Location: ../barang.php?pesan=berhasil_hapus');
    exit;
}

// Jika diakses via GET langsung, tolak
header('Location: ../barang.php');
exit;
