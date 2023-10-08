<?php
class korrikalari{
    private $izena;
    private $kodea;
    private $denborak=array();

    public function korrikalari($izena, $kodea, $denborak){
        $this->$izena=$izena;
        $this->$kodea=$kodea;
        $this->$denborak=$denborak;

    }
    public function lasterketagehitu($lasterketa){
        try{
        if($lasterketa > 5 ){
            $denborak[] = $lasterketa;
            if(count($denborak) > 5){
                throw new Exception("5 lasterketa baino gehiago ditu", 1);
            }
        }else{
            throw new Exception("Lasterketa 5 segundu baino gutxigokoa da", 1);
        }
    }catch(Exception $e){
        echo $e->getMessage(), "<br>";
    }
    }
    public function getIzena()
    {
        return $this->izena;
    }

    public function getKodea()
    {
        return $this->kodea;
    }
    public function getDenborak()
    { 
        foreach ($this->$denborak as $demborak){
            return $demborak;
        }
    }
}