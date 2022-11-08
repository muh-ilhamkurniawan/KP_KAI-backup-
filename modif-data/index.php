<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Keberangkatan Stasiun Purwokerto</title>
            <!-- import bootstrap  -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
                integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        </head>
        
        <body>
            <br>
            <!-- membuat container dengan lebar colomn col-lg-10  -->
            <div class="container col-lg-12">
                <!-- membuat tulisan alert berwarna hijau dengan tulisan di tengah  -->
                <h3 class="alert alert-success text-center" role="alert">
                    Database Departure KAI DAOP 5
                </h3>
                <br>
        
                <!-- membuat card untuk membungkus tabel bootstrap  -->
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <!-- membuat form input file -->
                                <form method="post" enctype="multipart/form-data" action="excel.php">
                                    <p>Pilih File: <br><i style="font-size: 12px;">perhatikan bahwa data akan selalu terhapus dengan yang baru</i></p>
                                     <input class="form-control" name="fileexcel" type="file" required="required">
                                    <br>
                                    <button class="btn btn-sm btn-info" type="submit" name='simpan'>Submit</button>
                                </form>
                            </div>
                        </div>
                        <a href="tambah.php">
                            <button href="tambah.php" type="button" class="btn btn-primary btn-block" name="tambah">Tambah Data</button>
                        </a>
                            </div>
                    <div class="col-lg-8">
                        <table class="table">
                            <thead class="thead-dark">
                                <!-- set table header  -->
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No. Kereta</th>
                                    <th scope="col">Nama Kereta</th>
                                    <th scope="col">Relasi</th>
                                    <th scope="col">Jadwal Berangkat</th>
                                    <th scope="col">Jadwal Datang</th>
                                    <th scope="col">Jalur</th>
                                    <th scope="col">Purwokerto Datang</th>
                                    <th scope="col">Purwokerto Berangkat</th>
                                    <th scope="col">Stamformasi</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
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
                                    <td><?php echo $data['jadwal_berangkat']; ?></td>
                                    <td><?php echo $data['jadwal_datang']; ?></td>
                                    <td><?php echo $data['jumlah']; ?></td>
                                    <td><?php echo $data['purwokerto_datang']; ?></td>
                                    <td><?php echo $data['purwokerto_berangkat']; ?></td>
                                    <td><?php echo $data['stamformasi']; ?></td>
                                    <td><?php echo $data['keterangan']; ?></td>
                                    <td>
                                    <a href="delete.php?id=<?php echo $data["nomor"];?>" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash"></i>
                                    Sudah Selesai
                                    </a>
        
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </body>
        
        </html>
        