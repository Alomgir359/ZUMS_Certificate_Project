<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Student Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-200 to-blue-600 font-sans">

    <div class="w-full max-w-sm bg-white shadow-lg rounded-xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Student Portal Login</h2>
        
        <?php if (!empty($error)) : ?>
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-2 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 mb-1">Username</label>
                <input type="text" name="username" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your username">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your password">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded transition-all duration-200">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">Need help? Contact admin.</p>
    </div>

</body>
</html>
