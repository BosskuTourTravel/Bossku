<?php
//export.php  

if (!empty($_FILES["excel_include"])) {
 
     include "../site.php";
     include "../db=connection.php";
     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_include"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>TOUR CODE</th> 
                          <th>TOUR NAME</th>
                          <th>KOMPOSISI</th> 
                          <th>ADULT</th>
                          <th>CHILD</th>
                          <th>INFANT</th>
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_include"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('Sheet1');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $tc = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $tn = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $komp = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $adt = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $chd = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $inf = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         if ($tc != '' && $tn !='' && $komp !='') {
                              // var_dump($tc);
                              $query_update = "SELECT * FROM include_itin where tour_code ='$tc' and tour_name like '$tn' and komposisi like '$komp'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                         
                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO include_itin VALUES ('','$tc','$tn','$komp','$adt','$chd','$inf','')";
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                   <tr>  
                                        <td>' . $tc . '</td> 
                                        <td>' . $tn . '</td>
                                        <td>' . $komp . '</td> 
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
                                   $sql = "UPDATE  include_itin SET tour_code='$tc',tour_name='$tn',komposisi='$komp',adt='$adt',cnb='$chd',inf='$inf'";
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                   <tr>  
                                        <td>' . $tc . '</td> 
                                        <td>' . $tn . '</td>
                                        <td>' . $rf . '</td> 
                                        <td>' . $adt . '</td>
                                        <td>' . $chd . '</td>
                                        <td>' . $inf . '</td>
                                   </tr>  
                                   ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
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
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
