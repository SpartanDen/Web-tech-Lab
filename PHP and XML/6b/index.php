<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Civilizations</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<header>
    <h1>World Civilizations</h1>
    <p>Explore the ancient civilizations that shaped our world</p>
</header>

<div class="container">
    <a href="insert.php" class="btn btn-primary">Add Civilization</a>
    <div class="civilizations">
        <?php
        $xml = simplexml_load_file('history.xml');
        if (!$xml) {
            die('Error: Failed to load XML file.');
        }

        foreach ($xml->civilization as $civilization) {
            echo "
            <div class='card'>
                <img src='assets/images/{$civilization->image}' alt='{$civilization->name}' class='card-img'>
                <div class='card-body'>
                    <h3>{$civilization->name}</h3>
                    <p><strong>Founded:</strong> {$civilization->date}</p>
                    <p>{$civilization->description}</p>
                    <a href='edit.php?name={$civilization->name}' class='btn btn-warning'>Edit</a>
                    <a href='delete.php?name={$civilization->name}' class='btn btn-danger'>Delete</a>
                    <a href='civilizations.php?name={$civilization->name}' class='btn btn-info'>More Details</a>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 World Civilizations | All Rights Reserved</p>
</footer>

</body>
</html>
