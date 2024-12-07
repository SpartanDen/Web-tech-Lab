<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $sql = "INSERT INTO events (title, description, date) VALUES ('$title', '$description', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>New event added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
$sql = "SELECT * FROM events ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historical Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="dark-theme">
    <div class="container">
        <h1>Write and View Historical Events</h1>
        <h2>Add a New Event</h2>
        <form action="index.php" method="POST">
            <label for="title">Event Title</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Event Description</label>
            <textarea name="description" id="description" required></textarea>

            <label for="date">Event Date</label>
            <input type="date" name="date" id="date" required>

            <button type="submit">Submit Event</button>
        </form>
        <h2>Historical Events</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="event">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <small>Event Date: <?php echo $row['date']; ?></small>
                </div>
                <hr>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
