<?php
    include("sambungan.php");

    $idpesakit = $_GET["idpesakit"];

    $sql = "delete from pesakit where idpesakit = '$idpesakit' ";
    $result = mysqli_query($sambungan, $sql);

    echo "<script>window.location='pesakit_senarai.php'</script>";
?>
