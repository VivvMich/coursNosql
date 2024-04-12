<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'vendor/autoload.php';

/**
 * Create and fill log file with message
 * @param String $message the message to add in log file, with date an time.
 * @return void
 */
function addLog(String $message) : void{
    $file = fopen("/var/www/html/NOSQL/theCurseLog.log", "a") or die("Impossible d'ouvrir le fichier.");
    date_default_timezone_set('Europe/Paris');
    $dateObj = new DateTime();
    $date = $dateObj->format('d-m-Y H:i:s');
    $fullMessage = $date . " : " . $message . "\n";
    fwrite($file, $fullMessage);
}

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
    $rand = rand(0, $nbr_objects - 1);
    $name_objects = $objects[$rand]['name'];
    $curse_objects = $objects[$rand]['curse'];

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




