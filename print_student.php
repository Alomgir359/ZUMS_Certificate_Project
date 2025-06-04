<?php
include 'config.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students_info WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Print Student</title>
  <script>
    window.onload = () => {
      window.print();
    };
    window.onafterprint = () => {
      window.location.href = "dashboard.php";
    };
  </script>
  <style>
    body {
      font-family: 'Georgia', serif;
      background: #fefefe;
      padding: 50px;
      color: #000;
    }

    .certificate {
      border: 10px solid #1c1c1c;
      padding: 50px;
      max-width: 900px;
      margin: auto;
      position: relative;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header img {
      height: 80px;
    }

    .title {
      font-size: 26px;
      font-weight: bold;
      margin: 20px 0;
    }

    .subheading {
      font-size: 18px;
      margin-bottom: 20px;
      text-align: center;
    }

    .highlight {
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 30px;
      position: relative;
    }

    .highlight span {
      display: block;
      z-index: 2;
      position: relative;
    }

    .faded-logo {
      position: absolute;
      top: -30px;
      left: 50%;
      transform: translateX(-50%);
      opacity: 0.09;
      height: 170px;
      width: 250px;
      z-index: 1;
    }

    .content {
      font-size: 18px;
      line-height: 1.8;
      text-align: justify;
    }

    .footer {
      text-align: right;
      margin-top: 60px;
      font-weight: bold;
    }
  </style>
</head>
<body>
    <!-- 
<h2>Student Information</h2>
<div class="info"><strong>Student's Name:</strong> <?php echo $row['student_name']; ?></div>
<div class="info"><strong>Student's ID:</strong> <?php echo $row['student_id']; ?></div>
<div class="info"><strong>Name of School:</strong> <?php echo $row['department']; ?></div>
<div class="info"><strong>Name of Degree:</strong> <?php echo $row['degree']; ?></div>
<div class="info"><strong>Major:</strong> <?php echo $row['major']; ?></div>
<div class="info"><strong>Semester:</strong> <?php echo $row['semester']; ?></div>
<div class="info"><strong>CGPA:</strong> <?php echo $row['cgpa']; ?></div> -->

<div class="certificate">
  <div class="header">
    <img src="./assets/zums.png" alt="ZUMS Logo">
    <div class="title">Provisional Certificate</div>
  </div>

  <div class="subheading">This is to certify that</div>

  <div class="highlight">
    <span><?= htmlspecialchars($row['student_name']) ?></span>
    <span>(ID: <?= htmlspecialchars($row['student_id']) ?>)</span>
    <img class="faded-logo" src="./assets/znrfuniversity_logo.jpg" alt="Watermark Logo"> <!-- faded logo below name -->
  </div>

  <div class="content">
    a student of the <strong><?= htmlspecialchars($row['department']) ?></strong> of ZNRF University of Management Sciences,
    has fulfilled all requirements for the degree of <strong><?= htmlspecialchars($row['degree']) ?></strong>
    in <strong><?= htmlspecialchars($row['major']) ?></strong> in <strong><?= htmlspecialchars($row['semester']) ?></strong>.
    His cumulative grade point average (CGPA) is <strong><?= htmlspecialchars($row['cgpa']) ?></strong> on a scale of 4.00.
  </div>

  <div class="footer">
    Registrar
  </div>
</div>

</body>
</html>
