<?php
include "koneksi.php";

$insert="insert into Pegawai (NIP, nama, tanggal_lahir, alamat, divisi, 
foto)
values('A12H034','Maemunah','2000/11/09','Sukabumi, Jawa Barat','HRD','coba.jpg')";
mysqli_query($conn,$insert);
?>