<?php
include "koneksi.php";

?>
<?php
date_default_timezone_set("Asia/jakarta");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="setting.css">
    <title>Layout Peron</title>
</head>
<body>
<center>
    <h1>PT KERETA API INDONESIA</h1>
    <h4>STASIUN PURWOKERTO</h4>
    <p><?php echo date('l, d-m-Y'); ?></p>
    <p><b><span id="jam"></span></b></p>
    <script type="text/javascript">
        window.onload = function() { jam(); }
       
        function jam() {
            var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());
       
            e.innerHTML = h +':'+ m +':'+ s;
       
            setTimeout('jam()', 1000);
        }
       
        function set(e) {
            e = e < 10 ? '0'+ e : e;
            return e;
        }
    </script>
    <p> <a href="insert.php">Tambah Data</a></p>
    <table border="1" align='center' width="1000px" height="400px">
        <tr align ="center">
            <td>JALUR</td>
            <td>NO KA</td>
            <td>NAMA KA</td>
            <td>TUJUAN</td>
            <td>JAM BERANGKAT</td>
        </tr>
    <?php
        $no = 1;
        $sql = "select * from Pegawai order by NIP asc";
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
        echo "
        <tr>
            <td>$no</td>
            <td>$row[NIP]</td>
            <td>$row[nama]</td>
            <td>$row[alamat]</td>
            <td>$row[tanggal_lahir]</td>
            </tr>
        ";
        $no++;
        }
    ?>
    </table>
</center>
</body>
</html>
