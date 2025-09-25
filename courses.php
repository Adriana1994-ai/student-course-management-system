<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>📚 Courses</h2>

    <!-- Formular pentru adăugare curs -->
    <form method="POST" class="mb-3">
        <input type="text" name="title" placeholder="Course Title" required class="form-control mb-2">
        <input type="number" name="credits" placeholder="Credits" required class="form-control mb-2">
        <button type="submit" name="add" class="btn btn-primary">Add Course</button>
    </form>

<?php
// -------------------- ADD --------------------
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $credits = $_POST['credits'];
    $conn->query("INSERT INTO Courses (title, credits) VALUES ('$title', '$credits')");
    header("Location: courses.php");
}

// -------------------- EDIT FORM --------------------
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM Courses WHERE course_id=$id");
    $row = $result->fetch_assoc();
    ?>
    <h3>Edit Course</h3>
    <form method="POST" class="mb-3">
        <input type="hidden" name="course_id" value="<?php echo $row['course_id']; ?>">
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required class="form-control mb-2">
        <input type="number" name="credits" value="<?php echo $row['credits']; ?>" required class="form-control mb-2">
        <button type="submit" name="update" class="btn btn-success">Update Course</button>
    </form>
<?php
}

// -------------------- UPDATE --------------------
if (isset($_POST['update'])) {
    $id = $_POST['course_id'];
    $title = $_POST['title'];
    $credits = $_POST['credits'];
    $conn->query("UPDATE Courses SET title='$title', credits='$credits' WHERE course_id=$id");
    header("Location: courses.php");
}

// -------------------- LISTARE --------------------
$result = $conn->query("SELECT * FROM Courses");
echo "<table class='table table-bordered'><tr><th>ID</th><th>Title</th><th>Credits</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['course_id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['credits']}</td>
            <td>
                <a href='courses.php?edit={$row['course_id']}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='courses.php?delete={$row['course_id']}' class='btn btn-danger btn-sm'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";

// -------------------- DELETE --------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM Courses WHERE course_id=$id");
    header("Location: courses.php");
}
?>

<!-- Buton Back -->
<a href="index.php" class="btn btn-secondary mt-3">⬅ Back to Home</a>

</div>
</body>
</html>
