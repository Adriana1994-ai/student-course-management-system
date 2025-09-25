<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Instructors</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>👨‍🏫 Instructors</h2>

    <!-- Formular pentru adăugare profesor -->
    <form method="POST" class="mb-3">
        <input type="text" name="name" placeholder="Instructor Name" required class="form-control mb-2">
        <input type="text" name="department" placeholder="Department" required class="form-control mb-2">
        <button type="submit" name="add" class="btn btn-primary">Add Instructor</button>
    </form>

<?php
// -------------------- ADD --------------------
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $conn->query("INSERT INTO Instructors (name, department) VALUES ('$name', '$department')");
    header("Location: instructors.php");
}

// -------------------- EDIT FORM --------------------
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM Instructors WHERE instructor_id=$id");
    $row = $result->fetch_assoc();
    ?>
    <h3>Edit Instructor</h3>
    <form method="POST" class="mb-3">
        <input type="hidden" name="instructor_id" value="<?php echo $row['instructor_id']; ?>">
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required class="form-control mb-2">
        <input type="text" name="department" value="<?php echo $row['department']; ?>" required class="form-control mb-2">
        <button type="submit" name="update" class="btn btn-success">Update Instructor</button>
    </form>
<?php
}

// -------------------- UPDATE --------------------
if (isset($_POST['update'])) {
    $id = $_POST['instructor_id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $conn->query("UPDATE Instructors SET name='$name', department='$department' WHERE instructor_id=$id");
    header("Location: instructors.php");
}

// -------------------- LISTARE --------------------
$result = $conn->query("SELECT * FROM Instructors");
echo "<table class='table table-bordered'><tr><th>ID</th><th>Name</th><th>Department</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['instructor_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['department']}</td>
            <td>
                <a href='instructors.php?edit={$row['instructor_id']}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='instructors.php?delete={$row['instructor_id']}' class='btn btn-danger btn-sm'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";

// -------------------- DELETE --------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM Instructors WHERE instructor_id=$id");
    header("Location: instructors.php");
}
?>

<!-- Buton Back -->
<a href="index.php" class="btn btn-secondary mt-3">⬅ Back to Home</a>

</div>
</body>
</html>