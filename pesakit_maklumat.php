<?php
    include("sambungan.php");
    include("doktor_menu.php");

	$idpesakit = $_POST["idpesakit"];

	$sql = "select * from pesakit where idpesakit = '$idpesakit'";

	$result = mysqli_query($sambungan, $sql);
	while($pesakit = mysqli_fetch_array($result)) {
            $namapesakit = $pesakit["namapesakit"];
            $password = $pesakit["password"];
	}
?>

<link rel="stylesheet" href="asenarai.css">
<link rel="stylesheet" href="abutton.css">

<table class="maklumat">
    <caption>MAKLUMAT PESAKIT</caption>
    <tr>
        <th>Perkara</th>
        <th>Maklumat</th>
    </tr>
    <tr>
        <td class="maklumat">ID pesakit</td>
        <td class="maklumat"><?php echo $idpesakit; ?></td>
    </tr>
    <tr>
        <td class="maklumat">Nama</td>
        <td class="maklumat"><?php echo $namapesakit; ?></td>
    </tr>
    <tr>
        <td class="maklumat">Password</td>
        <td class="maklumat"><?php echo $password; ?></td>
    </tr>
    
</table>
