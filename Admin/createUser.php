<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);

    // Check if username already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username already exists!'); window.location.href='../dashboard.php';</script>";
        exit;
    } else {
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'normal')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User created successfully!'); window.location.href='../dashboard.php';</script>";
            exit;
        } else {
            // If some error occurs during insert, just alert and go back
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='../dashboard.php';</script>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Create New User</h2>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Create User</button>
    </form>
</div>

</body>
</html>
