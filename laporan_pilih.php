<?php
    include("sambungan.php");
	include("doktor_menu.php");
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3 class="pendek">PILIH JENIS LAPORAN</h3>
<form class="pendek" action="laporan_cetak.php" method="post">

    <select id='pilih' name='pilih' onchange='papar_pilihan()'>
        <option value=1>janjitemu mengikut doktor</option>
        <option value=2>janjitemu mengikut pesakit</option>
    </select> <br>
    
    <div id="doktor" style="display:block">   
        <select name="iddoktor">
            <?php
                include('sambungan.php');
                $sql = "select * from doktor";
                $data = mysqli_query($sambungan, $sql);
                while ($doktor = mysqli_fetch_array($data)) {
                    echo "<option value='$doktor[iddoktor]'>$doktor[namadoktor]</option>";
                }
            ?>
        </select>
    </div>
    
    <div id="pesakit" style="display:none">
        <select name="idpesakit">
            <?php
                include('sambungan.php');
                $sql = "select * from pesakit";
                $data = mysqli_query($sambungan, $sql);
                while ($pesakit = mysqli_fetch_array($data)) {
                    echo "<option value='$pesakit[idpesakit]'>$pesakit[namapesakit]</option>";
                }
            ?>
        </select>
    </div>
    
    <button class="papar" name="submit" type="submit">Papar</button>
</form>

<script>
    function papar_pilihan() {
        var pilih = document.getElementById("pilih").value;
        
        if (pilih == 1) {
            paparDoktor = 'block';
            paparPesakit = 'none';
        } 
        else if (pilih == 2) {
            paparDoktor = 'none';
            paparPesakit = 'block';
        }
        document.getElementById('doktor').style.display = paparDoktor;
        document.getElementById('pesakit').style.display = paparPesakit;
    }
</script>
