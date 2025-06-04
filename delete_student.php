<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<script>alert('Only admin can delete student records.'); window.location.href='dashboard.php';</script>";
    exit;
}

$id = intval($_GET['id']); // sanitize id
$stmt = mysqli_prepare($conn, "DELETE FROM students_info WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

header("Location: dashboard.php");
exit();
?>
