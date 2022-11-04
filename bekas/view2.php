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

<html>
  <head>
    <title>My Website</title>
    <link rel="stylesheet" href="assets/styles/style.css" />
    <link rel="shortcut icon" href="assets\image\icon.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    <header>
      <nav>
        <div class="nav-left">
            <h2><h1>STASIUN PURWOKERTO<br/> <i>PURWOKERTO STATION</i></h1></h2>
        </div>
        <div class="nav-right">
        <?php echo date('l'); ?> <br/> 
        <?php echo date('d-m-Y'); ?> <br/> 
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
      
    </header>
    <main>
    <table align='center' width="100%" height="300px" cellspacing="4" cellpadding="10">
        <tr style="background-color: #ee6b1e;">
            <td>JALUR <br/> <i>TRACK</i></td>
            <td>NO & NAMA KA <br/> <i>KA NUMBER & NAME</i></td>
            <td>RELASI <br/> <i>RELASI</i></td>
            <td>WAKTU BERANGKAT <br/> <i>DEPARTURE TIME</i></td>
            <td>TOMBOL</td>
        </tr>
    <?php
        $jalur = 1;
        $sql = "select * from peron order by jalur asc";
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
        echo "
        <tr  style='background-color: #050670;'>
            <td>$jalur</td>
            <td>$row[no] - $row[nama]</td>
            <td>$row[relasi]</td>
            <td>$row[berangkat]</td>
            <td>					
                <a href='update.php?id=$row[jalur]'>Edit</a>
                <a href='view.php?id=$row[jalur]'>Hapus</a>
            </td>
            </tr>
        ";
        $jalur++;
        }
    ?>
    </table>
    </main>

    <footer>        
        <p><marquee>PT Kereta Api Indonesia (Persero) Daop 5 Purwokerto</marquee></p></footer>
  </body>
</html>
