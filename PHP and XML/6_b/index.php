<?php
$xml = simplexml_load_file('history.xml');
if (!$xml) {
    die('Error: Failed to load XML file.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civilizations</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<header>
    <h1>World Civilizations</h1>
    <a href="insert.php" class="btn btn-primary">Add New Civilization</a>
</header>

<div class="container">
    <div class="civilizations">
        <?php foreach ($xml->civilization as $civ): ?>
            <div class="civilization-card">
                <img src="<?php echo htmlspecialchars($civ->image); ?>" alt="Civilization Image" class="civilization-img">
                <div class="civilization-info">
                    <h3><?php echo htmlspecialchars($civ->name); ?></h3>
                    <p><strong>Founded:</strong> <?php echo htmlspecialchars($civ->date); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($civ->description); ?></p>
                    <div class="buttons">
                        <a href="civilizations.php?name=<?php echo htmlspecialchars($civ->name); ?>" class="btn btn-secondary">More Details</a>
                        <a href="edit.php?name=<?php echo htmlspecialchars($civ->name); ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?name=<?php echo htmlspecialchars($civ->name); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this civilization?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 World Civilizations | All Rights Reserved</p>
</footer>

</body>
</html>
