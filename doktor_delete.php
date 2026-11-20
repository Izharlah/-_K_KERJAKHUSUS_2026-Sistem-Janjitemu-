
<?php
    include("sambungan.php");

    $iddoktor = $_GET["iddoktor"];

    $sql = "delete from doktor where iddoktor = '$iddoktor' ";
    $result = mysqli_query($sambungan, $sql);

    echo "<script>window.location='doktor_senarai.php'</script>";
?>
