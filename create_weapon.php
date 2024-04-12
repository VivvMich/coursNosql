<?php
require_once 'vendor/autoload.php';
require "tools.php";

/**
 * This function check if value of key from any array is null or undefined.
 * @autor MichôtrucheSama The great Vizir of Chaos.
 * @param $array
 * @return bool
 */

function checkPost($array) : bool {
    foreach ($array as $key => $value) {
        if (empty($value) || !isset($value)) {
            return false;
        }
    }
    return true;
}

if ( checkPost($_POST) ) {
    $client = new \MongoDB\Client("mongodb://localhost:27017");
    $database = $client->selectDatabase('object');
    $collection = $database->selectCollection('curse_object');
    $curse_object = [
        "name" => $_POST["objet_name"],
        "curse" => $_POST["objet_curse"]
    ];
    $result = $collection->insertOne($curse_object); // Insert value in collection
    sendMessage("Invocation d'un objet maudit reussi", "success", "create_weapon_form.php");
}else {
    sendMessage("Le formulaire n'est pas valide", "failed", "create_weapon_form.php");
}





//
//
//echo "Nouvel ID : " . $result->getInsertedId(); //Recupère le dernier ID inseré.
//echo "<br>";
//
//$docs = [
//    [
//        "name" =>  "Jean Michel",
//        'email' => "momo@gmail.com"
//    ],
//    [
//        "name" => "Michel Jean",
//        "email"=> "Omom@gmail.com"
//    ]
//];
//
//$results = $collection->insertMany($docs); // Ajout de plusieurs documments
//echo "Insertion " . $results->getInsertedCount() . " de document";
//echo "<br>";

// Les filtres

//$show = $collection->updateOne()