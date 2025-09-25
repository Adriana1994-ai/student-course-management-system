<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Course Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5 text-center">
    <h1 class="mb-4">📘 Student Course Management System</h1>

    <!-- Welcome message -->
    <div class="alert alert-info">
        <h4>Welcome!</h4>
        <p>This is your project for managing students, courses, instructors, and enrollments.<br>
        Use the menu below to navigate between different sections.</p>
    </div>

    <!-- Navigation buttons -->
    <div class="row justify-content-center">
        <div class="col-md-3">
            <a href="students.php" class="btn btn-outline-primary w-100 mb-3">👩‍🎓 Manage Students</a>
        </div>
        <div class="col-md-3">
            <a href="courses.php" class="btn btn-outline-success w-100 mb-3">📚 Manage Courses</a>
        </div>
        <div class="col-md-3">
            <a href="instructors.php" class="btn btn-outline-warning w-100 mb-3">👨‍🏫 Manage Instructors</a>
        </div>
        <div class="col-md-3">
            <a href="enrollments.php" class="btn btn-outline-dark w-100 mb-3">📝 Manage Enrollments</a>
        </div>
    </div>

    <!-- Dashboard with statistics -->
    <?php
    $students = $conn->query("SELECT COUNT(*) as total FROM Students")->fetch_assoc()['total'];
    $courses = $conn->query("SELECT COUNT(*) as total FROM Courses")->fetch_assoc()['total'];
    $instructors = $conn->query("SELECT COUNT(*) as total FROM Instructors")->fetch_assoc()['total'];
    $enrollments = $conn->query("SELECT COUNT(*) as total FROM Enrollments")->fetch_assoc()['total'];
    ?>

    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">👩‍🎓 Students</h5>
                    <p class="card-text"><?php echo $students; ?> total</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">📚 Courses</h5>
                    <p class="card-text"><?php echo $courses; ?> total</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">👨‍🏫 Instructors</h5>
                    <p class="card-text"><?php echo $instructors; ?> total</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">📝 Enrollments</h5>
                    <p class="card-text"><?php echo $enrollments; ?> total</p>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>