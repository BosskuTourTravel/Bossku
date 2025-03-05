<?php
//export.php  

if (!empty($_FILES["excel_ferry"])) {

     include "../site.php";
     include "../db=connection.php";
     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_ferry"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>RUTE</th> 
                          <th>TYPE</th>
                          <th>KOTA</th> 
                          <th>FERRY NAME</th>
                          <th>ADULT</th>
                          <th>CHILD</th>
                          <th>INFANT</th>
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_ferry"]["tmp_name"]);
          $berhasil = 0;
          $update = 0;
          $gagal = 0;
          $gagal_update =0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('Sheet1');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $rute = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $dor = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $tgl = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $kota = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $f_name = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $f_code = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                         $f_agent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         $f_class = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         $from = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                         $to = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                         $jam_dep = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                         $jam_arr = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                         $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                         $adult =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                         $child =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
                         $infant =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                         $senior =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                         $tax_adt =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(19, $row)->getValue());
                         $tax_chd = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(20, $row)->getValue());
                         $tax_inf =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(21, $row)->getValue());
                         $tax_snr =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(22, $row)->getValue());

                         if ($rute != '' && $type != '' && $dor != '' && $f_name != '') {
                              // var_dump($tc);
                              $query_update = "SELECT * FROM ferry_LT where nama='$rute' and type='$type' and dor='$dor' and ferry_name='$f_name' and ferry_agent='$f_agent' and kota='$kota' and dari='$from' and ke='$to' and jam_dept='$jam_dep' and jam_arr='$jam_arr'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);

                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO ferry_LT VALUES ('','$rute','$type','$dor','$tgl','$negara','$kota','$f_name','$f_code','$f_agent','$f_class','$from','$to','$jam_dep','$jam_arr','$kurs','$adult','$child','$infant','$senior','$tax_adt','$tax_chd','$tax_inf','$tax_snr','')";
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                   <tr>  
                                        <td>' . $rute . '</td> 
                                        <td>' . $type . '</td>
                                        <td>' . $kota . '</td> 
                                        <td>' . $f_name . '</td>
                                        <td>' . $adult . '</td>
                                        <td>' . $child . '</td>
                                        <td>' . $infant . '</td>
                                   </tr>  
                                   ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql2 = "UPDATE  ferry_LT SET 
                                   nama='$rute',
                                   type='$type',
                                   dor='$dor',
                                   tgl='$tgl',
                                   negara='$negara',
                                   kota='$kota',
                                   ferry_name='$f_name',
                                   ferry_code='$f_code',
                                   ferry_agent='$f_agent',
                                   ferry_class='$f_class',
                                   dari='$from',
                                   ke='$to',
                                   jam_dept='$jam_dep',
                                   jam_arr='$jam_arr',
                                   kurs='$kurs',
                                   adult='$adult',
                                   child='$child',
                                   infant='$infant',
                                   senior='$senior',
                                   tax_adt='$tax_adt',
                                   tax_chd='$tax_chd',
                                   tax_inf='$tax_inf',
                                   tax_snr='$tax_snr' where id=".$row_update['id'];
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql2)) {
                                        $output .= '  
                                   <tr>  
                                   <td>' . $rute . '</td> 
                                   <td>' . $type . '</td>
                                   <td>' . $kota . '</td> 
                                   <td>' . $f_name . '</td>
                                   <td>' . $adult . '</td>
                                   <td>' . $child . '</td>
                                   <td>' . $infant . '</td>
                                   </tr>  
                                   ';
                                        $update++;
                                   } else {
                                        $gagal_update++;
                                   }
                              }
                         }
                    }
                    $halaman++;
               }
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          $output .= "</br><label class='text-success'>Data berhasil update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal update : " . $gagal_update . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
