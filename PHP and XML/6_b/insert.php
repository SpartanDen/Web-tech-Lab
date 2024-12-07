<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xml = simplexml_load_file('history.xml');
    $civilization = $xml->addChild('civilization');
    $civilization->addChild('name', $_POST['name']);
    $civilization->addChild('date', $_POST['date']);
    $civilization->addChild('description', $_POST['description']);
    $image = $_FILES['image']['name'];
    $civilization->addChild('image', $image);
    move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/$image");
    file_put_contents('history.xml', $xml->asXML());
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Civilization</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<header>
    <h1>Add New Civilization</h1>
</header>

<div class="container">
    <form action="insert.php" method="POST" enctype="multipart/form-data">
        <label for="name">Civilization Name</label>
        <input type="text" name="name" required>

        <label for="date">Founded</label>
        <input type="text" name="date" required>

        <label for="description">Description</label>
        <textarea name="description" required></textarea>

        <label for="image">Image</label>
        <input type="file" name="image" required>

        <button type="submit">Add Civilization</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 World Civilizations | All Rights Reserved</p>
</footer>

</body>
</html>
