<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'vendor/autoload.php';

$pdo = new PDO("mysql:host=localhost;dbname=nosql", "formateur", "1234");


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://randomuser.me/api/?results=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$res = json_decode($response, true);

$fake_firstname = $res["results"][0]["name"]["first"];
$fake_lastname = $res["results"][0]["name"]["last"];

$age = rand(18, 106);

$sql = "INSERT INTO owner(firstname_owner, lastname_owner, age_owner, object_owner, curse_object_owner) VALUES (?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$fake_firstname, $fake_lastname, $age, null, null]);

// * * * * * /usr/bin/php '/var/www/html/NOSQL/cron_create_character.php'


$client = new \MongoDB\Client("mongodb://localhost:27017");
$database = $client->selectDatabase('object');
$collection = $database->selectCollection('curse_object');

$objects = $collection->find()->toArray();
$nbr_objects = count($objects);

var_dump($objects[rand(0, $nbr_objects)]);