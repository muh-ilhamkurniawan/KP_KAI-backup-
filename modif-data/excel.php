<?php 
include "koneksi.php";
            // menghubungkan dengan library excel reader
            include "excel_reader.php";
            //require "excelreader/excel_reader2.php";
            require "excelreader/SpreadsheetReader.php";
            require "excelreader/SpreadsheetReader_XLSX.php";
            require "excelreader/SpreadsheetReader_XLS.php";
            require "excelreader/SpreadsheetReader_CSV.php";
            
            // upload file xls
            $target = basename($_FILES['fileexcel']['name']) ;
            move_uploaded_file($_FILES['fileexcel']['tmp_name'], $target);
            
            // beri permisi agar file xls dapat di baca
           // chmod($_FILES['fileexcel']['name'],0777);
            
            // mengambil isi file xls
            $data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['name'],false);
            // menghitung jumlah baris data yang ada
            $jumlah_baris = $data->rowcount($sheet_index=0);
            
            // jumlah default data yang berhasil di import
            
            for ($i=2; $i<=$jumlah_baris; $i++){
            
                // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
                $no     	        = $data->val($i, 1);
                $no_ka              = $data->val($i, 2);
                $nama_ka  		    = $data->val($i, 3);
                $relasi		        = $data->val($i, 4);
                $jadwal_berangkat	= $data->val($i, 5);
                $jadwal_datang		= $data->val($i, 6);
                $jumlah		        = $data->val($i, 7);
                $purwokerto_datang	= $data->val($i, 8);
                $purwokerto_berangkat= $data->val($i, 9);
                $stamformasi		= $data->val($i, 10);
                $keterangan		    = $data->val($i, 11);
            
                
                    // input data ke database (table barang)
                    mysqli_query($koneksi,"INSERT into departure 
                    VALUES('','$no','$no_ka','$nama_ka','$relasi',
                     '$jadwal_berangkat', '$jadwal_datang', '$jumlah',
                     '$purwokerto_datang', '$purwokerto_berangkat',
                     '$stamformasi','$keterangan')");
                
            }
            
            // hapus kembali file .xls yang di upload tadi
            unlink($_FILES['fileexcel']['name']);
            
            // alihkan halaman ke index.php
            header("location:../operator.php");
            ?>