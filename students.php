<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$is_admin = $_SESSION['role'] === 'admin';

$result = mysqli_query($conn, "SELECT * FROM students_info");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

<h2 class="text-2xl font-bold mb-4">Students List</h2>

<table class="min-w-full bg-white border">
    <thead>
        <tr>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Student ID</th>
            <th class="border px-4 py-2">Department</th>
            <th class="border px-4 py-2">Degree</th>
            <th class="border px-4 py-2">Major</th>
            <th class="border px-4 py-2">Semester</th>
            <th class="border px-4 py-2">CGPA</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td class="border px-4 py-2"><?php echo $row['name']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['student_id']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['department']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['degree']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['major']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['semester']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['cgpa']; ?></td>
            <td class="border px-4 py-2 space-x-2">
                <a class="bg-yellow-400 text-white px-2 py-1 rounded" href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="bg-blue-600 text-white px-2 py-1 rounded" href="print_student.php?id=<?php echo $row['id']; ?>" target="_blank">Print</a>
                <?php if ($is_admin) { ?>
                    <a class="bg-red-600 text-white px-2 py-1 rounded" href="delete_student.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
