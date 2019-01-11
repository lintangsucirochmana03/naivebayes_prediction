<?php
    require_once "../koneksi.php";
    include 'prior.php'; 

    
    //Kotegoritraining
    mysqli_query($connect,"CREATE TEMPORARY TABLE MahasiswaSementara(Nim INT (10)
        ,Prodi varchar(2)
        ,JurusanAsal varchar(10)
        ,IPS1 varchar(10)
        ,IPK varchar(10)
        ,TotalSKS varchar(10)
        ,JumD varchar(10)
        ,JumE varchar(10)
        ,Status_Lulus varchar(255));");

    $dataarray=array();
          while  ($getnimmahasiswa=mysqli_fetch_assoc($querymahasiswalulus)){
            $dataarray[]=$getnimmahasiswa['nim'];
          }
    $loop=1;

    for ($minout=1;$minout<=$totalmahasiswalulus;$minout++){
    $nimi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";"));
    
    $prodinew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT prodi FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";"));

    $jurusan_asal=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jurusan_asalsekolah, IF(jurusan_asalsekolah='Multimedia', 'Multimedia', IF(jurusan_asalsekolah='TKJ', 'TKJ', IF(jurusan_asalsekolah='IPA', 'IPA', IF(jurusan_asalsekolah='IPS', 'IPS', 'Lain')))) As jurusan FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";") );

    $ipsnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ips1, IF(ips1>='2', 'Terpenuhi', 'Kurang') As IPS1 FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";") );

    $ipknew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ipk, IF(ipk>='2', 'Terpenuhi', 'Kurang') As IPK FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";") );

    $tot_sksnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT tot_sks, IF(tot_sks>=semester*18, 'Terpenuhi','Kurang') As Tot_sks FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";"));

    $jumDnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumD, IF(jumD<=tot_sks*0.2, 'Terpenuhi', 'Banyak') AS Dbaru FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";"));

    $jumEnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumE, IF(jumE<'1', 'Terpenuhi', 'Banyak') AS Ebaru FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";"));

    $status_lulus=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$dataarray[$minout-1].";"));
    


    mysqli_query($connect,"INSERT INTO MahasiswaSementara (Nim,Prodi,JurusanAsal,IPS1,IPK,TotalSKS,JumD,JumE,Status_Lulus)
        VALUES ('".$nimi['nim']."','".$prodinew['prodi']."','".$jurusan_asal['jurusan']."','".$ipsnew['IPS1']."','".$ipknew['IPK']."','".$tot_sksnew['Tot_sks']."','".$jumDnew['Dbaru']."','".$jumEnew['Ebaru']."','".$status_lulus['status']."'); ");
    $loop+=1;
    };
?>