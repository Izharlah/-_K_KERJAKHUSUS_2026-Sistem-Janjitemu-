<?php
    include("sambungan.php");

    $iddoktor = $_GET["iddoktor"];
    $idpesakit = $_GET["idpesakit"];
    $tarikh = $_GET["tarikh"];

    $sql = "delete from janjitemu where iddoktor = '$iddoktor' and idpesakit = '$idpesakit' and tarikh = '$tarikh' ";
    $result = mysqli_query($sambungan, $sql);

    echo "<script>window.location='pengesahan_tempahan.php'</script>";
?>
