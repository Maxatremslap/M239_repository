<?php
// mail.php - processes the contact form via AJAX
header('Content-Type: application/json');

$betreiberSite    = "furniturestoresl239.ch"; // your domain
$eigeneMailadresse = "max.laemmler@edu.tbz.ch";
$empfaenger      = $eigeneMailadresse; // the recipient

// Function to clean input from unwanted characters
function checkText($uebergabeWort) {
    $umlaute = array("<",">","/","\\","&","ä", "ö", "ü", "Ä", "Ö", "Ü", "ß", "à","á","é","è","C","ç","ñ","Ñ","õ","ó","ò","ú");
    $ersatz  = array("", "", "", "", "u", "ae", "oe", "ue", "Ae", "Oe", "Ue", "ss", "a", "a", "e", "e", "C", "c", "n", "N", "o", "o", "o", "u");
    return str_replace($umlaute, $ersatz, $uebergabeWort);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mailNam  = checkText($_POST["name"]);
    $mailAdr  = checkText($_POST["email"]);
    $betreff  = checkText($_POST["subject"]);
    $mailMsg  = checkText($_POST["message"]);

    $errors = array();

    if (empty($mailNam)) {
        $errors[] = "Bitte geben Sie Ihren Namen an.";
    }
    if (empty($mailAdr)) {
        $errors[] = "Bitte geben Sie Ihre E-Mail-Adresse an.";
    }
    if (empty($mailMsg)) {
        $errors[] = "Bitte geben Sie eine Nachricht ein.";
    }

    if (count($errors) > 0) {
        echo json_encode(array("status" => "error", "msg" => implode("<br>", $errors)));
        exit;
    }

    $mailtext = "<br>Name:<br>" . $mailNam
        . "<br><br>Email:<br>" . $mailAdr
        . "<br><br>Betreff:<br>" . $betreff
        . "<br><br>Nachricht:<br>" . $mailMsg
        . "<br><br>Mit freundlichen Grüßen,<br>" . $empfaenger;

    // Use a From address that is on your domain.
    // Add the sender's email as Reply-To so you can respond.
    $headers  = "From: noreply@" . $betreiberSite . "\r\n";
    $headers .= "Reply-To: " . $mailAdr . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    if (mail($empfaenger, $betreff, $mailtext, $headers)) {
        echo json_encode(array("status" => "success", "msg" => "Die Nachricht wurde erfolgreich gesendet."));
    } else {
        echo json_encode(array("status" => "error", "msg" => "Die Nachricht konnte nicht gesendet werden."));
    }
    exit;
}
?>
