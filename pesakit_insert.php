<?php
	include("sambungan.php");
	include("doktor_menu.php");

	if (isset($_POST["submit"])) {
		$idpesakit = $_POST["idpesakit"];
		$password = $_POST["password"];
		$namapesakit = $_POST["namapesakit"];

		$sql = "insert into pesakit values('$idpesakit', '$password', '$namapesakit')";
		$result = mysqli_query($sambungan, $sql);
		if ($result == true)
			echo "<h4>Berjaya tambah</h4>";
		else
            echo "<script>alert('Idpesakit ini telah ada, sila masukkan id yang lain')</script>";
			//echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
	}
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3>BORANG TAMBAH PESAKIT</h3>
<form name="borang" action="pesakit_insert.php" method="post" onsubmit="return semak()">
    <table>
        <tr>
            <td class="saiz">ID pesakit</td>
            <td><input required type="text" name="idpesakit" placeholder="cth: P065">  
            </td>
        </tr>
        <tr>
            <td class="saiz">Nama pesakit</td>
            <td><input type="text" name="namapesakit" placeholder="cth: Hajar"></td>
        </tr>    
        <tr>
            <td class="saiz">Password</td>
            <td><input type="text" name="password" placeholder="cth: 123"></td>
        </tr>
        
    </table>
    <button class="tambah" type="submit" name="submit">Tambah</button>
</form>

<br>
<p class="saiz" >Ubah saiz</p>
<input type="range" min="14" max="30" value="14" oninput="ubahSaiz(this.value)">

<script>
    function semak() {
        var borang = document.forms["borang"];
        var idpesakit = borang["idpesakit"].value.trim();

        // Semak had bawah dan had atas
        if (idpesakit.length !== 4) {
            alert("idpesakit mesti tepat 4 aksara");
            return false;
        }
        
        // Jika semua ok, submit form
        //alert("Berjaya semak had atas atau had bawah!");
        borang.submit();
    }

    function ubahSaiz(saiz) {
        var elemen = document.getElementsByClassName("saiz");
        for (var i = 0; i < elemen.length; i++) {
            elemen[i].style.fontSize = saiz + "px";
        }
    }
</script>
