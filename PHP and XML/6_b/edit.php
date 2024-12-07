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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $civilization->name = $_POST['name'];
    $civilization->date = $_POST['date'];
    $civilization->description = $_POST['description'];
    
    if (isset($_FILES['image']['name']) && $_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $civilization->image = $image;
        move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/$image");
    }

    file_put_contents('history.xml', $xml->asXML());
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Civilization</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<header>
    <h1>Edit Civilization</h1>
</header>

<div class="container">
    <form action="edit.php?name=<?php echo htmlspecialchars($name); ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Civilization Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($civilization->name); ?>" required>

        <label for="date">Founded</label>
        <input type="text" name="date" value="<?php echo htmlspecialchars($civilization->date); ?>" required>

        <label for="description">Description</label>
        <textarea name="description" required><?php echo htmlspecialchars($civilization->description); ?></textarea>

        <label for="image">Image</label>
        <input type="file" name="image">

        <button type="submit">Update Civilization</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 World Civilizations | All Rights Reserved</p>
</footer>

</body>
</html>
