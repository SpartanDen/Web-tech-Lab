<?php
$xml = simplexml_load_file('history.xml');
$civilization = null;
foreach ($xml->civilization as $civ) {
    if ($civ->name == $_GET['name']) {
        $civilization = $civ;
        break;
    }
}

if (!$civilization) {
    echo "Civilization not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $civilization->name; ?> - Details</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<header>
    <h1><?php echo $civilization->name; ?></h1>
</header>

<div class="container">
    <div class="details-card">
        <img src="assets/images/<?php echo $civilization->image; ?>" alt="<?php echo $civilization->name; ?>" class="details-img">
        <div class="details-content">
            <h2>Founded: <?php echo $civilization->date; ?></h2>
            <p><strong>Description:</strong> <?php echo $civilization->description; ?></p>
        </div>
    </div>
    <a href="index.php" class="btn btn-primary">Back to Civilizations</a>
</div>

<footer>
    <p>&copy; 2024 World Civilizations | All Rights Reserved</p>
</footer>

</body>
</html>
