<?php
//export.php  

if (!empty($_FILES["excel_LT"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_LT"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered table-sm'>  
                     <tr> 
                          <th>Kode</th> 
                          <th>Agent</th>
                          <th>Kota</th>
                          <th>judul</th>  
                          <th>twn</th>  
                          <th>single</th>
                          <th>cnb</th>
                          <th>single sub</th>
                          <th>infant</th>
                          <th>hotel</th>      
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_LT"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $update = 0;
          $hapus = 0;
          $gagal_hapus = 0;
          $gagalupdate = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('main');
          $date = date("Y-m-d");
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 6; $row <= $highestRow; $row++) {
                         $kode = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $no_urut = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $status =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());

                         $benua = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $kota = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $judul = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());

                         $pax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         $pax_u = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         $pax_b = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());

                         $twn = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                         $sgl = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                         $cnb = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                         $sgl_sub = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                         $infant =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                         $expired =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());

                         $itin_link =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(19, $row)->getValue());

                         $hotel1 =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(22, $row)->getValue());
                         $hotel2 =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(23, $row)->getValue());
                         $hotel3 =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(24, $row)->getValue());
                         $hotel4 =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(25, $row)->getValue());
                         $hotel5 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(26, $row)->getValue());
                         $hotel6 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(27, $row)->getValue());
                         $hotel7 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(28, $row)->getValue());
                         $hotel8 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(29, $row)->getValue());
                         $hotel9 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(30, $row)->getValue());
                         $hotel10 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(31, $row)->getValue());
                         $ket = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(32, $row)->getValue());

                         $atwn = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(33, $row)->getValue());
                         $asgl = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(34, $row)->getValue());
                         $acnb = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(35, $row)->getValue());
                         $asgl_sub = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(36, $row)->getValue());
                         $ainfant =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(37, $row)->getValue());
                         $agent =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(38, $row)->getValue());
                         $vp =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(39, $row)->getValue());

                         $tgl_brkt =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(40, $row)->getValue());
                         $city_in =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(41, $row)->getValue());
                         $city_out =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(42, $row)->getValue());
                         $itin_np = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(43, $row)->getValue());


                         // $link = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         if ($judul != "HAPUS") {

                              if ($kode != '' && $no_urut != '' && $negara != '' && $twn != '') {
                                   if ($pax == '') {
                                        $pax = '0';
                                   }
                                   if ($pax_u == '') {
                                        $pax_u = '0';
                                   }
                                   if ($pax_b == '') {
                                        $pax_b = '0';
                                   }

                                   $query_update = "SELECT * FROM LT_itinnew where kode like'" . $kode . "' &&  no_urut='" . $no_urut . "'";
                                   $rs_update = mysqli_query($con, $query_update);
                                   $row_update = mysqli_fetch_array($rs_update);
                                   // var_dump($query_update);
                                   if ($row_update['id'] == "") {
                                        $sql = "INSERT INTO LT_itinnew VALUES ('','$date','$kode','$no_urut','$agent','$benua','$negara','$kota','$judul','$kurs','$pax','$pax_u','$pax_b','$twn','$sgl','$cnb','$sgl_sub','$infant','$atwn','$asgl','$acnb','$asgl_sub','$ainfant','$expired','$hotel1','$hotel2','$hotel3','$hotel4','$hotel5','$hotel6','$hotel7','$hotel8','$hotel9','$hotel10','$ket','$vp','" . $tgl_brkt . "','$city_in','$city_out','" . $itin_link . "','" . $itin_np . "','$status')";
                                        if (mysqli_query($con, $sql)) {
                                             $output .= '  
                                        <tr>  
                                             <td>' . $kode . '</td>
                                             <td>' . $agent . '</td>  
                                             <td>' . $kota . '</td>
                                             <td>' . $judul . '</td> 
                                             <td>' . $twn . '</td>
                                             <td>' . $sgl . '</td> 
                                             <td>' . $cnb . '</td>
                                             <td>' . $sgl_sub . '</td> 
                                             <td>' . $infant . '</td>
                                             <td>' . $hotel1 . '</td> 
                                        </tr>  
                                        ';
                                             $berhasil++;
                                        } else {
                                             $gagal++;
                                        }
                                   } else {
                                        $sql2 = "UPDATE LT_itinnew SET agent='$agent', statuss='$status', benua='$benua', negara='$negara',kota='$kota', judul='$judul' ,kurs='$kurs',pax='$pax',pax_u='$pax_u',pax_b='$pax_b', twn='$twn', sgl='$sgl',cnb='$cnb',sgl_sub='$sgl_sub',infant='$infant',agent_twn='$atwn', agent_sgl='$asgl',agent_cnb='$acnb',agent_sglsub='$asgl_sub',agent_infant='$ainfant',expired='$expired', hotel1='$hotel1',hotel2='$hotel2',hotel3='$hotel3',hotel4='$hotel4',hotel5='$hotel5',hotel6='$hotel6',hotel7='$hotel7',hotel8='$hotel8',hotel9='$hotel9',hotel10='$hotel10',ket='$ket',vp='$vp', tgl_brkt='" . $tgl_brkt . "', city_in='" . $city_in . "', city_out='" . $city_out . "', litin_asli='" . $itin_link . "',itin_np='" . $itin_np . "' WHERE id='" . $row_update['id'] . "'";
                                        // var_dump($sq2);

                                        if (mysqli_query($con, $sql2)) {
                                             $output .= '  
                                        <tr>  
                                        <td>' . $kode . '</td> 
                                        <td>' . $agent . '</td> 
                                        <td>' . $kota . '</td>
                                        <td>' . $judul . '</td> 
                                        <td>' . $twn . '</td>
                                        <td>' . $sgl . '</td> 
                                        <td>' . $cnb . '</td>
                                        <td>' . $sgl_sub . '</td> 
                                        <td>' . $infant . '</td>
                                        <td>' . $hotel1 . '</td> 
                                        </tr>  
                                        ';
                                             $update++;
                                        } else {
                                             $gagalupdate++;
                                        }
                                   }
                              }
                         } else {
                              $query_hapus = "SELECT * FROM LT_itinnew where judul LIKE 'HAPUS'  && kode like'" . $kode . "' &&  no_urut='" . $no_urut . "'";
                              $rs_hapus = mysqli_query($con, $query_hapus);
                              $row_hapus = mysqli_fetch_array($rs_hapus);
                              if ($row_hapus['id'] != "") {
                                   $sql_del = "DELETE FROM LT_itinnew WHERE id=" . $row_hapus['id'];
                                   if ($con->query($sql_del) === TRUE) {
                                       $hapus++;
                                   } else {
                                        $gagal_hapus++;
                                   }
                              }
                         }
                    }
               }

               $halaman++;
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-warning'>Data Update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal Update : " . $gagalupdate . "</label>  ";
          $output .= "</br><label class='text-danger'>Data Delete : " . $hapus . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
