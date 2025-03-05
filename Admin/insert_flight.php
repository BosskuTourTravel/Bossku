<?php
//export.php  

if (!empty($_FILES["excel_flight"])) {
 
     include "../site.php";
     include "../db=connection.php";
     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_flight"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>TYPE</th> 
                          <th>TOUR NAME</th>
                          <th>NAMA RUTE</th> 
                          <th>ADULT</th>
                          <th>CHILD</th>
                          <th>INFANT</th>
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_flight"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $update = 0;
          $gagal_update = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('Sheet1');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $tc = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $tn = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $rute = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $int = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $maskapai = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $dept = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $arr = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                         $tgl = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         $take = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         $landing = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                         $adt = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                         $chd = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                         $inf = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                         $bagasi=mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                         $bagasi_price=mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                         $seat_price=mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
                         $fl_b=mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                         $fl_l=mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                         $fl_d=mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(19, $row)->getValue());
                         $tax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(20, $row)->getValue());
                         if ($type != '' && $maskapai !='') {
                              // var_dump($tc);
                              $query_update = "SELECT * FROM flight_LTnew where type ='".$type."' and maskapai ='".$maskapai."' and rute ='".$rute."'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                         
                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO flight_LTnew VALUES ('','$type','$tc','$tn','$rute','$int','$maskapai','$dept','$arr','".$tgl."','".$take."','".$landing."','$adt','$chd','$inf','$bagasi','$bagasi_price','$seat_price','$fl_b','$fl_l','$fl_d','$tax')";
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                   <tr>  
                                        <td>' . $type . '</td> 
                                        <td>' . $tn . '</td>
                                        <td>' . $rute . '</td> 
                                        <td>' . $adt . '</td>
                                        <td>' . $chd . '</td>
                                        <td>' . $inf . '</td>
                                   </tr>  
                                   ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql = "UPDATE  flight_LTnew SET type='$type', tour_code='$tc',tour_name='$tn',rute='$rute',inter='$int',maskapai='$maskapai',dept='$dept',arr='$arr',tgl='".$tgl."',take='".$take."',landing='".$landing."', adt='$adt',chd='$chd',inf='$inf',bagasi='$bagasi',bagasi_price='$bagasi_price',seat_price='$seat_price',bf='$fl_b',ln='$fl_l',dn='$fl_d',tax='$tax' where  id=".$row_update['id'];
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                   <tr>  
                                        <td>' . $type . '</td> 
                                        <td>' . $tn . '</td>
                                        <td>' . $rute . '</td> 
                                        <td>' . $adt . '</td>
                                        <td>' . $chd . '</td>
                                        <td>' . $inf . '</td>
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
          $output .= "</br><label class='text-success'>Data update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data update gagal : " . $gagal_update . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
