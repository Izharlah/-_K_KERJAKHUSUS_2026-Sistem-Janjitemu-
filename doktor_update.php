<?php
	include("sambungan.php");
	include("doktor_menu.php");

	if (isset($_POST["submit"])) {
		$iddoktor = $_POST["iddoktor"];
        $namadoktor = $_POST["namadoktor"];
		$password= $_POST["password"];
        $nobilik = $_POST["nobilik"];
        $namafail = $iddoktor.".png";
        $sementara = $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, "imej/".basename($namafail));
        
		$sql = "update doktor set 
                namadoktor = '$namadoktor', gambar = '$namafail', password = '$password', nobilik = '$nobilik' 
                where iddoktor = '$iddoktor'";
		$result = mysqli_query($sambungan, $sql);
		if ($result == true)
			echo "<h4>Berjaya kemaskini</h4>";
		else
			echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
	}

    if (isset($_GET["iddoktor"]))
		$iddoktor = $_GET["iddoktor"];

	$sql = "select * from doktor where iddoktor = '$iddoktor' ";
	$result = mysqli_query($sambungan, $sql);
	while($doktor = mysqli_fetch_array($result)) {
		$namadoktor = $doktor["namadoktor"];
		$namafail = $iddoktor.".png";
		$password = $doktor["password"];
        $nobilik = $doktor["nobilik"];
	}
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3>KEMASKINI DOKTOR</h3>
<form action="doktor_update.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>ID doktor</td>
            <td><input type="text" name="iddoktor" readonly value="<?php echo $iddoktor; ?>"></td>
        </tr>
        <tr>
            <td>Nama doktor</td>
            <td><input type="text" name="namadoktor" value="<?php echo $namadoktor; ?>"></td>
        </tr>
        <tr>
            <td class="warna">Gambar 350x320</td>
            <td><input type="file" name="namafail" accept=".png, .jpg">
                <?php echo "<img width=100 src='imej/".$namafail."'>";?>
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $password; ?>"></td>
        </tr>
        <tr>
            <td>No Bilik</td>
            <td><input type="text" name="nobilik" value="<?php echo $nobilik; ?>"></td>
        </tr>
    </table>
    <button class="update" type="submit" name="submit">Update</button>
</form>
