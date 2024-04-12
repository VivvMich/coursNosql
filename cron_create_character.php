<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'vendor/autoload.php';
require_once 'tools.php';

$pdo = new PDO("mysql:host=localhost;dbname=nosql", "formateur", "1234");

// API Character creator;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://randomuser.me/api/?results=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$res = json_decode($response, true);

$fake_firstname = $res["results"][0]["name"]["first"];
$fake_lastname = $res["results"][0]["name"]["last"];

// NO SQL, Curse Object
try {
    $client = new \MongoDB\Client("mongodb://localhost:27017");
    $database = $client->selectDatabase('object');
    $collection = $database->selectCollection('curse_object');

    $objects = $collection->find()->toArray();
    $nbr_objects = count($objects);
    $name_objects = $objects[rand(0, $nbr_objects - 1)]['name'];
    $curse_objects = $objects[rand(0, $nbr_objects - 1)]['curse'];

    $age = rand(18, 106);

    $sql = "INSERT INTO owner(firstname_owner, lastname_owner, age_owner, object_owner, curse_object_owner) VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    if( $stmt->execute([$fake_firstname, $fake_lastname, $age, $name_objects, $curse_objects])) {
    addLog("The cursed object " . $name_objects . " was given to " . $fake_firstname . " " . $fake_lastname . ".");
    }else{
        addLog("Error - The cursed object the cursed object could not have been given");
    }

}catch (Exception $e) {
    addLog($e->getMessage());
}




// * * * * * /usr/bin/php '/var/www/html/NOSQL/cron_create_character.php'




