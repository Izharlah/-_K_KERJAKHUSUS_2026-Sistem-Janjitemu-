<?php
    include("keselamatan.php");
    include("sambungan.php");
	include("pesakit_menu.php");

    $idpesakit = $_SESSION["idpengguna"];

    $sql = "select * from pesakit where idpesakit = '$idpesakit'"; 
    $result = mysqli_query($sambungan, $sql);
    $pesakit = mysqli_fetch_array($result);
    $namapesakit = $pesakit['namapesakit'];
?>

<link rel="stylesheet" href="asenarai.css">
<link rel="stylesheet" href="abutton.css">

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tarikh</th>
        <th>Masa</th>
        <th>Status</th>
        <th>Padam</th>
    </tr>

    <?php
        $bayaran = 0;

        $sql = "select * from janjitemu 
                join doktor on janjitemu.iddoktor = doktor.iddoktor
                join pesakit on janjitemu.idpesakit = pesakit.idpesakit
                where janjitemu.idpesakit = '$idpesakit' ORDER BY tarikh ASC";
        $result = mysqli_query($sambungan, $sql);
    
        while($doktor = mysqli_fetch_array($result)) {
            $iddoktor = $doktor['iddoktor']; 
            $tarikh = $doktor['tarikh'];
            $masa = $doktor['masa'];
            echo "<tr> <td>$doktor[iddoktor]</td>
                        <td>$doktor[namadoktor]</td>
                        <td>$doktor[tarikh]</td>
                        <td>$doktor[masa]</td>
                        <td>$doktor[status]</td>
                        <td>
                        <a href='javascript:padam(\"$iddoktor\",\"$idpesakit\",\"$tarikh\");'>
                            <img src='imej/delete.png'>
                        </a>
                    </td>
                </tr>";
        }
    
        echo "<caption>SENARAI janjitemu $namapesakit<br><br>"; 
    ?>
</table>

<script>
    function padam(idd, idp, t) {
        if (confirm("Adakah anda ingin padam") == true) {
            window.location = "janjitemu_delete.php?iddoktor=" + idd + "&&idpesakit=" + idp + "&&tarikh=" + t;
        }
    }
</script>
