<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Le Bizaratator</title>
</head>
<body>

<h1 class="text-center">AdopteUnObjetMaudit.com</h1>

<h3 class="text-center">Listes des objets maudits</h3>
<div class="text-center">
    <a class="text-center" href="create_weapon_form.php">Créer un objet maudit</a>
</div>
<?php
require_once 'vendor/autoload.php';
$client = new \MongoDB\Client("mongodb://root:1234@mongo:27017/");
$database = $client->selectDatabase('object');
$collection = $database->selectCollection('curse_object');
$objects = $collection->find();

ob_start();
?>

<table class="table">
    <thead>
        <tr>
            <th>Nom de l'objet</th>
            <th>Nom de la malédiction</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach ($objects as $ob) {
    echo "<tr><td>$ob[name]</td><td>$ob[curse]</td></tr>";
}

?>

    </tbody>
</table>
</body>
</html>