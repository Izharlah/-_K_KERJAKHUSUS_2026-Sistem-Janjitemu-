<?php 
    include("keselamatan.php");  
?>

<link rel="stylesheet" href="amenu.css">

<header>
    <img class="logo" src="imej/logo.png">
    <img class="tajuk" src="imej/tajuk.png">
</header>

<nav>
    <ul>
        <li>
            <a href="#"><b>KEPAKARAN</b></a>
            <ul>
                <li><a href="kepakaran_insert.php">Tambah</a></li>
                <li><a href="kepakaran_senarai.php">Senarai</a></li>
            </ul>
        </li>
    </ul>
    <ul>
        <li>
            <a href="#"><b>DOKTOR</b></a>
            <ul>
                <li><a href="doktor_insert.php">Tambah</a></li>
                <li><a href="doktor_senarai.php">Senarai</a></li>
                <li><a href="pengesahan_tempahan.php">Pengesahan</a></li>
            </ul>
        </li>
    </ul>
    <ul>
        <li>
            <a href="#"><b>PESAKIT</b></a>
            <ul>
                <li><a href="pesakit_insert.php">Tambah</a></li>
                <li><a href="pesakit_senarai.php">Senarai</a></li>
                <li><a href="pesakit_carian.php">Carian</a></li>
            </ul>
        </li>
    </ul>
    <ul>
        <li>
            <a href="laporan_pilih.php"><b>LAPORAN</b></a>
        </li>
    </ul>
    <ul>
        <li>
            <a href="import.php"><b>IMPORT</b></a>
        </li>
    </ul>
    <ul>
        <li>
            <a href="logout.php"><b>LOG KELUAR</b></a>
        </li>
    </ul>
</nav>
