<?php
if (!isset($_GET['name'])) {
    die('Error: Civilization name not specified.');
}

$name = $_GET['name'];
$xml = simplexml_load_file('history.xml');
$civilizationIndex = null;

foreach ($xml->civilization as $index => $civ) {
    if ($civ->name == $name) {
        $civilizationIndex = $index;
        break;
    }
}

if ($civilizationIndex === null) {
    die('Error: Civilization not found.');
}

unset($xml->civilization[$civilizationIndex]);
file_put_contents('history.xml', $xml->asXML());

header('Location: index.php');
exit();
?>
