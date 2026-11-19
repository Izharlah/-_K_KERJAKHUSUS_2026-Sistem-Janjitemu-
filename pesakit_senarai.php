<?php
    include("sambungan.php");
	include("doktor_menu.php");
?>

<link rel="stylesheet" href="asenarai.css">

<table class="pesakit">
    <caption>SENARAI NAMA PESAKIT</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Password</th>
        <th>Kemaskini</th>
        <th>Padam</th>
    </tr>

    <?php
        $sql = "select * from pesakit";
        $result = mysqli_query($sambungan, $sql);
        while($pesakit = mysqli_fetch_array($result)) {
        $idpesakit = $pesakit["idpesakit"];
        echo "<tr>  <td>$pesakit[idpesakit]</td>
                    <td class='nama'>$pesakit[namapesakit]</td>
                    <td>$pesakit[password]</td>
                    <td>
                        <a href='pesakit_update.php?idpesakit=$idpesakit'>
                            <img src='imej/update.png'>
                        </a>
                    </td>
                    <td>
                        <a href='javascript:padam(\"$idpesakit\");'>
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
            window.location="pesakit_delete.php?idpesakit=" + id;
        }
    }
</script>
