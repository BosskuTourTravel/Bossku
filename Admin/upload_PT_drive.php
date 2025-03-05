<?php
//export.php  

if (!empty($_FILES["excel_drive"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";
     $date = date("Y-m-d");

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_drive"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>id</th> 
                          <th>Continent</th>
                          <th>Country</th> 
                          <th>City</th>
                          <th>Nama</th>
                          <th>kurs</th>
                          <th>pax</th>
                          <th>price</th>
                          <th>Thumnail</th>
                          <th>Gambar</th>
                          <th>Itin</th>
                          <th>Ig</th>
                          <th>Tiktok</th>
                          <th>Youtube</th>
                          <th>Lebaran</th>
                          <th>New Year</th>
                          <th>School</th>
                          <th>Low Season</th>
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_drive"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $update = 0;
          $double = 0;
          $gagal_update = 0;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               for ($row = 3; $row <= $highestRow; $row++) {

                    $id = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $continent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $city = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $nama = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    $pax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    $price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    $thumnail = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                    $gambar = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                    $itin = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                    $ig = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                    $tiktok = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                    $youtube = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                    $lebaran = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                    $newyear = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                    $school = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
                    $ls = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                    $cons = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                    $start_from = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(19, $row)->getValue());
                    $agent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(20, $row)->getValue());
                    $ket = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(21, $row)->getValue());
                    $status = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(22, $row)->getValue());
                    // var_dump($id);
                    if ($continent != "" && $negara != "" && $city != "" && $nama != "") {

                         $query_update = "SELECT * FROM Upload_Drive where id=" . $id;
                         $rs_update = mysqli_query($con, $query_update);
                         $row_update = mysqli_fetch_array($rs_update);
                         // var_dump($query_update);

                         if ($row_update['id'] == "") {

                              $query_per = "SELECT * FROM Upload_Drive2 where continent='" . $continent . "' && country='" . $negara . "' && city='" . $city . "' && judul='" . $nama . "' && kurs='" . $kurs . "' && pax='" . $pax . "' && price='" . $price . "' && start_from='".$start_from."' && agent='".$agent."'&& ket='".$ket."' && status='".$status."'";
                              $rs_per = mysqli_query($con, $query_per);
                              $row_per = mysqli_fetch_array($rs_per);
                              // var_dump($query_per);

                              if ($row_per['id'] == "") {
                                   $sql = "INSERT INTO Upload_Drive2 VALUES ('','" . $date . "','".$gambar."','".$thumnail."','".$itin."','".$continent."','".$negara."','".$city."','".$nama."','".$ig."','".$tiktok."','".$youtube."','".$price."','".$kurs."','".$pax."','".$lebaran."','".$ls."','".$newyear."','".$school."','".$cons."','".$start_from."','".$agent."','".$ket."','".$status."')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                        <td></td>
                                             <td>' . $continent . '</td> 
                                             <td>' . $negara . '</td>
                                             <td>' . $city . '</td> 
                                             <td>' . $nama . '</td>
                                             <td>' . $kurs . '</td>
                                             <td>' . $pax . '</td>
                                             <td>' . $price . '</td>
                                             <td>' . $thumnail . '</td>
                                             <td>' . $gambar . '</td>
                                             <td>' . $itin . '</td>
                                             <td>' . $ig . '</td>
                                             <td>' . $tiktok . '</td>
                                             <td>' . $youtube . '</td>
                                             <td>' . $lebaran . '</td>
                                             <td>' . $newyear . '</td>
                                             <td>' . $school . '</td>
                                             <td>' . $ls . '</td>
                                             <td>' . $cons . '</td>
                                             <td>' . $start_from . '</td>
                                             <td>' . $agent . '</td>
                                             <td>' . $ket . '</td>
                                             <td>' . $status . '</td>
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $double++;
                              }
                         } else {
                              $sql2 = "UPDATE Upload_Drive2 SET continent='" . $continent . "', country='" . $negara . "', city='" . $city . "',judul='" . $nama . "',kurs='" . $kurs . "', pax='" . $pax . "', price='" . $price . "' , thumbnail='" . $thumnail . "', name='" . $gambar . "',documents='" . $itin . "',ig='$ig',tiktok='$tiktok',youtube='" . $youtube . "',p_lebaran='$lebaran',p_ny='$newyear',p_sh='$school',p_ls='$ls',p_cons='$cons',start_from='$start_from',agent='".$agent."',ket='".$ket."',status='".$status."'  WHERE id=" . $row_update['id'];
                              // var_dump($sql2);
                              if (mysqli_query($con, $sql2)) {
                                   $output .= '  
                                   <tr>  
                                   <td>' . $continent . '</td> 
                                   <td>' . $negara . '</td>
                                   <td>' . $city . '</td> 
                                   <td>' . $nama . '</td>
                                   <td>' . $kurs . '</td>
                                   <td>' . $pax . '</td>
                                   <td>' . $price . '</td>
                                   <td>' . $thumnail . '</td>
                                   <td>' . $gambar . '</td>
                                   <td>' . $itin . '</td>
                                   <td>' . $ig . '</td>
                                   <td>' . $tiktok . '</td>
                                   <td>' . $youtube . '</td>
                                   <td>' . $lebaran . '</td>
                                   <td>' . $newyear . '</td>
                                   <td>' . $school . '</td>
                                   <td>' . $ls . '</td>
                                   <td>' . $cons . '</td>
                                   <td>' . $start_from . '</td>
                                   </tr>  
                                   ';
                                   $update++;
                              } else {
                                   $gagal_update++;
                              }
                         }
                    }
               }
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          $output .= "</br><label class='text-success'>Data update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal update : " . $gagal_update . "</label>  ";
          $output .= "</br><label class='text-warning'>Data Double : " . $double . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
