<?php
    include("sambungan.php");
	include("doktor_menu.php");
?>

<link rel="stylesheet" href="asenarai.css">
<link rel="stylesheet" href="abutton.css">

<table>
    <caption>SENARAI DOKTOR</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Password</th>
        <th>No Bilik</th>
        <th>Kepakaran</th>
        <th>Kemaskini</th>
        <th>Padam</th>
    </tr>

    <?php
        $sql = "select * from doktor join kepakaran on doktor.idkepakaran = kepakaran.idkepakaran";
        $result = mysqli_query($sambungan, $sql);
        while($doktor = mysqli_fetch_array($result)) {
            $iddoktor = $doktor["iddoktor"];   
            echo "<tr> <td>$doktor[iddoktor]</td>
                        <td>$doktor[namadoktor]</td>
                        <td><img width= 100 src= 'imej/$doktor[gambar]'></td>   
                        <td>$doktor[password]</td>
                        <td>$doktor[nobilik]</td>
                        <td>$doktor[namakepakaran]</td>
                        <td>
                            <a href='doktor_update.php?iddoktor=$iddoktor' title='update'>
                                <img src='imej/update.png'>
                            </a>
                        </td>
                        <td>
                            <a href='javascript:padam(\"$iddoktor\");' title='delete'>
                                <img src='imej/delete.png'>
                            </a>
                        </td>
                    </tr>";
        }
    ?>
</table>

<script>
    function padam(id) {
        if (confirm("Adakah anda ingin padam") == true) {
            window.location = "doktor_delete.php?iddoktor=" + id;
        }
    }
</script>
