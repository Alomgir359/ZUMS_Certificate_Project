<?php
include '../auth.php';
include '../config.php';

// Get user ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch user info
$query = "SELECT * FROM users WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<script>alert('User not found'); window.location.href='dashboard.php';</script>";
    exit;
}

$userData = mysqli_fetch_assoc($result);

// If form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // You can hash password if needed (e.g., md5 or password_hash)
    $hashedPassword = md5($password); // optional: password_hash($password, PASSWORD_DEFAULT);

    $update = "UPDATE users SET username='$username', password='$hashedPassword', role='$role' WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('User updated successfully'); window.location.href='../Admin/allUser.php';</script>";
        exit;
    } else {
        $error = "Failed to update user: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-indigo-50 via-purple-50 to-pink-50 font-sans p-6">
<div class="bg-white p-10 rounded-3xl shadow-lg max-w-xl w-full">
    <h2 class="text-2xl font-bold text-indigo-700 mb-6">Edit User</h2>

    <?php if (isset($error)): ?>
        <div class="text-red-600 mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Username</label>
            <input type="text" name="username" required value="<?= htmlspecialchars($userData['username']) ?>"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Password</label>
            <input type="text" name="password" required value="<?= htmlspecialchars($userData['password']) ?>"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block font-semibold text-indigo-700 mb-1">Role</label>
            <select name="role" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="normal" <?= $userData['role'] === 'normal' ? 'selected' : '' ?>>Normal</option>
                <option value="admin" <?= $userData['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="allUser.php" class="bg-gray-300 px-6 py-2 rounded-lg font-semibold hover:bg-gray-400">← Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700">Update</button>
        </div>
    </form>
</div>
</body>
</html>
