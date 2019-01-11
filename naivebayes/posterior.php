<?php
  	//Menghitung kategori testing
    require_once "../koneksi.php";
    include 'perkalian_priorlikelihoad.php';

       //Menghitung Probabilitas Posterior
    mysqli_query($connect,"CREATE TEMPORARY TABLE MahasiswaPosterior(Nim INT (10)
        ,PosteriorTepat float(7)
        ,PosteriorLambat float(7)
        ,Status_Lulus varchar(255));");

    $querymahasiswaBL=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('BL') ORDER BY nim;");
    $totalmahasiswaBL=mysqli_num_rows($querymahasiswaBL);

    $posteriorarray=array();
          while  ($getnimmahasiswaBL=mysqli_fetch_assoc($querymahasiswaBL)){
            $posteriorarray[]=$getnimmahasiswaBL['nim'];
    }
    $loop=1;

    for ($minout=1;$minout<=$totalmahasiswaBL;$minout++){
    $nimprediski=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$posteriorarray[$minout-1].";"));

    $PosteriorTepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT LPTepat / (LPTepat+LPLambat) As PosteriorT FROM MahasiswaLP WHERE nim=".$likelihoadarray[$minout-1].";") );
    $PosteriorLambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT LPLambat / (LPTepat+LPLambat) As PosteriorL FROM MahasiswaLP WHERE nim=".$likelihoadarray[$minout-1].";") );

    $status_lulusprediksi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));

    mysqli_query($connect,"INSERT INTO MahasiswaPosterior (Nim, PosteriorTepat, PosteriorLambat, Status_Lulus)
        VALUES ('".$nimprediski['nim']."','".$PosteriorTepat['PosteriorT']."','".$PosteriorLambat['PosteriorL']."','".$status_lulusprediksi['status']."'); ");
    $loop+=1;
    };

?>