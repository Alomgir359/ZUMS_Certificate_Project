<?php
include 'config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    die("Unauthorized access. Please log in.");
}

$user = $_SESSION['user'];

// Handle insert form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO students_info (student_name, student_id, department, degree, major, semester, cgpa)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssd',
        $_POST['student_name'], $_POST['student_id'], $_POST['department'],
        $_POST['degree'], $_POST['major'], $_POST['semester'], $_POST['cgpa']
    );

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to dashboard if insert is successful
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Failed to save data. Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Student Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-3xl p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-blue-700">Insert Student Information</h2>
        
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-700">Student's Name</label>
                <input name="student_name" required placeholder="Enter name"
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Student's ID</label>
                <input name="student_id" required placeholder="Enter ID"
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Department/Name of School</label>
                <input name="department" required placeholder="Enter department"
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Name of Degree</label>
                <input name="degree" required placeholder="Enter degree"
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Major</label>
                <input name="major" required placeholder="Enter major"
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
                <label class="block mb-1 text-gray-700">Semester</label>
                <input name="semester" required placeholder="Enter semester"
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 text-gray-700">CGPA</label>
                <input type="number" step="0.01" name="cgpa" required placeholder="Enter CGPA"
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div class="md:col-span-2 text-center space-x-5">
                <a href="dashboard.php"
                     class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded font-semibold transition duration-200">
                    <span>⬅</span> Back to Dashboard
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded font-semibold transition duration-200">
                    Submit
                </button>
   
            </div>
        </form>
    </div>

</body>
</html>
