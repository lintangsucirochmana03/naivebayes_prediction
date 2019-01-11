<?php
  	//Menghitung kategori testing
    require_once "../koneksi.php";
    include 'probabilitastraining.php';

    mysqli_query($connect,"CREATE TEMPORARY TABLE MahasiswaSementaraBL(Nim INT (10)
        ,JurusanAsalBL varchar(10)
        ,IPS1BL varchar(10)
        ,IPKBL varchar(10)
        ,TotalSKSBL varchar(10)
        ,JumDBL varchar(10)
        ,JumEBL varchar(10)
        ,Status_Lulus varchar(255));");
    $querymahasiswaBL=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('BL') ORDER BY nim;");
    $totalmahasiswaBL=mysqli_num_rows($querymahasiswaBL);

    $testingarray=array();
          while  ($getnimmahasiswaBL=mysqli_fetch_assoc($querymahasiswaBL)){
            $testingarray[]=$getnimmahasiswaBL['nim'];
    }
    $loop=1;

    for ($minout=1;$minout<=$totalmahasiswaBL;$minout++){
    $nimBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));

    $jur_asalBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jurusan_asalsekolah, IF(jurusan_asalsekolah='Multimedia', 'Multimedia', IF(jurusan_asalsekolah='TKJ', 'TKJ', IF(jurusan_asalsekolah='IPA', 'IPA', IF(jurusan_asalsekolah='IPS', 'IPS', 'Lain')))) As Jurusan FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";") );

    $ipsBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ips1, IF(ips1>='2', 'Terpenuhi', 'Kurang') As IPS1 FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";") );

    $ipkBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ipk, IF(ipk>='2', 'Terpenuhi', 'Kurang') As IPK FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";") );

    $tot_sksBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT tot_sks, IF(tot_sks>=semester*18, 'Terpenuhi','Kurang') As Tot_sks FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));

    $jumDBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumD, IF(jumD<=tot_sks*0.2, 'Terpenuhi', 'Banyak') AS jumD FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));

    $jumEBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumE, IF(jumE<'1', 'Terpenuhi', 'Banyak') AS jumE FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));

    
    $status_lulusBL=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));
    

    mysqli_query($connect,"INSERT INTO MahasiswaSementaraBL (Nim, JurusanAsalBL ,IPS1BL, IPKBL, TotalSKSBL, JumDBL, JumEBL, Status_Lulus)
        VALUES ('".$nimBL['nim']."','".$jur_asalBL['Jurusan']."','".$ipsBL['IPS1']."','".$ipkBL['IPK']."','".$tot_sksBL['Tot_sks']."','".$jumDBL['jumD']."','".$jumEBL['jumE']."','".$status_lulusBL['status']."'); ");
    $loop+=1;
    };


  ?>

