<?php
    include("sambungan.php"); 
    include("pesakit_menu.php");

    if(isset($_POST["submit"])) {    
        $idpesakit = $_POST["idpesakit"];
        $password = $_POST["password"];
        $namapesakit = $_POST["namapesakit"];

        $sql = "insert into pesakit values('$idpesakit', '$password', '$namapesakit')";
        $result = mysqli_query($sambungan, $sql);
        if ($result)
            echo "<script>alert('Berjaya signup')</script>";
        else 
            echo "<script>alert('Idpesakit ini telah ada, sila masukkan id yang lain')</script>";
            //echo "<script>alert('Tidak berjaya signup')</script>";
        echo "<script>window.location='index.php'</script>";
    }
?> 

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="abutton.css">

<h3>SIGN UP</h3>
<form name="borang" action="signup.php" method="post" onsubmit="return semak()">
    <table>
        <tr>
            <td class="saiz">ID pesakit</td>
            <td><input required type="text" name="idpesakit" placeholder="cth: P065" >
            </td>
        </tr>
        <tr>
            <td class="saiz">Nama pesakit</td>
            <td><input required type="text" name="namapesakit"></td>
        </tr>
        <tr>
            <td class="saiz">Password</td>
            <td><input required type="password" name="password"></td>
        </tr>
    </table>
    
    <button class="tambah" type="submit" name="submit">Daftar</button>
    <button class="batal" type="button" onclick="window.location='index.php'">Batal</button>
</form>
    
<br>
<p class="saiz" >Ubah saiz</p>
<input type="range" min="14" max="30" value="14" oninput="ubahSaiz(this.value)">

<script>
    function semak() {
        var borang = document.forms["borang"];
        var idpesakit = borang["idpesakit"].value.trim();

        // Semak had bawah dan had atas
        if (idpesakit.length !== 4) {
            alert("idpesakit mesti tepat 4 aksara");
            return false;
        }

        // Jika semua ok, submit form
        //alert("Berjaya semak had atas atau had bawah!");
        borang.submit();
    }

    function ubahSaiz(saiz) {
        var elemen = document.getElementsByClassName("saiz");
        for (var i = 0; i < elemen.length; i++) {
            elemen[i].style.fontSize = saiz + "px";
        }
    }
</script>
