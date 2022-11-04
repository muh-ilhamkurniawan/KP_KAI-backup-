<?php
    include "koneksi.php";
    if(isset($_POST['input'])){
        $jl = $_POST['jalur'];
        $nip = $_POST['no'];
        $namapgw = $_POST['nama'];
        $ttl = $_POST['berangkat'];
        $rumah = $_POST['relasi'];
        
        $insert ="insert into peron(jalur, no, nama, berangkat, relasi)
                values('$jl','$nip','$namapgw','$ttl','$rumah')";
        $query = mysqli_query($conn, $insert);
        if ($query){
?>
            <script>alert('Data Berhasil ditambahkan');
            document.location='masuk.php';
            </script>
<?php
        }
    }
?>
<form action='<?php $_SERVER['PHP_SELF'];?>'
    name='insert' method='post' enctype='multipart/form-data'
    <!-- NIP, Nama, Tanggal_Lahir, Alamat, Divisi, Foto-->
    <table align="center">
        <tr>
            <td>JALUR </td>
            <td><input type="text" name="jalur"></td>
        </tr>
        <tr>
            <td>NO KA</td>
            <td><input type="text" name="no"></td>
        </tr>
        <tr>
            <td>NAMA KA</td>
            <td><input type="text" name="nama"></td>
        </tr>

        <tr>
            <td>RELASI</td>
            <td><input type="text" name="relasi"></textarea></td>
        </tr>
        <tr>
            <td>KEBERANGKATAN</td>
            <td><input type="text" name="berangkat"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name='input' value='Tambah Data'></td>
        </tr>
    </table>
</form>