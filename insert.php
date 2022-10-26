<?php
    include "koneksi.php";
    if(isset($_POST['input'])){
        $nip = $_POST['nip'];
        $namapgw = $_POST['namapegawai'];
        $ttl = $_POST['tgllahir'];
        $rumah = $_POST['alamat'];
        $division = $_POST['div'];
        $insert ="insert into Pegawai(NIP, nama, tanggal_lahir, alamat, divisi)
                values('$nip','$namapgw','$ttl','$rumah','$division')";
        $query = mysqli_query($conn, $insert);
        if ($query){
?>
            <script>alert('Data Berhasil ditambahkan');
            document.location='insert.php';
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
            <td>NO KA</td>
            <td><input type="text" name="nip"></td>
        </tr>
        <tr>
            <td>NAMA KA</td>
            <td><input type="text" name="namapegawai"></td>
        </tr>

        <tr>
            <td>TUJUAN</td>
            <td><textarea name="alamat" cols="20" rows="10"></textarea></td>
        </tr>
        <tr>
            <td>KEBERANGKATAN</td>
            <td><input type="date" name="tgllahir"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name='input' value='Tambah Data'></td>
        </tr>
    </table>
</form>