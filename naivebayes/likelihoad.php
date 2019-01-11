<?php
  	//Menghitung kategori testing
    require_once "../koneksi.php";
    include 'probabilitastesting.php';

       //Likelihoad
    mysqli_query($connect,"CREATE TEMPORARY TABLE MahasiswaLikelihoad(Nim INT (10)
        ,LikelihoadTepat float(7)
        ,LikelihoadLambat float(7)
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

    $likelihoadTepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JurusanAsalTepat*IPS1Tepat*IPKT*TotalSKST*JumDT*JumET As likelihoadT FROM MahasiswaPrediksi WHERE nim=".$likelihoadarray[$minout-1].";") );
    $likelihoadLambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JurusanAsalLambat*IPS1Lambat*IPKL*TotalSKSL*JumDL*JumEL As likelihoadL FROM MahasiswaPrediksi WHERE nim=".$likelihoadarray[$minout-1].";") );

    $status_lulusprediksi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));

    mysqli_query($connect,"INSERT INTO MahasiswaLikelihoad (Nim, LikelihoadTepat, LikelihoadLambat, Status_Lulus)
        VALUES ('".$nimprediski['nim']."','".$likelihoadTepat['likelihoadT']."','".$likelihoadLambat['likelihoadL']."','".$status_lulusprediksi['status']."'); ");
    $loop+=1;
    };

  ?>