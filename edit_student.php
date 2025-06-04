<?php
include 'auth.php';    // Session and auth check
include 'config.php';  // DB connection

// Check if 'id' is present
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch student info from DB
$query = "SELECT * FROM students_info WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) === 0) {
    echo "<script>alert('Student not found'); window.location.href='dashboard.php';</script>";
    exit;
}

$student = mysqli_fetch_assoc($result);

// If form submitted, update DB
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $cgpa = floatval($_POST['cgpa']);

    $update_query = "UPDATE students_info SET 
        student_name='$student_name',
        student_id='$student_id',
        department='$department',
        degree='$degree',
        major='$major',
        semester='$semester',
        cgpa=$cgpa
        WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>
                alert('Student info updated successfully!');
                window.location.href='dashboard.php';
              </script>";
        exit;
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Edit Student Info</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-indigo-50 via-purple-50 to-pink-50 min-h-screen flex items-center justify-center font-sans p-6">

<div class="bg-white rounded-3xl shadow-lg p-10 max-w-xl w-full">
    <h1 class="text-3xl font-bold text-indigo-700 mb-6">Edit Student Information</h1>

    <?php if (isset($error)): ?>
        <div class="mb-4 text-red-600 font-semibold"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-6">
        <div>
            <label for="student_name" class="block font-semibold text-indigo-700 mb-1">Student Name</label>
            <input id="student_name" name="student_name" type="text" required
                value="<?= htmlspecialchars($student['student_name']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="student_id" class="block font-semibold text-indigo-700 mb-1">Student ID</label>
            <input id="student_id" name="student_id" type="text" required
                value="<?= htmlspecialchars($student['student_id']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="department" class="block font-semibold text-indigo-700 mb-1">Department</label>
            <input id="department" name="department" type="text" required
                value="<?= htmlspecialchars($student['department']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="degree" class="block font-semibold text-indigo-700 mb-1">Degree</label>
            <input id="degree" name="degree" type="text" required
                value="<?= htmlspecialchars($student['degree']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="major" class="block font-semibold text-indigo-700 mb-1">Major</label>
            <input id="major" name="major" type="text" required
                value="<?= htmlspecialchars($student['major']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="semester" class="block font-semibold text-indigo-700 mb-1">Semester</label>
            <input id="semester" name="semester" type="text"  required
                value="<?= htmlspecialchars($student['semester']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="cgpa" class="block font-semibold text-indigo-700 mb-1">CGPA</label>
            <input id="cgpa" name="cgpa" type="number" step="0.01" min="0" max="4" required
                value="<?= htmlspecialchars($student['cgpa']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div class="flex justify-between items-center">
            <a href="dashboard.php" 
               class="px-6 py-3 bg-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-400 transition">
                ← Back
            </a>
            <button type="submit" 
                class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                Save
            </button>
        </div>
    </form>
</div>

</body>
</html>
