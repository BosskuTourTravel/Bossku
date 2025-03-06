<?php
//export.php  

if (!empty($_FILES["excel_gmeal"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_gmeal"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Negara</th> 
                          <th>Kode</th>
                          <th>Type</th> 
                          <th>Nama</th>
                          <th>Deskripsi</th>
                          <th>Kurs</th>
                          <th>Harga</th>     
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_gmeal"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $kode = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $nama = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $deskripsi = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $harga = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         if ($nama != "") {
                              $query_update = "SELECT * FROM Guide_Meal where negara like'$negara' and nama like '$nama' and harga like '$harga'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                              var_dump( $query_update);

                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO Guide_Meal VALUES ('','$negara','$kode','$type','$nama','$deskripsi','$kurs','$harga')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $negara . '</td> 
                                             <td>' . $kode . '</td>
                                             <td>' . $type . '</td> 
                                             <td>' . $nama . '</td>
                                             <td>' . $deskripsi . '</td>
                                             <td>' . $kurs . '</td>
                                             <td>' . $harga . '</td>
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {

                                        $gagal++;
                                   }
                              } else {
                                   $sql = "UPDATE  Guide_Meal SET negara='$negara',kode='$kode',type='$type',nama='$nama',deskripsi='$deskripsi',kurs='$kurs',harga='$harga'  where id='" . $row_update['id'] . "'";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $negara . '</td> 
                                             <td>' . $kode . '</td>
                                             <td>' . $type . '</td> 
                                             <td>' . $nama . '</td>
                                             <td>' . $deskripsi . '</td>
                                             <td>' . $kurs . '</td>
                                             <td>' . $harga . '</td>
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
