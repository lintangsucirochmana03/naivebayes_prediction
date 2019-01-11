<?php
  	//Menghitung kategori testing
    require_once "../koneksi.php";
    include 'likelihoad.php';


  //Perklian Likelihoad dengan Prior
    mysqli_query($connect,"CREATE TEMPORARY TABLE MahasiswaLP(Nim INT (10)
        ,LPTepat float(7)
        ,LPLambat float(7)
        ,Status_Lulus varchar(255));");

    $querymahasiswaBL=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('BL') ORDER BY nim;");
    $totalmahasiswaBL=mysqli_num_rows($querymahasiswaBL);

    $likelihoadarray=array();
          while  ($getnimmahasiswaBL=mysqli_fetch_assoc($querymahasiswaBL)){
            $likelihoadarray[]=$getnimmahasiswaBL['nim'];
    }
    $loop=1;

    for ($minout=1;$minout<=$totalmahasiswaBL;$minout++){
    $nimprediski=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$likelihoadarray[$minout-1].";"));

    $LPTepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT LikelihoadTepat * $prior_tepat As LPT FROM MahasiswaLikelihoad WHERE nim=".$likelihoadarray[$minout-1].";") );
    $LPLambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT LikelihoadLambat * $prior_lambat As LPL FROM MahasiswaLikelihoad WHERE nim=".$likelihoadarray[$minout-1].";") );

    $status_lulusprediksi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM Mahasiswa WHERE nim=".$testingarray[$minout-1].";"));

    mysqli_query($connect,"INSERT INTO MahasiswaLP (Nim, LPTepat, LPLambat, Status_Lulus)
        VALUES ('".$nimprediski['nim']."','".$LPTepat['LPT']."','".$LPLambat['LPL']."','".$status_lulusprediksi['status']."'); ");
    $loop+=1;
    };
?>