<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Enrollments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>📝 Enrollments</h2>
    <form method="POST" class="mb-3">
        <select name="student_id" class="form-control mb-2" required>
            <option value="">Select Student</option>
            <?php
            $students = $conn->query("SELECT * FROM Students");
            while ($s = $students->fetch_assoc()) {
                echo "<option value='{$s['student_id']}'>{$s['name']}</option>";
            }
            ?>
        </select>
        <select name="course_id" class="form-control mb-2" required>
            <option value="">Select Course</option>
            <?php
            $courses = $conn->query("SELECT * FROM Courses");
            while ($c = $courses->fetch_assoc()) {
                echo "<option value='{$c['course_id']}'>{$c['title']}</option>";
            }
            ?>
        </select>
        <input type="text" name="grade" placeholder="Grade (e.g. A+)" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Add Enrollment</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_id = $_POST['student_id'];
        $course_id = $_POST['course_id'];
        $grade = $_POST['grade'];
        $conn->query("INSERT INTO Enrollments (student_id, course_id, grade) VALUES ('$student_id','$course_id','$grade')");
    }

    $result = $conn->query("SELECT e.enrollment_id, s.name as student, c.title as course, e.grade 
                            FROM Enrollments e
                            JOIN Students s ON e.student_id=s.student_id
                            JOIN Courses c ON e.course_id=c.course_id");
    echo "<table class='table table-bordered'><tr><th>ID</th><th>Student</th><th>Course</th><th>Grade</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['enrollment_id']}</td>
                <td>{$row['student']}</td>
                <td>{$row['course']}</td>
                <td>{$row['grade']}</td>
                <td><a href='?delete={$row['enrollment_id']}' class='btn btn-danger btn-sm'>Delete</a></td>
              </tr>";
    }
    echo "</table>";

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $conn->query("DELETE FROM Enrollments WHERE enrollment_id=$id");
        header("Location: enrollments.php");
    }
    ?>

    <a href="index.php" class="btn btn-secondary mt-3">⬅ Back to Home</a>
</div>
</body>
</html>
