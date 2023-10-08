<?php
require_once 'Korrikalari.php';

class txapelketa {
    private $korrikalariak = array();

    public function korrikalariagehitu(Korrikalari $korrikalaria) {
        $kodea = $korrikalaria->getKodea();
        $this->korrikalariak[$kodea] = $korrikalaria;
    }

    public function gehitulasterketakorrikalariari($korrikalariKod, $denbora) {
        $korrikalaria = $this->korrikalariak[$korrikalariKod];
        $korrikalaria->lasterketagehitu($denbora);
    }

    public function batazBestekoDenbora() {
        $denborak = array();
        foreach ($this->korrikalariak as $korrikalari) {
            $denborak[] = $korrikalari->getDenborak();
        }
        $batezBestekoa = count($denborak);
        $osotara = array_sum($denborak);
        return $osotara / $batezBestekoa;
    }

    public function bizkorrena() {
        $denbora = 200;
        $bizkorrena = null;
        foreach ($this->korrikalariak as $korrikalari) {
            $denb = $korrikalari->getDenborak();
            if ($denb < $denbora) {
                $bizkorrena = $denb;
            }
        }
        return $bizkorrena;
    }

    public function korrikalara15() {
        $korrikalariMotel = array();
        foreach ($this->korrikalariak as $korrikalari) {
            $denbora = $korrikalari->getDenborak();
            if ($denbora > 15) {
                $korrikalariMotel[] = $korrikalari;
            }
        }
        return $korrikalariMotel;
    }

    public function eBukatuak() {
        $eBukatuakKorrikalariak = array();
        foreach ($this->korrikalariak as $korrikalari) {
            $izena = $korrikalari->getIzena();
            if (substr($izena, -1) === 'e') {
                $eBukatuakKorrikalariak[] = $korrikalari;
            }
        }
        return $eBukatuakKorrikalariak;
    }
    
}
?>
