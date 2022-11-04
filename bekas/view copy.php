<?php
include "koneksi.php";
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $url="https://";
} else {
    $url="https://";
    $url.=$_SERVER['HTTP_HOST'];
    $url.=$_SERVER['REQUEST_URI'];
    $url;
}
$page=$url;
$sec="23";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="<?php echo $sec;?>" URL="<?php echo $page; ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="setting.css">
    <title>Layout Peron</title>
</head>
<body>
    <div id="container"></div>
    <nav>
        <div class="nav-desc">
            <div class="logo">
            <img src="aset/logo.png" class="featured-image" />
            </div>
            <div class="stasiun">
                STASIUN PURWOKERTO
            </div>
        </div>
        <div class="nav-time">
        <?php
        function hariIndo ($hariInggris) {
        switch ($hariInggris) {
            case 'Sunday':
            return 'Minggu';
            case 'Monday':
            return 'Senin';
            case 'Tuesday':
            return 'Selasa';
            case 'Wednesday':
            return 'Rabu';
            case 'Thursday':
            return 'Kamis';
            case 'Friday':
            return 'Jumat';
            case 'Saturday':
            return 'Sabtu';
            default:
            return 'hari tidak valid';
        }
        }
        ?>
        <?php
        date_default_timezone_set("Asia/jakarta"); 
        $hariBahasaInggris = date('l');
        $hariBahasaIndonesia = hariIndo($hariBahasaInggris);
        echo "<span class='hari'>{$hariBahasaIndonesia}</span>";
        ?> <br/> <span style='padding-right: 20px;'> <?php echo date('d-m-Y'); ?></span>
         <br/> 
        <span id="jam" class="jam"></span>
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
        </div>
    </nav>
    <table align='center' width="98%" height="80%" cellspacing="4" cellpadding="0">
        <tr style="background-color: #ee6b1e;">
            <th>JALUR<br/> <i>TRACK</i></th>
            <th>NO & NAMA KA <br/> <i>KA NUMBER & NAME</i></th>
            <th>RELASI <br/> <i>RELASI</i></th>
            <th>WAKTU BERANGKAT <br/> <i>DEPARTURE TIME</i></th>
        </tr>
    <?php
        $jalur = 1;
        $sql = "select * from peron order by jalur asc";
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
        echo "
        <tr>
            <td width='15%'> <span class='isi'><div class='jalur'>$jalur</div> </span></td>
            <td width='50%'><span class='isi'>$row[no] - $row[nama]</span></td>
            <td width='15%'><span class='isi'>$row[relasi]</span></td>
            <td width='20%' ><span class='isi'>$row[berangkat]</span></td>
            </tr>
        ";
        $jalur++;
        }
    ?>
    </table>
    <footer>
        <p><marquee>PT Kereta Api Indonesia (Persero) Daop V Purwokerto</marquee></p>
    </footer>
</body>
</html>
