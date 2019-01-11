<?php
    //Menghitung kategori testing
    require_once "../koneksi.php";
    include 'hasilprediksi.php';

   //Menampilkan Hasil Prediksi
    mysqli_query($connect,"CREATE TEMPORARY TABLE MinimalMahasiswa(Nim INT (10)
        ,JurusanAsal varchar(10)
        ,Prodi varchar(2)
        ,Semester INT(2)
        ,IPS1 float(10)
        ,IPK float(10)
        ,TotalSKS float(10)
        ,JumD float(10)
        ,JumE float(10)
        ,Status_Lulus varchar(255));");

    $queryMinimalmahasiswa=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('BL') ORDER BY nim;");
    $totalMinimalmahasiswa=mysqli_num_rows($queryMinimalmahasiswa);

    $hasilarray=array();
          while  ($getnimmahasiswaBL=mysqli_fetch_assoc($queryMinimalmahasiswa)){
            $hasilarray[]=$getnimmahasiswaBL['nim'];
          }
    $loop=1;

    for ($minout=1;$minout<=$totalMinimalmahasiswa;$minout++){
    $nimi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));
    
    $jurusan_asal=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jurusan_asalsekolah FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";") );

    $prodinew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT prodi FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $semesternew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT semester FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $ipsnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ips1, IF(ips1>=3.00, ips1, '3.00') As ips1minim FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";") );

    $ipknew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ipk, IF(ipk>=3.00, ipk, '3.00') As ipkminim FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";") );

    $tot_sksnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT tot_sks, IF(tot_sks>=semester*18, tot_sks, semester*18) As tot_sksminim FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $jumD4new=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumD, IF(jumD<=tot_sks*0.2, jumD, tot_sks*0.2) AS jumDminim FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $jumE4new=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumE, IF(jumE<1, jumE, '0') AS jumEminim  FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $status_lulus=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    



    mysqli_query($connect,"INSERT INTO MinimalMahasiswa (Nim,JurusanAsal,Prodi,Semester,IPS1,IPK,TotalSKS,JumD,JumE,Status_Lulus)
        VALUES ('".$nimi['nim']."','".$jurusan_asal['jurusan_asalsekolah']."','".$prodinew['prodi']."','".$semesternew['semester']."','".$ipsnew['ips1minim']."','".$ipknew['ipkminim']."','".$tot_sksnew['tot_sksminim']."','".$jumD4new['jumDminim']."','".$jumE4new['jumEminim']."','".$status_lulus['status']."'); ");
    $loop+=1;
    };
    

?>