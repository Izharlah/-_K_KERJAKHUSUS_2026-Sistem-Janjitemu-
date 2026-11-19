<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<link rel="stylesheet" href="amenu.css">

<header>
    <img class="logo" src="imej/logo.png">
    <img class="tajuk" src="imej/tajuk.png">
</header>

<nav>
    <ul>
        <li>
            <a href="index.php"><b>DOKTOR</b></a>
        </li>
    </ul>
    <ul>
        <li>
            <?php
                if (isset($_SESSION["idpengguna"])) 
                    echo "<a href='janjitemu_senarai.php'><b>JANJITEMU</b></a>";
                else     
                    echo "<a href='javascript:papar();'><b>JANJITEMU</b></a>";
            ?> 
        </li>

    </ul>
    <ul>
        <li>
            <?php
                if (isset($_SESSION["idpengguna"])) {
                    echo "<a href='logout.php'><b>LOG KELUAR</b></a>";
                }    
                else { 
                    echo "<a href='login.php'><b>LOG MASUK</b></a>";
                }
            ?>   
        </li>
    </ul>
    
    <?php
        if (isset($_SESSION["idpengguna"])) {
            $idpesakit = $_SESSION["idpengguna"]; 
            $sql = "select * from pesakit where idpesakit = '$idpesakit' "; 
            $result = mysqli_query($sambungan, $sql);
            $pesakit = mysqli_fetch_array($result);   
            echo "<h5 class='menu'>Selamat datang $pesakit[namapesakit]</h5>";
        } 
    ?> 
</nav>

<script>
    function papar() {
        alert("Sila login untuk melihat janjitemu");
    }
</script>
