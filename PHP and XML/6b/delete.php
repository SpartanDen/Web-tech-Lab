<?php
$xml = simplexml_load_file('history.xml');
foreach ($xml->civilization as $index => $civilization) {
    if ($civilization->name == $_GET['name']) {
        unset($xml->civilization[$index]);
        break;
    }
}

file_put_contents('history.xml', $xml->asXML());
header('Location: index.php');
?>
