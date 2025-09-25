<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>👩‍🎓 Students</h2>

    <!-- Formular pentru adăugare student -->
    <form method="POST" class="mb-3">
        <input type="text" name="name" placeholder="Name" required class="form-control mb-2">
        <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
        <button type="submit" name="add" class="btn btn-primary">Add Student</button>
    </form>

<?php
// -------------------- ADD --------------------
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("INSERT INTO Students (name, email) VALUES ('$name', '$email')");
    header("Location: students.php");
}

// -------------------- EDIT FORM --------------------
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM Students WHERE student_id=$id");
    $row = $result->fetch_assoc();
    ?>
    <h3>Edit Student</h3>
    <form method="POST" class="mb-3">
        <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required class="form-control mb-2">
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required class="form-control mb-2">
        <button type="submit" name="update" class="btn btn-success">Update Student</button>
    </form>
<?php
}

// -------------------- UPDATE --------------------
if (isset($_POST['update'])) {
    $id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("UPDATE Students SET name='$name', email='$email' WHERE student_id=$id");
    header("Location: students.php");
}

// -------------------- LISTARE --------------------
$result = $conn->query("SELECT * FROM Students");
echo "<table class='table table-bordered'><tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['student_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
                <a href='students.php?edit={$row['student_id']}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='students.php?delete={$row['student_id']}' class='btn btn-danger btn-sm'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";

// -------------------- DELETE --------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM Students WHERE student_id=$id");
    header("Location: students.php");
}
?>

<!-- Buton Back -->
<a href="index.php" class="btn btn-secondary mt-3">⬅ Back to Home</a>

</div>
</body>
</html>