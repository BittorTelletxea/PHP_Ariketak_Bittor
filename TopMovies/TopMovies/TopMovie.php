<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentua</title>
</head>
<body>
    <form action="TopMovie.php" method="post"> 
        <h1>PELIKULA NAGUSIAK, <?php echo $_POST["usuario"]?></h1> 
        <p>FILMAREN IZENA: </p><input type="text" name="izena" >
        <p>ISAN ZENBAKIA: </p><input type="text" name="isan" > 
        <p>FILMAREN URTEA: </p><input type="number" name="urtea" > 
        <p>FILMAREN PUNTUAZIOA: </p><select name="zenbakiak"> 
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
    class TopMovies {
        private $izena;
        private $isan;
        private $urtea;
        private $puntuazioa;

        public function __construct() {
            $json = file_get_contents("JSON/peliculas.json"); // JSON fitxategiaren edukia irakurri
            $datuak = json_decode($json, true); // JSON-a array assosiatibo batean dekodeatu

            if (isset($_POST["bidali"])) { // Formularioa bidali bada
                $this->izena = $this->izena();
                $this->isan = $this->ISAN();
                $this->urtea = $this->urtea();
                $this->puntuazioa = $this->puntuazioa();
                echo "<br>Filma Izena: " . $this->izena . "<br>" . "ISAN zenbakia" . $this->isan . "<br>" . "Filma Urtea: " . $this->urtea
                    . "<br> Filmaaren Puntuazioa: " . $this->puntuazioa . "<br><hr>"; // Formularioaren datuak erakutsi

                $pelikula = array(
                    "izena" => $this->izena,
                    "isan" => $this->isan,
                    "urtea" => $this->urtea,
                    "puntuazioa" => $this->puntuazioa
                );
                $datuak = $this->aktualizatua($datuak, $pelikula); // Datuak formularioaren informazioarekin eguneratu
                $datuak = $this->ezabatu($datuak, $pelikula); // Izena hutsik bada, datuak ezabatu

                $json_berria = json_encode($datuak, JSON_PRETTY_PRINT); // Arraya JSON gisa bihurtu
                file_put_contents("JSON/peliculas.json", $json_berria); // JSON-a eguneratuta gordetzeko
            }
        }

        public function aktualizatua($datuak, $pelikula) {
            $aktu = false;

            foreach ($datuak as &$pelikulak) {
                if ($pelikulak["isan"] === $pelikula["isan"]) { // ISAN bat existitzen bada
                    if ($pelikula["izena"] !== "" && $pelikula["urtea"] !== "" && $pelikula["puntuazioa"] !== "") { // Eremuen balioak hutsik ez badira
                        $pelikulak["izena"] = $pelikula["izena"];
                        $pelikulak["urtea"] = $pelikula["urtea"];
                        $pelikulak["puntuazioa"] = $pelikula["puntuazioa"];
                    }
                    $aktu = true;
                    break;
                }
            }

            if (!$aktu) {
                $datuak[] = $pelikula; // ISAN bat existitzen ez bada, filma gehitu
            }

            return $datuak;
        }

        public function ezabatu(&$datuak, $pelikula) {
            $ezabatua = false;

            foreach ($datuak as $key => $pelikulak) {
                if ($pelikulak["isan"] === $pelikula["isan"] && $pelikula["izena"] === "") { // ISAN bat existitzen bada eta izena hutsik bada
                    unset($datuak[$key]); // Sarrera ezabatu
                    $ezabatua = true;
                    break;
                }
            }

            if (!$ezabatua) {
                $datuak[] = $pelikula; // ISAN bat existitzen ez bada edo izena ez bada hutsik, filma gehitu
            }

            return $datuak;
        }

        public function izena() {
            if (!empty($_POST["izena"])) { // Izenaren eremua hutsik ez badago
                $izena = $_POST["izena"];
                return $izena;
            } else {
                echo "Izena sartu gabe dago"; // Izenaren eremua hutsik denean mezu bat erakutsi
            }
        }

        public function ISAN() {
            if (isset($_POST["isan"]) && strlen($_POST["isan"]) == 8 && !empty($_POST["isan"])) { // ISANak 8 digitu dituenean eta hutsik ez dagoenean
                $isan = $_POST["isan"];
                return $isan;
            } else {
                echo "ISAN zenbakiak ez ditu 8 digitu edo hutsik <br>"; // ISANak 8 digitu ez baditu edo hutsik badago, mezu bat erakutsi
            }
        }

        public function urtea() {
            if (isset($_POST["urtea"]) && !empty($_POST["urtea"])) { // Urtearen eremua hutsik ez badago
                $urtea = $_POST["urtea"];
                return $urtea;
            } else {
                echo "Urtea sartu gabe dago"; // Urtearen eremua hutsik denean mezu bat erakutsi
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
