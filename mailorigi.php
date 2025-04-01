<?php
$betreiberSite 	   = "mlaemmler.bplaced.net";
$eigeneMailadresse = "max.laemmler@edu.tbz.ch";
$empfaenger 	   =  $eigeneMailadresse;

// echo "<pre>".print_r($_REQUEST, true)."</pre>"; //zum testen

$mailNam 	= "";
$mailAdr 		= "";
$betreff		= "";
$mailMsg  		= "";
if (isset($_REQUEST["btn_mailclear"])) {
    $_REQUEST["btn_mailclear"] = false;
}
function checkText($uebergabeWort) {
    $umlaute = array("<",">","/","\\","&","ä", "ö", "ü", "Ä", "Ö", "Ü", "ß", "à","á","é","è","C","ç","ñ","Ñ","õ","ó","ò","ú");
    $ersatz = array(  "", "", "", "" ,"u","ae","oe","ue","Ae","Oe","Ue","ss","a","a","e","e","C","c","n","N","o","o","o","u");
    return str_replace ($umlaute,$ersatz,$uebergabeWort);
}


if ( isset($_REQUEST["btn_mailsend"])) {
    $mailNam	= checkText($_REQUEST["mailNam"]);
    $mailAdr 	= checkText($_REQUEST["mailAdr"]);
//  $betreff	= checkText($_REQUEST["betreff"]);
    $mailMsg	= checkText($_REQUEST["mailMsg"]);
    $fehlers = "";
    if ($mailNam == null || $mailNam == "") {
        $fehlers = $fehlers."<li class='fehlermeldung'>Geben Sie bitte Ihren Namen an.</li>";
    }
    if ($mailAdr == null || $mailAdr == "") {
        $fehlers = $fehlers."<li class='fehlermeldung'>Ohne E-Mail-Adresse K&ouml;nnen wir Sie nicht so gut kontaktieren.</li>";
    }
//  if ($betreff == null || $betreff == "") {
//      $fehlers = $fehlers."<li class='fehlermeldung'>Ein Betreff w&auml;re auch noch gut.</li>";
//  }
    if ($mailMsg == null || $mailMsg == "") {
        $fehlers = $fehlers."<li class='fehlermeldung'>Bitte noch um eine Mitteilung.</li>";
    }
    
    if ($fehlers == "") {
        $nachrichtErhalten = "Die Nachricht wurde gesendet.";
        $sender 		= $mailAdr;
        $mailtext 		= "<br>Name:<br>".$mailNam
        ."<br><br>Email:<br>".$mailAdr
//      ."<br><br>Betreff:<br>".$betreff
        ."<br><br>Mitteilung:<br>".$mailMsg
        ."<br><br>Mit freundlichen Gruessen:<br>".$empfaenger;

        $isSent = false;
        //Mail an Betreiber der Website
        $isSent = @mail($empfaenger
						, "Nachricht von: ".$betreiberSite." :".$betreff." "
						, "<p>Folgende Nachricht kommt von einem nicht eingeloggten Benutzer der Website ".$betreiberSite.":<br><br>".$mailtext."</p>"
						, "From: $sender\n" . "Content-Type: text/html; charset=utf-8\n");
        
        //Mail an Benutzer/Besucher der Website
        if ($isSent) {
            $isSent = mail($sender
						, "Danke von ".$betreiberSite
						, "<p>".$nachrichtErhalten."<br><br>Folgende Angaben hast Du mir gemacht: <br>".$mailtext."</p>"
						, "From: ".$empfaenger."\n" . "Content-Type: text/html; charset=utf-8\n");
        }
        if ($isSent) {
            echo "<p class='okMeldung'><i class='fa fa-check'></i> ".$nachrichtErhalten;
        } else {
            echo "<p class='nokMeldung'><i class='fa fa-remove'></i> Die Nachricht konnte nicht gesendet werden";
        }

    } else {
        echo "<div class='row' id='mailformerrors'><section><ul>".$fehlers."</ul></section></row>";
    }
}

?>