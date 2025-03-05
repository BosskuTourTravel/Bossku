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
                          <th>Day</th>  
                          <th>POC</th>  
                          <th>Arrival</th>  
                          <th>Depature</th>
                          <th>Activity</th> 
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               for ($row = 2; $row <= $highestRow; $row++) {
                    $day = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $poc = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $arrival = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $depature = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $activity = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
               

                     $sql = "INSERT INTO cruise_activity VALUES ('','$pack_id','$day','$poc','$arrival','$depature','$activity')";
                    // $sql = "INSERT into cruise_activityi values('','$nama','$alamat','$telepon')";
                    if (mysqli_query($con, $sql)) {
                         $output .= '  
                         <tr>  
                              <td>' . $pack_id . '</td>  
                              <td>' . $day . '</td>  
                              <td>' . $poc . '</td>  
                              <td>' . $arrival . '</td>  
                               <td>' . $depature . '</td> 
                               <td>' . $activity . '</td> 
                         </tr>  
                         ';
                         $berhasil++;
                    } else {
                         $gagal++;
                    }
               }
          }
          $output .= '</table>';
          $output .="<label class='text-success'>Data berhasil : ".$berhasil."</label>  ";
          $output .="</br><label class='text-danger'>Data gagal : ".$gagal."</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
