<?php
  	//Menghitung Probabiltas Data Training
    require_once "../koneksi.php";
    include 'kategoritraining.php';

    $queryjur_asalMMT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('Multimedia') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaljur_asalMMT=mysqli_num_rows($queryjur_asalMMT);

    $queryjur_asalMML=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('Multimedia') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaljur_asalMML=mysqli_num_rows($queryjur_asalMML);

    $queryjur_asalTKJT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('TKJ') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaljur_asalTKJT=mysqli_num_rows($queryjur_asalTKJT);

    $queryjur_asalTKJL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('TKJ') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaljur_asalTKJL=mysqli_num_rows($queryjur_asalTKJL);

    $queryjur_asalIPAT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('IPA') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaljur_asalIPAT=mysqli_num_rows($queryjur_asalIPAT);

    $queryjur_asalIPAL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('IPA') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaljur_asalIPAL=mysqli_num_rows($queryjur_asalIPAL);

    $queryjur_asalIPST=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('IPS') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaljur_asalIPST=mysqli_num_rows($queryjur_asalIPST);

    $queryjur_asalIPSL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE  JurusanAsal IN('IPS') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaljur_asalIPSL=mysqli_num_rows($queryjur_asalIPSL);

    $queryjur_asalLainT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('Lain') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaljur_asalLainT=mysqli_num_rows($queryjur_asalLainT);

    $queryjur_asalLainL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JurusanAsal IN('Lain') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaljur_asalLainL=mysqli_num_rows($queryjur_asalLainL);


    $queryips1TT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPS1 IN('Terpenuhi') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totalips1TT=mysqli_num_rows($queryips1TT);

    $queryips1TL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPS1 IN('Terpenuhi') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totalips1TL=mysqli_num_rows($queryips1TL);

    $queryips1KT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPS1 IN('Kurang') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totalips1KT=mysqli_num_rows($queryips1KT);

    $queryips1KL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPS1 IN('Kurang') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totalips1KL=mysqli_num_rows($queryips1KL);


    $queryipkTT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPK IN('Terpenuhi') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totalipkTT=mysqli_num_rows($queryipkTT);

    $queryipkTL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPK IN('Terpenuhi') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totalipkTL=mysqli_num_rows($queryipkTL);

    $queryipkKT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPK IN('Kurang') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totalipkKT=mysqli_num_rows($queryipkKT);

    $queryipkKL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE IPK IN('Kurang') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totalipkKL=mysqli_num_rows($queryipkKL);


    $querytot_sksTT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE TotalSKS IN('Terpenuhi') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaltot_sksTT=mysqli_num_rows($querytot_sksTT);

    $querytot_sksTL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE TotalSKS IN('Terpenuhi') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaltot_sksTL=mysqli_num_rows($querytot_sksTL);

    $querytot_sksKT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE TotalSKS IN('Kurang') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaltot_sksKT=mysqli_num_rows($querytot_sksKT);

    $querytot_sksKL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE TotalSKS IN('Kurang') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaltot_sksKL=mysqli_num_rows($querytot_sksKL);


    $querytot_jumDTT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumD IN('Terpenuhi') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaltot_jumDTT=mysqli_num_rows($querytot_jumDTT);

    $querytot_jumDTL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumD IN('Terpenuhi') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaltot_jumDTL=mysqli_num_rows($querytot_jumDTL);

    $querytot_jumDBT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumD IN('Banyak') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaltot_jumDBT=mysqli_num_rows($querytot_jumDBT);

    $querytot_jumDBL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumD IN('Banyak ') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaltot_jumDBL=mysqli_num_rows($querytot_jumDBL);


    $querytot_jumETT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumE IN('Terpenuhi') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaltot_jumETT=mysqli_num_rows($querytot_jumETT);

    $querytot_jumETL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumE IN('Terpenuhi') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaltot_jumETL=mysqli_num_rows($querytot_jumETL);

    $querytot_jumEBT=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumE IN('Banyak') AND Status_Lulus IN('Tepat') ORDER BY nim;");
    $totaltot_jumEBT=mysqli_num_rows($querytot_jumEBT);

    $querytot_jumEBL=mysqli_query($connect,"SELECT nim FROM MahasiswaSementara WHERE JumE IN('Banyak ') AND Status_Lulus IN('Lambat') ORDER BY nim;");
    $totaltot_jumEBL=mysqli_num_rows($querytot_jumEBL);


    $probabilitasips1TT=$totalips1TT/$totalmahasiswatepat;
    $probabilitasips1TL=$totalips1TL/$totalmahasiswalambat;
    $probabilitasips1KT=$totalips1KT/$totalmahasiswatepat;
    $probabilitasips1KL=$totalips1KL/$totalmahasiswalambat;  

    $probabilitasipkTT=$totalipkTT/$totalmahasiswatepat;
    $probabilitasipkTL=$totalipkTL/$totalmahasiswalambat;
    $probabilitasipkKT=$totalipkKT/$totalmahasiswatepat;
    $probabilitasipkKL=$totalipkKL/$totalmahasiswalambat;

    $probabilitastot_sksTT=$totaltot_sksTT/$totalmahasiswatepat;
    $probabilitastot_sksTL=$totaltot_sksTL/$totalmahasiswalambat;
    $probabilitastot_sksKT=$totaltot_sksKT/$totalmahasiswatepat;
    $probabilitastot_sksKL=$totaltot_sksKL/$totalmahasiswalambat;  

    $probabilitastot_jumDTT=$totaltot_jumDTT/$totalmahasiswatepat;
    $probabilitastot_jumDTL=$totaltot_jumDTL/$totalmahasiswalambat;
    $probabilitastot_jumDBT=$totaltot_jumDBT/$totalmahasiswatepat;
    $probabilitastot_jumDBL=$totaltot_jumDBL/$totalmahasiswalambat;    

    $probabilitastot_jumETT=$totaltot_jumETT/$totalmahasiswatepat;
    $probabilitastot_jumETL=$totaltot_jumETL/$totalmahasiswalambat;
    $probabilitastot_jumEBT=$totaltot_jumEBT/$totalmahasiswatepat;
    $probabilitastot_jumEBL=$totaltot_jumEBL/$totalmahasiswalambat;    

    $probabilitastot_jur_asalMMT=$totaljur_asalMMT/$totalmahasiswatepat;
    $probabilitastot_jur_asalMML=$totaljur_asalMML/$totalmahasiswalambat;
    $probabilitastot_jur_asalTKJT=$totaljur_asalTKJT/$totalmahasiswatepat;
    $probabilitastot_jur_asalTKJL=$totaljur_asalTKJL/$totalmahasiswalambat;    
    $probabilitastot_jur_asalIPAT=$totaljur_asalIPAT/$totalmahasiswatepat;
    $probabilitastot_jur_asalIPAL=$totaljur_asalIPAL/$totalmahasiswalambat;
    $probabilitastot_jur_asalIPST=$totaljur_asalIPST/$totalmahasiswatepat;
    $probabilitastot_jur_asalIPSL=$totaljur_asalIPSL/$totalmahasiswalambat;    
    $probabilitastot_jur_asalLainT=$totaljur_asalLainT/$totalmahasiswatepat;
    $probabilitastot_jur_asalLainL=$totaljur_asalLainL/$totalmahasiswalambat;    


?>