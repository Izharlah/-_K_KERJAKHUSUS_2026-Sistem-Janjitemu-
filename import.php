<?php 
    include("sambungan.php"); 
    include("doktor_menu.php");

    if (isset($_POST["submit"])) {
        $namajadual = $_POST["namajadual"];
        $namafail = $_FILES["namafail"]["name"];
        $sementara = $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, $namafail);

        $fail = fopen($namafail, "r");
        while (!feof($fail)) {
            $medan = explode(",", fgets($fail));
            $berjaya = false;

            if (strtolower($namajadual) === "pesakit") {
                $idpesakit = $medan[0];
                $password = $medan[1];
                $namapesakit = $medan[2];
                $sql = "insert into pesakit values('$idpesakit', '$password', '$namapesakit')";
                if (mysqli_query($sambungan, $sql))
                    $berjaya = true; 
            }

            if (strtolower($namajadual) === "doktor") {
                $iddoktor = $medan[0];
                $namadoktor = $medan[1];
                $gambar = $medan[2];
                $password = $medan[3];
                $nobilik = $medan[4];
                $idkepakaran = trim($medan[5]);
                $sql = "insert into doktor values('$iddoktor', '$namadoktor', '$gambar', '$password', '$nobilik', '$idkepakaran')";
                if (mysqli_query($sambungan, $sql))
                    $berjaya = true;
            }
        }

        if ($berjaya == true) 
            echo "<script>alert('Rekod berjaya di import');</script>";
        else
            echo "<script>alert('Rekod tidak berjaya di import');</script>";
        mysqli_close($sambungan);
    }
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3 class="panjang">IMPORT DATA</h3>
<form class="panjang" action="import.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Jadual</td>
            <td>
            <select name="namajadual">
                <option>pesakit</option>
                <option>doktor</option>
            </select>
            </td>
        </tr>
        <tr>
            <td>Nama fail</td>
            <td><input required type="file" name="namafail" accept=".txt, .csv"></td>
        </tr>
    </table>
    <button class="import" type="submit" name="submit">Import</button>
</form>
