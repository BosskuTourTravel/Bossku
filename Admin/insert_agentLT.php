<?php
//export.php  
$date = date("Y-m-d");
if (!empty($_FILES["excel_agentLT"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_agentLT"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Kode</th> 
                          <th>Nama</th>
                          <th>Benua</th>  
                          <th>Negara</th>  

                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_agentLT"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $update = 0;
          $gagalupdate =0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $kode = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $nama =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $benua = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $status = "";
                         // $link = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         if ($kode != '' && $nama != '' && $benua != '' && $negara !='' ) {

                              $query_update = "SELECT * FROM agent_LT where kode ='" . $kode . "'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                              

                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO agent_LT VALUES ('','$date','$kode','$nama','$benua','$negara','$status')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $kode . '</td> 
                                             <td>' . $nama . '</td> 
                                             <td>' . $benua . '</td>
                                             <td>' . $negara . '</td> 
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql2 = "UPDATE agent_LT SET  nama='$nama',benua='$benua', negara='$negara' WHERE id='" . $row_update['id'] . "'";
                                   //  var_dump($sql2);
                                  
                                   if (mysqli_query($con, $sql2)) {
                                        $output .= '  
                                        <tr>  
                                        <td>' . $kode . '</td> 
                                        <td>' . $nama . '</td> 
                                        <td>' . $benua . '</td>
                                        <td>' . $negara . '</td> 
                                        </tr>  
                                        ';
                                        $update++;
                                   } else {
                                        $gagalupdate++;
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
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
