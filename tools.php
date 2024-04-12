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

/**
 * Cette fonction va créer des inputs radio à partir 
 * de la base de données.
 * CollumName -> Correspond au nom de la colonne dans la BDD.
 * dBValue -> Correspond à la valeur venu de la BDD pour selectioner l'input radio parmis les $values.
 */
function createCheckButton(string $collumnName, string $dBValue, array $values) : string {
    $result = '';
    foreach ($values as $value) {
    $result .= "<div class='form-check'>";
    $upper = ucfirst($value);
        if($value === $dBValue){
            $result .= "<input class='form-check-input' type='radio' name='$collumnName' checked value='$value' id=''>";
        }else{
            $result .= "<input class='form-check-input' type='radio' name='$collumnName' value='$value' id=''>";
        }
    
    $result .= "<label class='form-check-label' for='$collumnName'>$upper</label></div>";
    }
    return $result;
}


function dateToFrenchDate(DateTime $date) : String {
    $formatter = new IntlDateFormatter("fr_FR", IntlDateFormatter::LONG );
    $formatter->setPattern('d MMMM Y');
    return $formatter->format($date) . "( " .getAgeFromDate($date) . " ans )";
}

function getAgeFromDate(DateTime $date) : int {
    return ((int)date_diff($date, new DateTime('now'))->y);
}