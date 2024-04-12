<?php 

function sendMessage(string $message, string $status, string $location, int|null $page = null, bool $hasAIdBefore = false) :void {
    // Si il y a un id avant nous remplaceront le "?" de l'url
    // par un &
    $replace = !$hasAIdBefore ? "?" : "&";
    if ($page == null){
        header("Location:$location" . $replace . "message=$message&status=$status");
        exit;
    }else{
        header("Location:$location" . $replace . "page=$page&message=$message&status=$status");
        exit; 
    }

}

function addLog(String $message) {
    $file = fopen("theCurseLog.txt", "a") or die("Impossible d'ouvrir le fichier.");
    $dateObj = new DateTime();
    $date = $dateObj->format('d-m-Y H:i:s');
    $fullMessage = $date . " : " . $message . "\n";
    fwrite($file, $fullMessage);
}


function dateToFrenchDate(DateTime $date) : String {
    $formatter = new IntlDateFormatter("fr_FR", IntlDateFormatter::LONG );
    $formatter->setPattern('d MMMM Y');
    return $formatter->format($date) . "( " .getAgeFromDate($date) . " ans )";
}

function getAgeFromDate(DateTime $date) : int {
    return ((int)date_diff($date, new DateTime('now'))->y);
}