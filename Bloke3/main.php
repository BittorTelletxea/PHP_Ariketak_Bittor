<?php
require_once "Korrikalari.php";
require_once "Txapelketa.php";

$Jaime = new Korrikalari("Jaime" ,"3", "10");
$Korrikalaria->lasterketagehitu(10);
$Korrikalaria->lasterketagehitu(15);
$Korrikalaria->lasterketagehitu(30);
$Korrikalaria->lasterketagehitu(11);

$Ricardo = new Korrikalari("Rocardo" ,"1", "14");
$Korrikalaria->lasterketagehitu(10);
$Korrikalaria->lasterketagehitu(15);
$Korrikalaria->lasterketagehitu(30);
$Korrikalaria->lasterketagehitu(11);
echo "denbora ". $Korrikalaria->getDenborak();  

$txapelketa = new Txapelketa();
$txapelketa->korrikalariagehitu($Jaime);
$txapelketa->gehitulasterketakorrikalariari("4","12");
$txapelketa
?>
