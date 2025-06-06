<?php
include 'auth.php';          // session & login auth
include 'config.php';        // database connection
$user = $_SESSION['user'];   // logged-in user
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gradient-to-tr from-indigo-50 via-purple-50 to-pink-50 font-sans">

<!-- Sidebar -->
<!-- Sidebar -->
<div class="w-64 bg-white shadow-xl rounded-r-3xl p-6 flex flex-col">
    <h2 class="text-2xl font-extrabold text-indigo-700 mb-8">
        Hello, <span class="capitalize"><?= htmlspecialchars($user['username']) ?></span>!
    </h2>

    <ul class="flex flex-col gap-4 flex-grow">
        <?php if ($user['role'] == 'admin'): ?>
            <li><a href="./Admin/createUser.php" class="block px-4 py-3 rounded-xl text-indigo-600 hover:bg-indigo-100 hover:text-indigo-800 transition">➤ Create User</a></li>
            <li><a href="./Admin/allUser.php" class="block px-4 py-3 rounded-xl text-indigo-600 hover:bg-indigo-100 hover:text-indigo-800 transition">➤ All Users</a></li>
        <?php endif; ?>
        <li><a href="insert_student.php" class="block px-4 py-3 rounded-xl text-indigo-600 hover:bg-indigo-100 hover:text-indigo-800 transition">➤ Insert Student Info</a></li>
    </ul>

    <a href="logout.php" class="block mt-auto px-4 py-3 rounded-xl text-red-600 hover:bg-red-100 hover:text-red-800 font-semibold transition">➤ Logout</a>
</div>


<!-- Main Content -->
<div class="flex-1 p-10 overflow-auto">
    <div class="bg-white rounded-3xl shadow-lg p-10 min-h-[80vh]">
        <?php if (isset($_GET['insert_student'])): ?>
            <?php include 'insert_student.php'; ?>
        <?php else: ?>
            <h1 class="text-3xl font-bold text-indigo-700">Welcome to your Dashboard</h1>
            <p class="mt-4 text-indigo-700">All Inserted Students List</p>
        <?php endif; ?>

        <!-- Table -->
        <div class="mt-6 overflow-x-auto bg-white p-4 rounded shadow">
            <table class="min-w-full border border-gray-300 text-sm table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name of School</th>
                        <th class="px-4 py-2 border">Name of Degree</th>
                        <th class="px-4 py-2 border">Major</th>
                        <th class="px-4 py-2 border">Semester</th>
                        <th class="px-4 py-2 border">CGPA</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM students_info");
                    while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2 border break-words whitespace-normal"><?= htmlspecialchars($row['student_name']) ?></td>
                        <td class="px-4 py-2 border break-words whitespace-normal"><?= htmlspecialchars($row['student_id']) ?></td>
                        <td class="px-4 py-2 border break-words whitespace-normal"><?= htmlspecialchars($row['department']) ?></td>
                        <td class="px-4 py-2 border break-words whitespace-normal"><?= htmlspecialchars($row['degree']) ?></td>
                        <td class="px-4 py-2 border break-words whitespace-normal"><?= htmlspecialchars($row['major']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($row['semester']) ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($row['cgpa']) ?></td>
                        <td class="px-4 py-2 border text-blue-600 space-x-2 whitespace-nowrap">
                            <a href="edit_student.php?id=<?= $row['id'] ?>" class="hover:font-bold hover:underline">Edit</a>
                            <a href="print_student.php?id=<?= $row['id'] ?>" class="hover:font-bold hover:underline text-green-600">Print</a>
                            <?php if ($user['role'] === 'admin'): ?>
                                <a href="delete_student.php?id=<?= $row['id'] ?>" class="hover:font-bold hover:underline text-red-600" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                            <?php else: ?>
                                <button onclick="alert('Only admin can delete student records.')" class="text-gray-400 cursor-not-allowed">Delete</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
