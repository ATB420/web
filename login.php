<?php
function dekodolas($filename, $kulcs) {
    $full = '';
    $fh = fopen($filename, 'r');
    if ($fh) {
        while (($sor = fgets($fh)) !== false) {
            $jelszo = '';
            $sor = rtrim($sor, "\r\n");
            for ($i = 0; $i < strlen($sor); $i++) {
                $dekodolt = (ord($sor[$i]) - $kulcs[$i % count($kulcs)]) % 256;
                if ($dekodolt < 0) $dekodolt += 256;
                $jelszo .= chr($dekodolt);
            }
            $full .= $jelszo . "\n";
        }
        fclose($fh);
    }
    return $full;
}

function getColorFromDB($email){
    $server = "127.0.0.1";
    $felhasznalo = "root";
    $jelszo = "";
    $adatbazis = "adat";

    $conn = new mysqli($server, $felhasznalo, $jelszo, $adatbazis);

    if (!$conn) {
        die("Connection failed!" . $conn->connect_error);
    }
    $statement = $conn->query("SELECT Color FROM tabla WHERE Username = '$email'");

    if ($statement->num_rows > 0) {
        $row = $statement->fetch_assoc();
        return $row["Color"];
    } else {
        return "NULL";
    }
}

$dekodoltTxt = dekodolas('password.txt', array(5, -14, 31, -9, 3));

$Felhasznalo = $_POST['usr'];
$Jelszo = $_POST['pw'];

$joeaemail = false;
$joeajelszo = false;

foreach (explode("\n", $dekodoltTxt) as $sor) {
    if (empty($sor)) {
        continue;
    }
    list($sorFelhasznalo, $sorJelszo) = explode('*', $sor);
    if ($sorFelhasznalo === $Felhasznalo) {
        $joeaemail = true;
        if ($sorJelszo === $Jelszo) {
            $joeajelszo = true;
            break;
        }
    }
}

if ($joeajelszo) {
    echo "Sikeres bejelentkezés!";

    $szinek = array(
        "piros" => "red",
        "zold" => "green",
        "sarga" => "yellow",
        "kek" => "blue",
        "fekete" => "black",
        "feher" => "white",
    );

    $szin = $szinek[getColorFromDB($Felhasznalo)];
    header("Location: index.php?response=Sikeres bejelentkezés!&color=$szin");

} else {
    if (!isset($Felhasznalo) || $Felhasznalo == '') {
        header("Location: index.php?response=Nincs felhasználó megadva!");
    }
    else if ($joeaemail) {
        header("Location: index.php?response=Helytelen jelszó!&atiranyitas=police.hu&idozites=3");
    }
    else {
        header("Location: index.php?response=Helytelen felhasználónév!&atiranyitas=police.hu&idozites=3");
    }
}


?>