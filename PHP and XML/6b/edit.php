<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    
    // Load the XML file
    $xml = simplexml_load_file('history.xml');
    foreach ($xml->civilization as $civilization) {
        if ($civilization->name == $_GET['name']) {
            $civilization->name = $name;
            $civilization->date = $date;
            $civilization->description = $description;
            if ($image) {
                $civilization->image = $image;
                move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/$image");
            }
            break;
        }
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
    <?php
    $xml = simplexml_load_file('history.xml');
    $civilization = null;
    foreach ($xml->civilization as $civ) {
        if ($civ->name == $_GET['name']) {
            $civilization = $civ;
            break;
        }
    }
    ?>
    <form action="edit.php?name=<?php echo $_GET['name']; ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Civilization Name</label>
        <input type="text" name="name" value="<?php echo $civilization->name; ?>" required>

        <label for="date">Date</label>
        <input type="text" name="date" value="<?php echo $civilization->date; ?>" required>

        <label for="description">Description</label>
        <textarea name="description" required><?php echo $civilization->description; ?></textarea>

        <label for="image">Image</label>
        <input type="file" name="image">

        <button type="submit">Save Changes</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 World Civilizations | All Rights Reserved</p>
</footer>

</body>
</html>
