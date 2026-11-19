<?php
    include("sambungan.php");
    include("doktor_menu.php");
?>

<link rel="stylesheet" href="asenarai.css">
<table class="kepakaran">
    <caption>SENARAI NAMA KEPAKARAN</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>>
        <th>Kemaskini</th>
        <th>Padam</th>
    </tr>
    
    <?php
        $sql = "select * from kepakaran";
        $result = mysqli_query($sambungan, $sql);
        while($kepakaran = mysqli_fetch_array($result)) {
        $idkepakaran = $kepakaran["idkepakaran"];
        echo "<tr>  <td>$kepakaran[idkepakaran]</td>
                    <td class='nama'>$kepakaran[namakepakaran]</td>
					<td>
                        <a href='kepakaran_update.php?idkepakaran=$kepakaran[idkepakaran]'>
                            <img src='imej/update.png'>
                        </a>
                    </td>
					<td>
                        <a href='javascript:padam(\"$idkepakaran\");'>
                            <img src='imej/delete.png'>
                        </a>
                    </td>
            </tr>";
        }
    ?>
</table>

<script>
    function padam(id)    {
        if (confirm("Adakah anda ingin padam") == true) {
            window.location = "kepakaran_delete.php?idkepakaran=" + id;
        }
    }
</script>
