<?php
  	//Menghitung kategori testing
    require_once "../koneksi.php";
    include 'kategoritesting.php';

        //Probabilitas Data Testing
    mysqli_query($connect,"CREATE TEMPORARY TABLE MahasiswaPrediksi(Nim INT (10)
        ,JurusanAsalTepat float(7)
        ,JurusanAsalLambat float(7)
        ,IPS1Tepat float(7)
        ,IPS1Lambat float(7)
        ,IPKT float(7)
        ,IPKL float(7)
        ,TotalSKST float(7)
        ,TotalSKSL float(7)
        ,JumDT float(7)
        ,JumDL float(7)
        ,JumET float(7)
        ,JumEL float(7)
        ,Status_Lulus varchar(255));");

    $querymahasiswaBL=mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE status IN('BL') ORDER BY nim;");
    $totalmahasiswaBL=mysqli_num_rows($querymahasiswaBL);

    $prediksiarray=array();
          while  ($getnimmahasiswaBL=mysqli_fetch_assoc($querymahasiswaBL)){
            $prediksiarray[]=$getnimmahasiswaBL['nim'];
    }
    $loop=1;

    for ($minout=1;$minout<=$totalmahasiswaBL;$minout++){
    $nimprediski=mysqli_fetch_assoc(mysqli_query($connect,"SELECT nim FROM mahasiswa WHERE nim=".$prediksiarray[$minout-1].";"));


    $jur_asalTepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JurusanAsalBL, IF(JurusanAsalBL='Multimedia', $probabilitastot_jur_asalMMT, IF(JurusanAsalBL='TKJ', $probabilitastot_jur_asalTKJT, IF(JurusanAsalBL='IPA', $probabilitastot_jur_asalIPAT, IF(JurusanAsalBL='IPS', $probabilitastot_jur_asalIPST, $probabilitastot_jur_asalLainT))))  As JurusanAsalT FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );
    $jur_asalLambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JurusanAsalBL, IF(JurusanAsalBL='Multimedia', $probabilitastot_jur_asalMML, IF(JurusanAsalBL='TKJ', $probabilitastot_jur_asalTKJL, IF(JurusanAsalBL='IPA', $probabilitastot_jur_asalIPAL, IF(JurusanAsalBL='IPS', $probabilitastot_jur_asalIPSL, $probabilitastot_jur_asalLainL))))  As JurusanAsalL FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );

    $ips1Tepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT IPS1BL, IF(IPS1BL='Terpenuhi', $probabilitasips1TT, $probabilitasips1KT) As IPS1T FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );
    $ips1Lambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT IPS1BL, IF(IPS1BL='Terpenuhi', $probabilitasips1TL, 
        $probabilitasips1KL ) As IPS1L FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );

    $ipkTepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT IPKBL, IF(IPKBL='Terpenuhi', $probabilitasipkTT, $probabilitasipkKT) As IPKT FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );
    $ipkLambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT IPKBL, IF(IPKBL='Terpenuhi', $probabilitasipkTL, 
        $probabilitasipkKL ) As IPKL FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );

    $tot_sksTepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT TotalSKSBL, IF(TotalSKSBL='Terpenuhi', $probabilitastot_sksTT, $probabilitastot_sksKT) As TotalSKST FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );
    $tot_sksLambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT TotalSKSBL, IF(TotalSKSBL='Terpenuhi', $probabilitastot_sksTL, $probabilitastot_sksKL ) As TotalSKSL FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );

    $jumDTepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JumDBL, IF(JumDBL='Terpenuhi', $probabilitastot_jumDTT, $probabilitastot_jumDBT) As JumD FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );
    $jumDLambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JumDBL, IF(JumDBL='Terpenuhi', $probabilitastot_jumDTL, $probabilitastot_jumDBL ) As JumD FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );

    $jumETepat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JumEBL, IF(JumEBL='Terpenuhi', $probabilitastot_jumETT, $probabilitastot_jumEBT) As JumE FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );
    $jumELambat=mysqli_fetch_assoc(mysqli_query($connect,"SELECT JumEBL, IF(JumEBL='Terpenuhi', $probabilitastot_jumETL, $probabilitastot_jumEBL ) As JumE FROM MahasiswaSementaraBL WHERE nim=".$prediksiarray[$minout-1].";") );
        
    $status_lulusprediksi=mysqli_fetch_assoc(mysqli_query($connect,"SELECT status FROM mahasiswa WHERE nim=".$testingarray[$minout-1].";"));
    

    mysqli_query($connect,"INSERT INTO MahasiswaPrediksi (Nim, JurusanAsalTepat, JurusanAsalLambat, IPS1Tepat, IPS1Lambat, IPKT, IPKL, TotalSKST, TotalSKSL, JumDT, JumDL, JumET, JumEL, Status_Lulus)
        VALUES ('".$nimprediski['nim']."','".$jur_asalTepat['JurusanAsalT']."','".$jur_asalLambat['JurusanAsalL']."','".$ips1Tepat['IPS1T']."','".$ips1Lambat['IPS1L']."','".$ipkTepat['IPKT']."','".$ipkLambat['IPKL']."','".$tot_sksTepat['TotalSKST']."','".$tot_sksLambat['TotalSKSL']."','".$jumDTepat['JumD']."','".$jumDLambat['JumD']."','".$jumETepat['JumE']."','".$jumELambat['JumE']."','".$status_lulusprediksi['status']."'); ");
    $loop+=1;
    };


?>