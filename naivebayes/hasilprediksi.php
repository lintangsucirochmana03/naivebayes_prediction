<?php
    //Menghitung kategori testing
    require_once "../koneksi.php";
    include 'menentukanprediksi.php';

    //Menampilkan Hasil Prediksi
    mysqli_query($connect,"CREATE TEMPORARY TABLE MahasiswaHasil(Nim INT (10)
        ,Nama varchar(30)
        ,JurusanAsal varchar(10)
        ,Prodi varchar(2)
        ,Semester INT(2)
        ,IPS1 float(10)
        ,IPK float(10)
        ,TotalSKS float(10)
        ,JumD float(10)
        ,JumE float(10)
        ,Status_Lulus varchar(255)
        ,Prediksi varchar(255));");

    $querymahasiswaHasil=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('BL') ORDER BY nim;");
    $totalmahasiswaHasil=mysqli_num_rows($querymahasiswaHasil);

    $hasilarray=array();
          while  ($getnimmahasiswaBL=mysqli_fetch_assoc($querymahasiswaHasil)){
            $hasilarray[]=$getnimmahasiswaBL['nim'];
          }
    $loop=1;

    for ($minout=1;$minout<=$totalmahasiswaHasil;$minout++){
    $nimi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $nama=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nama FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));
    
    $jurusan_asal=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jurusan_asalsekolah FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";") );

    $prodinew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT prodi FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $semesternew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT semester FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $ipsnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ips1 FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";") );

    $ipknew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT ipk FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";") );

    $tot_sksnew=mysqli_fetch_assoc(mysqli_query($connect,"SELECT tot_sks FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $jumD4new=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumD FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $jumE4new=mysqli_fetch_assoc(mysqli_query($connect,"SELECT jumE FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $status_lulus=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$hasilarray[$minout-1].";"));

    $prediksi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT Prediksi FROM Prediksi WHERE nim=".$hasilarray[$minout-1].";"));
    

    mysqli_query($connect,"INSERT INTO MahasiswaHasil (Nim,Nama,JurusanAsal,Prodi,Semester,IPS1,IPK,TotalSKS,JumD,JumE,Status_Lulus,Prediksi)
        VALUES ('".$nimi['nim']."','".$nama['nama']."','".$jurusan_asal['jurusan_asalsekolah']."','".$prodinew['prodi']."','".$semesternew['semester']."','".$ipsnew['ips1']."','".$ipknew['ipk']."','".$tot_sksnew['tot_sks']."','".$jumD4new['jumD']."','".$jumE4new['jumE']."','".$status_lulus['status']."','".$prediksi['Prediksi']."'); ");
    $loop+=1;

    };

    


?>