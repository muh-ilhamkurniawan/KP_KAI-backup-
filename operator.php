<?php
ini_set("display_errors",0);
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="setting3.css">
    <title>Layout Operator</title>
</head>
<body>
    <div id="container"></div>
    <nav>
        <div class="nav-desc">
            <div class="logo">
            <img src="aset/logo.png" class="featured-image" />
            </div>
            <div class="stasiun">
                OPERATOR STASIUN PURWOKERTO
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
        echo "<span class='jam'>{$hariBahasaIndonesia}</span>";
        ?> <br/> <span style='padding-right: 20px;' class="jam"> <?php echo date('d-m-Y'); ?></span>
         <br/> 
        <span id="jam" class="jam" style='padding-right: 20px;'></span>
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
    <hr>
    <div class="link">
                <a href="view.php" class="tombol-link">Halaman Peron</a> 
                <a href="modif-data\index.php" class="tombol-link">Modifikasi Data</a> 
                <a href="modif-data\tambah.php" class="tombol-link">Tambah Data</a> 
            </div>
    
                        <div class="konten">
                            <h2>Tabel Pemilihan</h2>
        <div class="form">
        <hr>
        <form action='<?php $_SERVER['PHP_SELF']; ?>' name='update' method='post' enctype='multipart/form-data'>
            <table class="table-form" width="100%" cellpadding="5" cellspacing="0">
                <tr>
                    <th width='30%'>JALUR</th>
                    <th width='40%'>NO KA</th>
                    <th width='30%'>Aksi</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="jalurka1" class="upper"></td>
                    <td><input type="submit" name="update" value="Simpan" class="tombol-link"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="jalurka2" class="upper"></td>
                    <td><input type="submit" name="update" value="Simpan" class="tombol-link"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><input type="text" name="jalurka3" class="upper"></td>
                    <td><input type="submit" name="update" value="Simpan" class="tombol-link"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><input type="text" name="jalurka4" class="upper"></td>
                    <td><input type="submit" name="update" value="Simpan" class="tombol-link"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><input type="text" name="jalurka5" class="upper"></td>
                    <td><input type="submit" name="update" value="Simpan" class="tombol-link"></td>
                </tr>   
        </table>          
    </form>
    <?php
    include "koneksi.php";

    if(isset($_POST['update'])){
        $jalur1 = $_POST['jalurka1'];
        $jalur2 = $_POST['jalurka2'];
        $jalur3 = $_POST['jalurka3'];
        $jalur4 = $_POST['jalurka4'];
        $jalur5 = $_POST['jalurka5'];
        $update ="UPDATE inputka SET no_ka = (case when jalur = 1 then '$jalur1' when jalur = 2 then '$jalur2' when jalur = 3 then '$jalur3' when jalur = 4 then '$jalur4' when jalur = 5 then '$jalur5' end) WHERE jalur in (1, 2, 3, 4, 5)"; 
        $query = mysqli_query($conn, $update);
        //penggabungan dengan tampilkan hasil

        $tabel1 = mysqli_fetch_array(mysqli_query($conn, "select * from inputka where no_ka!=' ' "));
        $nokaupdate = $tabel1['no_ka'];
        $jalurupdate = $tabel1['jalur'];
        
        $tabel2= mysqli_fetch_array(mysqli_query($conn, "select * from departure where no_ka='$nokaupdate' "));
        $no = $tabel2['no_ka'];
        $nama = $tabel2['nama_ka'];
        $tujuan = $tabel2['relasi'];
        $jam = $tabel2['purwokerto_berangkat'];
        
        if($nokaupdate=$no){
            $hasil="update hasilka set no_ka='$no', nama_ka='$nama', tujuan ='$tujuan', jam_berangkat='$jam' where jalur='$jalurupdate'";
            $query = mysqli_query($conn, $hasil);
        }else{
            ?>
            <script>
                alert('Maaf Nomor KA yang Dimasukkan Tidak Dapat Ditemukan');
            </script>
            <?php
        }
    }
?>
        </div>
        <div class="jadwal">
        <?php 
    $tabel1 = mysqli_fetch_array(mysqli_query($conn, "select * from inputka where no_ka!=' ' "));
        $nokaupdate = $tabel1['no_ka'];
        $jalurupdate = $tabel1['jalur'];
    
    if(isset($_POST['delete1'])){
        $hapus = "update hasilka set no_ka='--', nama_ka='--', tujuan ='--', jam_berangkat='--' where jalur = 1";
        $query = mysqli_query($conn, $hapus);
        if($query){
            ?>
            <script>
                alert('Data Jalur 1 Berhasil Dihapus');
                document.location='operator.php';
            </script>
            <?php
        }
    }
    if(isset($_POST['delete2'])){
        $hapus = "update hasilka set no_ka='--', nama_ka='--', tujuan ='--', jam_berangkat='--' where jalur = 2 ";
        $query = mysqli_query($conn, $hapus);
        if($query){
            ?>
            <script>
                alert('Data Jalur 2 Berhasil Dihapus');
                document.location='operator.php';
            </script>
            <?php
        }
    }
    if(isset($_POST['delete3'])){
        $hapus = "update hasilka set no_ka='--', nama_ka='--', tujuan ='--', jam_berangkat='--' where jalur = 3 ";
        $query = mysqli_query($conn, $hapus);
        if($query){
            ?>
            <script>
                alert('Data Jalur 3 Berhasil Dihapus');
                document.location='operator.php';
            </script>
            <?php
        }
    }
    if(isset($_POST['delete4'])){
        $hapus = "update hasilka set no_ka='--', nama_ka='--', tujuan ='--', jam_berangkat='--' where jalur = 4 ";
        $query = mysqli_query($conn, $hapus);
        if($query){
            ?>
            <script>
                alert('Data Jalur 4 Berhasil Dihapus');
                document.location='operator.php';
            </script>
            <?php
        }
    }
    if(isset($_POST['delete5'])){
        $hapus = "update hasilka set no_ka='--', nama_ka='--', tujuan ='--', jam_berangkat='--' where jalur = 5 ";
        $query = mysqli_query($conn, $hapus);
        if($query){
            ?>
            <script>
                alert('Data Jalur 5 Berhasil Dihapus');
                document.location='operator.php';
            </script>
            <?php
        }
    }

    $row1 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=1"));
    $row2 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=2"));
    $row3 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=3"));
    $row4 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=4"));
    $row5 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=5"));
        ?>
        <hr>
        <form action='<?php $_SERVER['PHP_SELF']; ?>' name='update' method='post' enctype='multipart/form-data'>
                <table align='center' width="100%" cellpadding="5" cellspacing="0">
                    <tr>
                        <th width="10%">NO KA</th>
                        <th width="40%">Nama KA</th>
                        <th width="20%">Tujuan</th>
                        <th width="20%">Jam Berangkat</th>
                        <th width="10%">Aksi</th>
                    </tr>
                    <tr>
                        <td><?php echo $row1['no_ka']; ?></td>
                        <td><?php echo $row1['nama_ka']; ?></td>
                        <td><?php echo $row1['tujuan']; ?></td>
                        <td><?php echo $row1['jam_berangkat']; ?></td>
                        <td><input type="submit" name="delete1" value="Hapus" class="tombol-hapus"></td>
                    </tr>
                    <tr>
                        <td><?php echo $row2['no_ka']; ?></td>
                        <td><?php echo $row2['nama_ka']; ?></td>
                        <td><?php echo $row2['tujuan']; ?></td>
                        <td><?php echo $row2['jam_berangkat']; ?></td>
                        <td><input type="submit" name="delete2" value="Hapus" class="tombol-hapus"></td>
                    </tr>
                    <tr>
                        <td><?php echo $row3['no_ka']; ?></td>
                        <td><?php echo $row3['nama_ka']; ?></td>
                        <td><?php echo $row3['tujuan']; ?></td>
                        <td><?php echo $row3['jam_berangkat']; ?></td>
                        <td><input type="submit" name="delete3" value="Hapus" class="tombol-hapus"></td>
                    </tr>
                    <tr>
                        <td><?php echo $row4['no_ka']; ?></td>
                        <td><?php echo $row4['nama_ka']; ?></td>
                        <td><?php echo $row4['tujuan']; ?></td>
                        <td><?php echo $row4['jam_berangkat']; ?></td>
                        <td><input type="submit" name="delete4" value="Hapus" class="tombol-hapus"></td>
                    </tr>
                    <tr>
                        <td><?php echo $row5['no_ka']; ?></td>
                        <td><?php echo $row5['nama_ka']; ?></td>
                        <td><?php echo $row5['tujuan']; ?></td>
                        <td><?php echo $row5['jam_berangkat']; ?></td>
                        <td><input type="submit" name="delete5" value="Hapus" class="tombol-hapus"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="klik">
                            <input type="submit" name="submit" value="SUBMIT" class="submit">
                        </td>
                    </tr>    
            </table>         
        </form>
    <?php
    include "koneksi.php";
    if(isset($_POST['submit'])){
        $row1 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=1"));
        $no1 = $row1['no_ka'];
        $nama1 = $row1['nama_ka'];
        $tujuan1= $row1['tujuan'];
        $jam1 = $row1['jam_berangkat'];
        $jalur1 = $row1['jalur'];

        $row2 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=2"));
        $no2 = $row2['no_ka'];
        $nama2= $row2['nama_ka'];
        $tujuan2 = $row2['tujuan'];
        $jam2 = $row2['jam_berangkat'];
        $jalur2 = $row2['jalur'];

        $row3 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=3"));
        $no3 = $row3['no_ka'];
        $nama3 = $row3['nama_ka'];
        $tujuan3 = $row3['tujuan'];
        $jam3 = $row3['jam_berangkat'];
        $jalur3 = $row3['jalur'];

        $row4 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=4"));
        $no4 = $row4['no_ka'];
        $nama4 = $row4['nama_ka'];
        $tujuan4 = $row4['tujuan'];
        $jam4 = $row4['jam_berangkat'];
        $jalur4 = $row4['jalur'];

        $row5 = mysqli_fetch_array(mysqli_query($conn, "select * from hasilka where jalur=5"));
        $no5 = $row5['no_ka'];
        $nama5 = $row5['nama_ka'];
        $tujuan5 = $row5['tujuan'];
        $jam5 = $row5['jam_berangkat'];
        $jalur5 = $row5['jalur'];

        $submit="INSERT INTO perontampilan (jalur, no_ka, nama_ka, tujuan, jam_berangkat)
                VALUES
                ('$jalur1', '$no1', '$nama1', '$tujuan1', '$jam1'),
                ('$jalur2', '$no2', '$nama2', '$tujuan2', '$jam2'),
                ('$jalur3', '$no3', '$nama3', '$tujuan3', '$jam3'),
                ('$jalur4', '$no4', '$nama4', '$tujuan4', '$jam4'),
                ('$jalur5', '$no5', '$nama5', '$tujuan5', '$jam5')
                ON DUPLICATE KEY UPDATE 
                jalur = VALUES(jalur), no_ka = VALUES(no_ka),  nama_ka = VALUES(nama_ka), tujuan = VALUES(tujuan), jam_berangkat = VALUES(jam_berangkat)";
        $query = mysqli_query($conn, $submit);
        if($query){
            ?>
            <script>
                alert('Data Berhasil Disubmit ke Peron');
                document.location='operator.php';
            </script>
            <?php
        }
    }
    ?>
        </div>
    </div>
    <div class="peron">
    
</div>
<h2>Tabel Data Perjalanan KA</h2>
        <hr>
        <table class="table-jadwal" width="75%" cellpadding="9" cellspacing="0">
    <thead>
    <tr>
        <th width='5%'>No</th>
        <th width='10%'>No. Kereta</th>
        <th width='35%'>Nama Kereta</th>
        <th width='15%'>Relasi</th>
        <th width='5%'>Jalur</th>
        <th width='10%'>Datang</th>
        <th width='10%'>Berangkat</th>
        <th width='10%'>Aksi</th>
        </tr>
    </thead>    
    <tbody>
    <?php
     // membuat koneksi ke database 
     $koneksi = mysqli_connect("localhost", "root", "", "kai_db");
            
    //membuat variabel angka
     $no = 1;
            
    //mengambil data dari tabel barang
    $select         = mysqli_query($koneksi, "SELECT * FROM departure ORDER BY purwokerto_berangkat");
            
    //melooping(perulangan) dengan menggunakan while
    $no = 1;
    while($data= mysqli_fetch_array($select)) :
    ?>
    <tr>
    <!-- menampilkan data dengan menggunakan array  -->
    <td><?php echo $no++ ?></td>
    <td><?php echo $data['no_ka']; ?></td>
    <td><?php echo $data['nama_ka']; ?></td>
    <td><?php echo $data['relasi']; ?></td>
    <td><?php echo $data['jumlah']; ?></td>
    <td><?php echo $data['purwokerto_datang']; ?></td>
    <td><?php echo $data['purwokerto_berangkat']; ?></td>
    <td>
        <a href="delete.php?id=<?php echo $data["nomor"];?>" class="tombol-hapus" href="#">
                Selesai
        </a> 
    </td>
   </tr>
    <?php endwhile; ?>
    </tbody>
    </table>
</body>
</html>
