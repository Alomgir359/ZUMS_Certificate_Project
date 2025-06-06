<?php
session_start();
include '../config.php'; // database connection
include '../auth.php';   // authentication (admin check)

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    // শুধু অ্যাডমিনই ইউজার ডিলিট করতে পারবে
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // ইউজার ডিলিট করুন
    $query = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // সফল হলে allUser.php-তে পাঠিয়ে দিন
        header("Location: allUser.php?message=User deleted successfully");
        exit();
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid request.";
}
?>
