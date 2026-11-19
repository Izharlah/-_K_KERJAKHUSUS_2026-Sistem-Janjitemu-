<?php
	include("sambungan.php");
	include("doktor_menu.php");

	if (isset($_POST["submit"])) {
		$iddoktor = $_POST["iddoktor"];
        $namadoktor = $_POST["namadoktor"];
		$password = $_POST["password"];
        $nobilik = $_POST["nobilik"];
        $idkepakaran = $_POST["idkepakaran"];
        
        $namafail = $iddoktor.".png";
        $sementara = $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, "imej/".basename($namafail));
        
		$sql = "insert into doktor values('$iddoktor', '$namadoktor', '$namafail', '$password', $nobilik, '$idkepakaran')";
		$result = mysqli_query($sambungan, $sql);
		if ($result == true)
			echo "<h4>Berjaya tambah</h4>";
		else
			echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
	}
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3>BORANG TAMBAH doktor</h3>
<form action="doktor_insert.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>ID doktor</td>
            <td><input required type="text" name="iddoktor"></td>
        </tr>
        <tr>
            <td>Nama doktor</td>
            <td><input type="text" name="namadoktor"></td>
        </tr>
        <tr>
            <td>Gambar</td>
            <td><input type="file" name="namafail" accept=".png, .jpg"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password"></td>
        </tr>
        <tr>
            <td>No bilik</td>
            <td><input type="text" name="nobilik"></td>
        </tr>
        <tr>
            <td>Kepakaran</td>
            <td>
                <select name="idkepakaran">
                <?php
                    $sql = "select * from kepakaran";
                    $data = mysqli_query($sambungan, $sql);
                    while($kepakaran = mysqli_fetch_array($data)) {
                        echo "<option value='$kepakaran[idkepakaran]'>$kepakaran[namakepakaran]</option>";
                    }
                ?>
                </select>
            </td>
        </tr>     
    </table>
    <button class="tambah" type="submit" name="submit">Tambah</button>
</form>
