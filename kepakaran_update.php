<?php
    include("sambungan.php");
    include("doktor_menu.php");

	if (isset($_POST["submit"])) {
		$idkepakaran = $_POST["idkepakaran"];
		$namakepakaran = $_POST["namakepakaran"];
	
		$sql = "update kepakaran 
                set namakepakaran = '$namakepakaran' 
                where idkepakaran = '$idkepakaran' ";
		$result = mysqli_query($sambungan, $sql);
		if ($result == true)
			echo "<h4>Berjaya kemaskini</h4>";
		else
			echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
	}

	if (isset($_GET['idkepakaran']))
        $idkepakaran = $_GET['idkepakaran'];

	$sql = "select * from kepakaran where idkepakaran = '$idkepakaran' ";
	$result = mysqli_query($sambungan, $sql);
	while($kepakaran = mysqli_fetch_array($result)) {
		$namakepakaran = $kepakaran['namakepakaran'];
	}
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3>KEMASKINI KEPAKARAN</h3>
<form action="kepakaran_update.php" method="post">
    <table>
        <tr>
            <td>ID kepakaran</td>
            <td><input type="text" name="idkepakaran" readonly value="<?php echo $idkepakaran; ?>" ></td>
        </tr>
        <tr>
            <td>Nama kepakaran</td>
            <td><input type="text" name="namakepakaran" value="<?php echo $namakepakaran; ?>" ></td>
        </tr>
    </table>
    <button class="update" type="submit" name="submit">Update</button>
</form>
