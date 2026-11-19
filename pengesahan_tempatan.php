<?php
    include("keselamatan.php");
    include("sambungan.php");
	include("doktor_menu.php");
?>

<link rel="stylesheet" href="asenarai.css">
<link rel="stylesheet" href="abutton.css">

<table>
    <tr>
        <th>IDPesakit</th>
        <th>Nama Pesakit</th>
        <th>Nama Doktor</th>
        <th>Tarikh</th>
        <th>Masa</th>
        <th colspan="2">Status</th>
        <th>Padam</th>
    </tr>

    <?php
        $bayaran = 0;
    
        $sql = "select * from janjitemu 
                join doktor on janjitemu.iddoktor = doktor.iddoktor
                join pesakit on janjitemu.idpesakit = pesakit.idpesakit order by pesakit.idpesakit ASC";
        $result = mysqli_query($sambungan, $sql);
    
        while($doktor = mysqli_fetch_array($result)) {
            $iddoktor = $doktor['iddoktor'];
            $tarikh = $doktor['tarikh'];
            $masa = $doktor['masa'];
            $status = $doktor['status'];
            echo "<tr> <td>$doktor[idpesakit]</td>
                        <td>$doktor[namapesakit]</td>
                        <td>$doktor[namadoktor]</td>
                        <td>$tarikh</td>
                        <td>$masa</td>                    
                        <form action='status_update.php' method='post'>
                            <td>
                                <select name='status'>
                                    <option value='sedang diproses'
                                        ".($status == 'sedang diproses' ? 'selected' : '').">
                                        sedang diproses
                                    </option>

                                    <option value='diterima'
                                        ".($status == 'diterima' ? 'selected' : '').">
                                        diterima
                                    </option>

                                    <option value='ditolak'
                                        ".($status == 'ditolak' ? 'selected' : '').">
                                        ditolak
                                    </option>

                                    <option value='batal'
                                        ".($status == 'batal' ? 'selected' : '').">
                                        batal
                                    </option>
                                </select>
                            </td>
                            
                            <td>
                                <input type='hidden' name='iddoktor' value='$iddoktor'>
                                <input type='hidden' name='idpesakit' value='$doktor[idpesakit]'>
                                <input type='hidden' name='tarikh' value='$tarikh'>

                                <button class='simpan' type='submit' onclick='simpan()'>Simpan</a></button>
                            </td>
                        </form>

                        <td>
                            <a href='pengesahan_delete.php?iddoktor=$iddoktor&&idpesakit=$doktor[idpesakit]&&tarikh=$tarikh' onclick='padam()'>
                                <img src='imej/delete.png'> 
                            </a>
                        </td>
                </tr>";
        }
        echo "<caption>SENARAI janjitemu"; 
    ?>
</table>

<script>
    function padam() {
        if (confirm("Adakah anda ingin padam") == true) {
            window.location = "pengesahan_delete.php?iddoktor=" + idd + "&&idpesakit=" + idp + "&&tarikh=" + t;
        }
    }
    
    function simpan() {
        if (confirm("Adakah anda ingin simpan") == true) {
            window.location = "status_update.php?";
        }
    }
</script>
