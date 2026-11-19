<?php
include("sambungan.php");
include("pesakit_menu.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

if (isset($_GET["iddoktor"], $_GET["idpesakit"])) {
    $iddoktor = $_GET["iddoktor"];
    $idpesakit = $_GET["idpesakit"];
    
    $_SESSION["iddoktor"] =  $iddoktor;
    $_SESSION["idpesakit"] = $idpesakit;
}

if (isset($_POST["tempah"])) {
    $tarikh = $_POST["tarikh"];
    $masa = $_POST["masa"];
    
    $iddoktor = $_SESSION["iddoktor"]; 
    $idpesakit = $_SESSION["idpesakit"] ;

    if ($tarikh < date("Y-m-d")) {
        echo "<script>
                alert('Tarikh lepas tidak boleh ditempah.'); 
                window.location='insert.php';
            </script>";
        exit;
    }

    $sqlSemak = "SELECT * FROM janjitemu WHERE iddoktor='$iddoktor' 
                AND idpesakit='$idpesakit' AND tarikh='$tarikh'  ";
    $hasilSemak = mysqli_query($sambungan, $sqlSemak);

    $sql = "INSERT INTO janjitemu VALUES('$iddoktor', '$idpesakit', '$tarikh','$masa','sedang diproses' )";

    $result = mysqli_query($sambungan, $sql);
    if ($result == true) {
        echo "<script>alert('janjitemu berjaya.'); window.location='janjitemu_insert.php?tarikh=$tarikh';</script>";
    } else {
        echo "<script>alert('janjitemu gagal, tidak boleh menempah pada tarikh yang sama.'); window.location='janjitemu_insert.php?tarikh=$tarikh';</script>";
    }
    exit;
}

$tarikhPilih = "";

if (isset($_GET["tarikh"])) {
    $tarikhPilih = $_GET["tarikh"];
    $tahun = date("Y", strtotime($tarikhPilih));
    $bulan = date("m", strtotime($tarikhPilih));
} else {
    $tahun = date("Y");
    $bulan = date("m");
}

if (isset($_GET["bulan"]) && isset($_GET["tahun"])) {
    $bulan = (int)$_GET["bulan"];
    $tahun = (int)$_GET["tahun"];
}

$bilHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$hariPertama = date("N", strtotime("$tahun-$bulan-01"));

$namaBulan = array(
    1=>"Januari", 2=>"Februari", 3=>"Mac", 4=>"April",
    5=>"Mei", 6=>"Jun", 7=>"Julai", 8=>"Ogos",
    9=>"September", 10=>"Oktober", 11=>"November", 12=>"Disember"
);

$bulanSebelum = $bulan - 1;
$tahunSebelum = $tahun;
if ($bulanSebelum == 0) {
    $bulanSebelum = 12;
    $tahunSebelum--;
}

$bulanSeterusnya = $bulan + 1;
$tahunSeterusnya = $tahun;
if ($bulanSeterusnya == 13) {
    $bulanSeterusnya = 1;
    $tahunSeterusnya++;
}

?>

<link rel="stylesheet" href="akalendar.css">
<div class="kalendar">
    <div class="kepala">
        <a href="janjitemu_insert.php?bulan=<?php echo $bulanSebelum; ?>&tahun=<?php echo $tahunSebelum; ?>">&lt; Sebelum</a>
        <h2><?php echo $namaBulan[(int)$bulan] . " " . $tahun; ?></h2>
        <a href="janjitemu_insert.php?bulan=<?php echo $bulanSeterusnya; ?>&tahun=<?php echo $tahunSeterusnya; ?>">Seterusnya &gt;</a>
    </div>

    <div class="grid">
        <div class="nama-hari">Isn</div>
        <div class="nama-hari">Sel</div>
        <div class="nama-hari">Rab</div>
        <div class="nama-hari">Kha</div>
        <div class="nama-hari">Jum</div>
        <div class="nama-hari">Sab</div>
        <div class="nama-hari">Ahd</div>

    <?php
        for ($i=1; $i<$hariPertama; $i++) {
            echo "<div class='kosong'></div>";
        }

        for ($hari=1; $hari<=$bilHari; $hari++) {
            $tarikh = sprintf("%04d-%02d-%02d", $tahun, $bulan, $hari);
            $sql = "SELECT * FROM janjitemu WHERE tarikh='$tarikh'";
            $result = mysqli_query($sambungan, $sql);

            if ($tarikh < date("Y-m-d")) {
                echo "<div class='hari lepas'>$hari</div>";
            } elseif ($tarikh == $tarikhPilih) {
                echo "<div class='hari'><a class='dipilih' href='janjitemu_insert.php?tarikh=$tarikh'>$hari</a></div>";
            } elseif (mysqli_num_rows($result) > 0) {
                echo "<div class='hari'><a class='ditempah' href='janjitemu_insert.php?tarikh=$tarikh'>$hari</a></div>";
            } else {
                echo "<div class='hari'><a class='boleh' href='janjitemu_insert.php?tarikh=$tarikh'>$hari</a></div>";
            }
        }
    ?>
</div>

<div class="petunjuk">
    <span style="background:#e8f5e9">Boleh ditempah</span>
    <span style="background:#ffcdd2">Ada janjitemu</span>
    <span style="background:#4caf50;color:white">Dipilih</span>
    <span style="background:#eee">Tarikh lepas</span>
    </div>
</div>

<?php if ($tarikhPilih != "" && $tarikhPilih >= date("Y-m-d")) { ?>
<div class="masa-box">
    <h3>Tarikh: <?php echo date("d-m-Y", strtotime($tarikhPilih)); ?></h3>

    <form method="post">
    <td><input type="hidden" name="iddoktor" value="<?php echo $iddoktor; ?>"></td>
        <td><input type="hidden" name="idpesakit" value="<?php echo $idpesakit; ?>"></td>
        <input type="hidden" name="tarikh" value="<?php echo $tarikhPilih; ?>">

<?php
    $senaraiMasa = array("09:00:00","10:00:00","11:00:00",
                        "14:00:00","15:00:00","16:00:00" );
    foreach ($senaraiMasa as $masa) {
        $sqlMasa = "SELECT * FROM janjitemu WHERE tarikh='$tarikhPilih' AND masa='$masa'";
        $hasilMasa = mysqli_query($sambungan, $sqlMasa);
        $paparMasa = date("h:i A", strtotime($masa));

        if (mysqli_num_rows($hasilMasa) > 0) {
            echo "<div class='masa'><label class='penuh'><input type='radio' disabled> $paparMasa - Ditempah</label></div>";
        } else {
            echo "<div class='masa'><label><input type='radio' name='masa' value='$masa' required> $paparMasa</label></div>";
        }
    }
?>
<br>
        
<?php
    $iddoktor = $_SESSION["iddoktor"]; 
    $sql = "select * from doktor where iddoktor = '$iddoktor' "; 
    $result = mysqli_query($sambungan, $sql);
    $doktor = mysqli_fetch_array($result);   
    echo "<button type='submit' name='tempah'>Tempah $doktor[namadoktor]</button> "; 
?> 

</form>
</div>
<?php } ?>
