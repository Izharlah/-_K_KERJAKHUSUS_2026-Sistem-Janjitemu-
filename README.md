<?php
    ob_start();
    include("sambungan.php");
    include("pesakit_menu.php");

    if (isset($_POST["submit"])) {
        $userid = $_POST["userid"];
        $password = $_POST["password"];
        $jenis = $_POST["jenis"];

        $jumpa = FALSE;

        if ($jenis == 1) {
            $sql = "SELECT * FROM pesakit";
            $result = mysqli_query($sambungan, $sql);
            while($pesakit = mysqli_fetch_array($result))   {
                if ($pesakit["idpesakit"] == $userid && $pesakit["password"] == $password) {
                    $jumpa = TRUE;
                    $_SESSION["idpengguna"] = $pesakit["idpesakit"];
                    $_SESSION["nama"] = $pesakit["namapesakit"];
                    $_SESSION["status"] = "pesakit";
                    break;
                }
            }
        }

        if ($jenis == 2) {
            $sql = "SELECT * FROM doktor";
            $result = mysqli_query($sambungan, $sql);
            while($doktor = mysqli_fetch_array($result)) {
                if ($doktor["iddoktor"] == $userid && $doktor["password"] == $password) {
                    $jumpa = TRUE;
                    $_SESSION["idpengguna"] = $doktor["iddoktor"];
                    $_SESSION["nama"] = $doktor["namadoktor"];
                    $_SESSION["status"] = "doktor";
                    break;
                }
            }
        }

        if ($jumpa == TRUE) {
            if ($_SESSION["status"] == "pesakit")
                header("Location: index.php");
            else if ($_SESSION["status"] == "doktor")
                header("Location: doktor_senarai.php"); 
        }
        echo "<script>alert('kesalahan pada username atau password');</script>"; 
    }      
?>

<link rel="stylesheet" href="abutton.css">
<link rel="stylesheet" href="aborang.css">
    
<h3>LOG MASUK</h3>
<form action="login.php" method="post">
    <table>
        <tr>
            <td>ID Pengguna</td>
            <td><input type="text" name="userid" placeholder="idpengguna"></td>
        </tr>
        <tr>
            <td>Katalaluan</td>
            <td><input type="password" name="password" placeholder="password"></td>
        </tr>
    </table>
    <input type=radio name=jenis value=1 checked><span class="label">Pesakit</span>
    <input type=radio name=jenis value=2><span class="label">Doktor</span><br>
    <button class="login" type="submit" name="submit">Login</button>
    <button class="signup" type="button" onclick="window.location='signup.php'">Daftar</button><br><br>
    <span class="label">Belum ada idpengguna klik butang Daftar</span>
</form>
