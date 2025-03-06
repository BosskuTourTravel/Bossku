<?php
//export.php  

if (!empty($_FILES["excel_file"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../db=connection.php";
     $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_file"]["name"]);
     if ($file_array[1] == "xls") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr>  
                         <th>Pack ID</th>  
                         <th>Start Day</th>  
                         <th>End Day</th>
                         <th>Category</th>
                         <th>Currency</th>
                         <th>Price</th>
                         <th>Port of Chargers</th>
                         <th>Depature Tax</th>
                         <th>Tipping</th>
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               for ($row = 2; $row <= $highestRow; $row++) {
                    $start_day = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $end_day = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $category = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $currency = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $poc = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    $dep_tax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    $tipping = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    // $day = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    // $inside = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    // $inside_vir_bal = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    // $inside_pro_view = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    // $inside_cen_park = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    // $window_oc_view = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    // $balcony_cen = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    // $balcony_board = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    // $balcony_oc = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                    // $port_charges = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                    // $depature = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                    // $tax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());


                    $sql = "INSERT INTO cruise_package_new VALUES ('','$pack_id','$start_day','$end_day','$category','$currency','$price','$poc','$dep_tax','$tipping')";
                    // $sql = "INSERT INTO cruise_package VALUES ('','$pack_id','$day','$inside','$inside_vir_bal','$inside_pro_view','$inside_cen_park','$window_oc_view','$balcony_cen','$balcony_board','$balcony_oc','$port_charges','$depature','$tax')";
                    // $sql = "INSERT into cruise_activityi values('','$nama','$alamat','$telepon')";
                    if (mysqli_query($con, $sql)) {
                         $output .= '  
                         <tr>  
                              <td>' . $pack_id . '</td>  
                              <td>' . $start_day . '</td>  
                              <td>' . $end_day . '</td>  
                              <td>' . $category . '</td>  
                              <td>' . $currency . '</td>  
                              <td>' . $price . '</td> 
                              <td>' . $poc . '</td> 
                              <td>' . $dep_tax . '</td> 
                              <td>' . $tipping . '</td> 
                         </tr>  
                         ';
                         $berhasil++;
                    } else {
                         $gagal++;
                    }
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
