<?php
    include("sambungan.php");
    include("doktor_menu.php");

	if (isset($_POST["submit"])) {
        $idpesakit = $_POST["idpesakit"];
		$password = $_POST["password"];
		$namapesakit = $_POST["namapesakit"];

		$sql = "update pesakit 
                set password = '$password', namapesakit = '$namapesakit'
                where idpesakit = '$idpesakit'";
		$result = mysqli_query($sambungan, $sql);
		if ($result == true)
			echo "<h4>Berjaya kemaskini</h4>";
		else
			echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
	}

    if (isset($_GET["idpesakit"]))
		$idpesakit = $_GET["idpesakit"];

	$sql = "select * from pesakit where idpesakit = '$idpesakit' ";
	$result = mysqli_query($sambungan, $sql);
	while($pesakit = mysqli_fetch_array($result)) {
		$namapesakit = $pesakit["namapesakit"];
		$password = $pesakit["password"];
	}
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3>KEMASKINI PESAKIT</h3>
<form action="pesakit_update.php" method="post">
    <table>
        <tr>
            <td>ID pesakit</td>
            <td><input type="text" name="idpesakit" readonly value="<?php echo $idpesakit; ?>"></td>
        </tr>
        <tr>
            <td>Nama pesakit</td>
            <td><input type="text" name="namapesakit" value="<?php echo $namapesakit; ?>"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $password; ?>"></td>
        </tr>
    </table>
    <button class="update" type="submit" name="submit">Update</button>
</form>
