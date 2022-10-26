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
<?php
date_default_timezone_set("Asia/jakarta");
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
                <h1>STASIUN PURWOKERTO<br/> <i>PURWOKERTO STATION</i></h1>
            </div>
        </div>
        <div class="nav-time">
        <?php echo date('l, d-m-Y'); ?> <br/> 
        <b><span id="jam"></span></b>
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

    <table align='center' width="100%" height="300px" cellspacing="4" cellpadding="10">
        <tr style="background-color: #ee6b1e;">
            <td>JALUR <br/> <i>TRACK</i></td>
            <td>NO & NAMA KA</td>
            <td>RELASI</td>
            <td>WAKTU BERANGKAT <br/> <i>DEPARTURE TIME</i></td>
        </tr>
    <?php
        $jalur = 1;
        $sql = "select * from peron order by jalur asc";
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
        echo "
        <tr>
            <td>$jalur</td>
            <td>$row[no] - $row[nama]</td>
            <td>$row[relasi]</td>
            <td>$row[berangkat]</td>
            </tr>
        ";
        $jalur++;
        }
    ?>
    </table>
    <footer>
        <p><marquee>PT Kereta Api Indonesia (Persero) Daop 5 Purwokerto</marquee></p>
    </footer>
</body>
</html>
