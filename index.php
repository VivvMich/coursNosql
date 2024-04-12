<?php
require_once 'vendor/autoload.php';

$client = new \MongoDB\Client("mongodb://localhost:27017");

$database = $client->selectDatabase('objet');
$collection = $database->selectCollection('weapon');

$weapon= [
    "name" => "Arc",
];

$result = $collection->insertOne($doc); // Ajout d'un document
echo "Nouvel ID : " . $result->getInsertedId(); //Recupère le dernier ID inseré.
echo "<br>";

$docs = [
    [
        "name" =>  "Jean Michel",
        'email' => "momo@gmail.com"
    ],
    [
        "name" => "Michel Jean",
        "email"=> "Omom@gmail.com"
    ]
];

$results = $collection->insertMany($docs); // Ajout de plusieurs documments
echo "Insertion " . $results->getInsertedCount() . " de document";
echo "<br>";

// Les filtres

//$show = $collection->updateOne()