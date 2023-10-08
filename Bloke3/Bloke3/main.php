<?php
require_once "Korrikalari.php";
require_once "Txapelketa.php";

$Jaime = new Korrikalari("Jaime" ,"3", "10");
$Jaime->lasterketagehitu(10);
$Jaime->lasterketagehitu(15);
$Jaime->lasterketagehitu(30);
$Jaime->lasterketagehitu(11);
echo "denborak: ". $Jaime->getDenborak();  

$Ricardo = new Korrikalari("Rocardo" ,"1", "14");
$Ricardo->lasterketagehitu(40);
$Ricardo->lasterketagehitu(34);
$Ricardo->lasterketagehitu(32);
$Ricardo->lasterketagehitu(21);
echo "denborak: ". $Ricardo->getDenborak();  

$Jose = new Korrikalari("Jose" ,"2", "50");
$Jose->lasterketagehitu(16);
$Jose->lasterketagehitu(19);
$Jose->lasterketagehitu(31);
$Jose->lasterketagehitu(55);
echo "denborak: ". $Jose->getDenborak();  

$Juan = new Korrikalari("Juan" ,"4", "12");
$Juan->lasterketagehitu(34);
$Juan->lasterketagehitu(89);
$Juan->lasterketagehitu(23);
$Juan->lasterketagehitu(54);
echo "denborak: ". $Juan->getDenborak();  

$txapelketa = new Txapelketa();
$txapelketa->korrikalariagehitu($Jaime);
$txapelketa->korrikalariagehitu($Ricardo);
$txapelketa->korrikalariagehitu($Jose);
$txapelketa->korrikalariagehitu($Juan);

$txapelketa->gehitulasterketakorrikalariari("4","12");
echo "Txapelketaren batazbesteko denbora: ". $txapelketa->batazBestekoDenbora() . "<br>";
echo "Txapelketaren korrikalari bizkorrena: ". $txapelketa->bizkorrena()."<br>";
echo "Txapelketaren 15 segundu baino gehiagoko korrikalaraiak: ". $txapelketa->korrikalara15()."<br>";
echo "E-z amaitutako korrikalariak: ". $txapelketa->eBukatuak();

?>
