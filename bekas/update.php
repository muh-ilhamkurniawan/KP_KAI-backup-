<?php
    include "koneksi.php";
    $id_update = $_GET['jalur'];
    if(isset($_POST['ubah'])){
        $nip = $_POST['nip'];
        $namapgw = $_POST['namapegawai'];
        $ttl = $_POST['tgllahir'];
        $rumah = $_POST['alamat'];
        $division = $_POST['div'];
        $gbr = $_FILES['fotodiri']['name'];
        if($gbr!=''){
            $upload = 'gambar/'.$gbr;
            move_uploaded_file($_FILES["fotodiri"]["tmp_name"], $upload);
            $update = "update Pegawai set 
            NIP='$nip', 
            nama='$namapgw',
            tanggal_lahir='$ttl',
            alamat='$rumah',
            divisi='$division',
            foto='$upload'
            where NIP='$id_update'";
        }else{
            $update= "update Pegawai set
            NIP='$nip', 
            nama='$namapgw',
            tanggal_lahir='$ttl',
            alamat='$rumah',
            divisi='$division',
            where NIP='$id_update'";
        }
        $query = mysqli_query($conn,$update);
        if ($query){
?>
            <script>alert('Data Berhasil diubah');
            document.location='view.php';
            </script>
<?php
        }
    }
    $row = mysqli_fetch_array(mysqli_query($conn, "select * from Pegawai 
    where NIP='$id_update'"));
    if($row['NIP']!=""){
        ?>
        <form action='<?php $_SERVER['PHP_SELF'];?>'
        name='update' method='post' enctype='multipart/form-data'>
        <!-- NIP, Nama, Tanggal_Lahir, Alamat, Divisi, Foto-->
            <table align="center">
                <tr>
                    <td>NIP</td>
                    <td>
                        <input type="text" name="nip" value='<?php echo $row['NIP'];?>'/>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>
                        <input type="text" name="namapegawai"value='<?php echo $row['nama'];?>'/>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>
                        <input type="date" name="tgllahir" value='<?php echo $row['tanggal_lahir'];?>'>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><textarea name="alamat" cols="30" rows="10" value='<?php echo $row['alamat']; ?>'>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Divisi</td>
                    <td><select name="div" id="" value = '<?php echo $row['divisi']; ?>'>
                        <option value="IT">IT</option>
                        <option value="HRD">HRD</option>
                        <option value="umum">Umum</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Upload Foto Diri</td>
                    <td><img src='<?php echo $row['foto'];?>' width='200' height='200'>
                    <br>
                    <input type="file" name="fotodiri"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='ubah' value='Ubah Data Pegawai'></td>
                </tr>
            </table>
        </form>
<?php
        }
?>
