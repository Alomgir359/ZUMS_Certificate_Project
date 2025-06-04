<?php
$conn = mysqli_connect('localhost', 'root', '12345', 'student_portal');
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
