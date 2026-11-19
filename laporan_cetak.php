<?php
    include("sambungan.php");
	include("doktor_menu.php");
?>

<link rel="stylesheet" href="asenarai.css">
<link rel="stylesheet" href="abutton.css">

<main>
    <div id="printarea">
    <?php
        if (isset($_POST['submit'])) {           
            $idpesakit = $_POST['idpesakit'];
            $iddoktor = $_POST['iddoktor'];
            $pilih = $_POST['pilih'];

            $sql = "select * from doktor where iddoktor = '$iddoktor' "; 
            $result = mysqli_query($sambungan, $sql);
            $doktor = mysqli_fetch_array($result);
            $namadoktor = $doktor['namadoktor']; 

            $sql = "select * from pesakit where idpesakit = '$idpesakit' "; 
            $result = mysqli_query($sambungan, $sql);
            $pesakit = mysqli_fetch_array($result);
            $namapesakit = $pesakit['namapesakit'];

            if ($pilih == 1) {
                echo "<table>
                        <tr>
                            <th>IDPesakit</th>
                            <th>NamaPesakit</th>
                            <th>Tarikh</th>
                            <th>Masa</th>
                        </tr>";
                        
                $sql = "select * from janjitemu 
                join doktor on janjitemu.iddoktor = doktor.iddoktor
                join pesakit on janjitemu.idpesakit = pesakit.idpesakit
                where janjitemu.iddoktor = '$iddoktor' ";

                $result = mysqli_query($sambungan, $sql);
                while($janjitemu = mysqli_fetch_array($result)) {  
                    echo "<tr> <td>$janjitemu[idpesakit]</td>
                                <td>$janjitemu[namapesakit]</td>
                                <td>$janjitemu[tarikh]</td>
                                <td>$janjitemu[masa]</td>
                        </tr>";
                }
                                
                echo "<caption><img src='imej/tajuk.png' width=300><br>
                    Nama Doktor : $namadoktor</caption>
                    </table>"; 
            }

            if ($pilih == 2) {
                echo "<table>
                        <tr>
                            <th>IDDoktor</th>
                            <th>NamaDoktor</th>
                            <th>Tarikh</th>
                            <th>Masa</th>
                        </tr>";
                        
                $sql = "select * from janjitemu 
                join doktor on janjitemu.iddoktor = doktor.iddoktor
                where janjitemu.idpesakit = '$idpesakit' ";

                $result = mysqli_query($sambungan, $sql);
                while($janjitemu = mysqli_fetch_array($result)) {  
                    echo "<tr> <td>$janjitemu[iddoktor]</td>
                                <td>$janjitemu[namadoktor]</td>
                                <td>$janjitemu[tarikh]</td>
                                <td>$janjitemu[masa]</td>                        
                        </tr>";
                }
                                
                echo "<caption><img src='imej/tajuk.png' width=300><br>
                    Nama Pesakit : $namapesakit</caption>
                    </table>"; 
            }
        }
    ?>
    </div>
    <button class="cetak" onclick="printPageArea()">Cetak</button>
</main>

<script>
    function printPageArea() {
        var printContent = document.getElementById("printarea").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
