<?php
    //Menghitung kategori testing
    require_once "../koneksi.php";
    include 'posterior.php';

   //Menentukan Prediksi
    mysqli_query($connect,"CREATE TEMPORARY TABLE Prediksi(Nim INT (10)
        ,Prediksi varchar(7)
        ,Status_Lulus varchar(255));");

    $querymahasiswaBL=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('BL') ORDER BY nim;");
    $totalmahasiswaBL=mysqli_num_rows($querymahasiswaBL);

    $prediksirarray=array();
          while  ($getnimmahasiswaBL=mysqli_fetch_assoc($querymahasiswaBL)){
            $prediksirarray[]=$getnimmahasiswaBL['nim'];
    }
    $loop=1;

    for ($minout=1;$minout<=$totalmahasiswaBL;$minout++){
    $nimprediski=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$prediksirarray[$minout-1].";"));

    $Prediksi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT PosteriorTepat, PosteriorLambat, IF(PosteriorTepat>PosteriorLambat, 'Tepat', 'Lambat') As Prediksi FROM MahasiswaPosterior WHERE nim=".$prediksirarray[$minout-1].";") );

    $status_lulusprediksi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$prediksirarray[$minout-1].";"));

    mysqli_query($connect,"INSERT INTO Prediksi (Nim, Prediksi, Status_Lulus)
        VALUES ('".$nimprediski['nim']."','".$Prediksi['Prediksi']."','".$status_lulusprediksi['status']."'); ");
    $loop+=1;
    };

?>