<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="TopMovie.php" method="post">
    <h1>TOP MOVIES, <?php echo $_POST["usuario"]?></h1>
    <p>FILAMREN IZENA: </p><input type="text" name="izena" >
    <p>ISAN ZENBAKIA: </p><input type="text" name="isan" >
    <p>FILAMREN URTEA: </p><input type="number" name="urtea" >
    <p>FILAMREN PUNTUAZIOA: </p><select name="zenbakiak">
        <option name="0" value="0">0</option>
        <option name="1" value="1">1</option>
        <option name="2" value="2">2</option>
        <option name="3" value="3">3</option>
        <option name="4" value="4">4</option>
        <option name="5" value="5">5</option>
    </select><br><br>
    <input type="submit" name="bidali" value="BIDALI">
</form> 
<?php
session_start();

if (isset($_POST["bidali"])) {
    $_SESSION["izena"] = $_POST["izena"];
    $_SESSION["isan"] = $_POST["isan"];
    $_SESSION["urtea"] = $_POST["urtea"];
    $_SESSION["zenbakiak"] = $_POST["zenbakiak"];
}

class TopMovies {
    private $izena;
    private $isan;
    private $urtea;
    private $puntuazioa;

    public function __construct() {
        $json = file_get_contents("JSON/peliculas.json");
        $datuak = json_decode($json, true);
        
        if (isset($_POST["bidali"])) {
            $this->izena = $this->izena();
            $this->isan = $this->ISAN();
            $this->urtea = $this->urtea();
            $this->puntuazioa = $this->puntuazioa();
            echo "<br>Pelikula izena: " . $this->izena . "<br>" . "ISAN zenbakia" . $this->isan . "<br>" . "Pelikula urtea: " . $this->urtea
                . "<br> Pelikularen puntuazioa: " . $this->puntuazioa . "<br><hr>";

            $pelikula = array(
                "izena" => $this->izena,
                "isan" => $this->isan,
                "urtea" => $this->urtea,
                "puntuazioa" => $this->puntuazioa
            );
            $datuak = $this->aktualizatua($datuak, $pelikula);
            $datuak = $this->ezabatu($datuak,$pelikula);

            $json_berria = json_encode($datuak, JSON_PRETTY_PRINT);
            file_put_contents("JSON/peliculas.json", $json_berria);
        }
    }

    public function aktualizatua($datuak, $pelikula) {
        $aktu = false;

        foreach ($datuak as &$pelikulak) {
            if ($pelikulak["isan"] === $pelikula["isan"]) {
                if($pelikula["izena"] !== "" && $pelikula["urtea"] !== "" && $pelikula["puntuazioa"] !== "")
                $pelikulak["izena"] = $pelikula["izena"];
                $pelikulak["urtea"] = $pelikula["urtea"];
                $pelikulak["puntuazioa"] = $pelikula["puntuazioa"];
                $aktu = true;
                break;
            }
        }

        if (!$aktu) {
            $datuak[] = $pelikula;
        }

        return $datuak;
    }
    public function ezabatu(&$datuak, $pelikula) {
        $ezabatua = false;
    
        foreach ($datuak as $key => $pelikulak) {
            if ($pelikulak["isan"] === $pelikula["isan"] && $pelikula["izena"] === "") {
                unset($datuak[$key]);
                $ezabatua = true;
                break;
            }
        }
    
        if (!$ezabatua) {
            $datuak[] = $pelikula;
        }
    
        return $datuak;
    }
    
    
    public function izena() {
        if (!empty($_POST["izena"])) {
            $izena = $_POST["izena"];
            return $izena;
        } else {
            echo "Ez duzu izena sartu";
        }
        
    }

    public function ISAN() {
        if (isset($_POST["isan"]) && strlen($_POST["isan"]) == 8 && !empty($_POST["isan"])) {
            $isan = $_POST["isan"];
            return $isan;
        } else {
            echo "ISAN zenbakiak ez ditu 8 digitu edo hutsa <br>";
        }
    }

    public function urtea() {
        if (isset($_POST["urtea"]) && !empty($_POST["urtea"])) {
            $urtea = $_POST["urtea"];
            return $urtea;
        } else {
            echo "Ez duzu urtea sartu";
        }
    }

    public function puntuazioa() {
        if (isset($_POST["zenbakiak"])) {
            $puntuazioa = $_POST["zenbakiak"];
            return $puntuazioa;
        }

    }
}
$topMovies = new TopMovies();
?>
</body>
</html>