<?php
if (!isset($_GET['name'])) {
    die('Error: Civilization name not specified.');
}

$name = $_GET['name'];
$xml = simplexml_load_file('history.xml');
$civilization = null;

foreach ($xml->civilization as $civ) {
    if ($civ->name == $name) {
        $civilization = $civ;
        break;
    }
}

if ($civilization === null) {
    die('Error: Civilization not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details of <?php echo htmlspecialchars($civilization->name); ?></title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<header>
    <h1>Details of <?php echo htmlspecialchars($civilization->name); ?></h1>
</header>

<div class="container">
    <div class="civilization-detail">
        <img src="<?php echo htmlspecialchars($civilization->image); ?>" alt="Civilization Image" class="civilization-img">
        <div class="civilization-info">
            <h3>Name: <?php echo htmlspecialchars($civilization->name); ?></h3>
            <p><strong>Founded:</strong> <?php echo htmlspecialchars($civilization->date); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($civilization->description); ?></p>
        </div>
    </div>
    <a href="edit.php?name=<?php echo htmlspecialchars($civilization->name); ?>" class="btn btn-warning">Edit Civilization</a>
    <a href="index.php" class="btn btn-primary">Back to Civilizations</a>
</div>

<footer>
    <p>&copy; 2024 World Civilizations | All Rights Reserved</p>
</footer>

</body>
</html>
