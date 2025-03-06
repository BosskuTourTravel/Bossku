<?php
//export.php  

if (!empty($_FILES["excel_rute"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_rute"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Judul</th> 
                          <th>BF</th>  
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_rute"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $judul = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $bf = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         if ($judul != '') {
                              $query_update = "SELECT * FROM rute_itin where judul like'" . $judul . "'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                              if ($row_update['id'] == "") {

                                   $sql = "INSERT INTO rute_itin VALUES ('','$judul','$bf')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $judul . '</td> 
                                             <td>' . $bf . '</td>
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql = "UPDATE rute_itin SET judul='$judul', bf='$bf' where id='" . $row_update['id'] . "'";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $judul . '</td> 
                                             <td>' . $bf . '</td>
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
