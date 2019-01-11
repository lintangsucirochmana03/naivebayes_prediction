<?php
    require_once "../koneksi.php";

	//menghitung jumlah kelas target
    $querymahasiswatepat=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('tepat') ORDER BY nim;");
    $totalmahasiswatepat=mysqli_num_rows($querymahasiswatepat);

    $querymahasiswalambat=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('lambat') ORDER BY nim;");
    $totalmahasiswalambat=mysqli_num_rows($querymahasiswalambat);

    $querymahasiswalulus=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('lambat', 'tepat') ORDER BY nim;");
    $totalmahasiswalulus=mysqli_num_rows($querymahasiswalulus);


    //menghitung prior
    $prior_tepat = $totalmahasiswatepat / $totalmahasiswalulus;
    $prior_lambat = $totalmahasiswalambat / $totalmahasiswalulus;
?>