<?php
    /* Program ini bertujuan untuk
        memasukkan kepakaran yang baru
        pastikan idkepakaran tidak sama
        semasa memasukkan data  */

    include("sambungan.php");
	include("doktor_menu.php");

	if (isset($_POST["submit"])) {
		$idkepakaran = $_POST["idkepakaran"];
		$namakepakaran = $_POST["namakepakaran"];
		
		$sql = "insert into kepakaran values('$idkepakaran', '$namakepakaran')";
		$result = mysqli_query($sambungan, $sql);
		if ($result == true)
			echo "<h4>Berjaya tambah</h4>";
		else
			echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
	}
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3>BORANG TAMBAH KEPAKARAN</h3>
<form action="kepakaran_insert.php" method="post">
    <table>
        <tr>
            <td>ID kepakaran</td>
            <td><input required type="text" name="idkepakaran"></td>
        </tr>
        <tr>
            <td>Nama kepakaran</td>
            <td><input type="text" name="namakepakaran"></td>
        </tr>
    </table>
    <button class="tambah" type="submit" name="submit">Tambah</button>
</form>
