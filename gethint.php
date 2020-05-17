<?php
// Array with names
$a[] = "NBA";
$a[] = "Trade";
$a[] = "GOAT";
$a[] = "lakers";
$a[] = "clippers";
$a[] = "warriors";
$a[] = "curry";
$a[] = "lebrick";
$a[] = "westbrook";
$a[] = "mvp";
$a[] = "rookie";
$a[] = "covid-19";
$a[] = "james";
$a[] = "championship";
$a[] = "jordan";
$a[] = "johnson";
$a[] = "fundamental";
$a[] = "atlanta";
$a[] = "boston";
$a[] = "brooklyn";
$a[] = "oklahoma";
$a[] = "Spurs";
$a[] = "playoffs";
$a[] = "choke";
$a[] = "harden";
$a[] = "giannis";
$a[] = "klay";
$a[] = "dennis rodman";
$a[] = "quarter";
$a[] = "elfrid payton";
$a[] = "philly";
$a[] = "76ers";
$a[] = "bogut";
$a[] = "draymond";
$a[] = "dpoy";
$a[] = "ezelis";
$a[] = "varejao";
$a[] = "jr smith";
$a[] = "grant hill";
$a[] = "iguodala";
$a[] = "block";
$a[] = "3-6";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>
