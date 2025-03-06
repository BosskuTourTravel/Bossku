<?php
//export.php  

if (!empty($_FILES["excel_visa"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_visa"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Kota </th> 
                          <th>Kota Embessy</th> 
                          <th>Visa </th> 
                          <th>Jenis</th>
                          <th>Tipe </th> 
                          <th>Durasi</th>
                          <th>Embessy Price </th> 
                          <th>Agent Price</th>
                          <th>Sell Price </th> 
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_visa"]["tmp_name"]);
          $berhasil = 0;
          $update = 0;
          $gagal_update = 0;
          $gagal = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $kota = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $kota_emb = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $visa = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $jenis = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $tipe = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $durasi = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $emb_price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                         $agent_price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         $sell_price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                         $alamat = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                         $tlpn = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                         $status = "0";
                         $date = date("Y-m-d");




                         if ($kota != '' or $kota_emb != '' or $visa != '' or $jenis != '' or $tipe != '') {
                              $query_update = "SELECT * FROM Visa2 where kota like'%" . $kota . "%' AND kota_embessy like '%".$kota_emb."%' AND visa like '%".$visa."%' AND jenis='".$jenis."' AND tipe='".$tipe."'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                              if ($row_update['id'] == "") {

                                   $sql = "INSERT INTO Visa2 VALUES ('','$date','$kota','$kota_emb','$visa','$jenis','$tipe','$durasi','$emb_price','$agent_price','$sell_price','$alamat','$tlpn','$status')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $kota . '</td> 
                                             <td>' . $kota_emb . '</td>
                                             <td>' . $visa . '</td> 
                                             <td>' . $jenis . '</td>
                                             <td>' . $tipe . '</td> 
                                             <td>' . $durasi . '</td>
                                             <td>' . $emb_price . '</td>
                                             <td>' . $agent_price . '</td>
                                             <td>' . $sell_price . '</td>

                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql2 = "UPDATE Visa2 SET kota='".$kota."', kota_embessy='".$kota_emb."', visa='".$visa."',jenis='".$jenis."', tipe='".$tipe."', durasi='".$durasi."',embassy_price='$emb_price', agent_price='$agent_price', sell_price='$sell_price',alamat='".$alamat."', tlpn='".$tlpn."',status='1'  where id =".$row_update['id'];
                                   if (mysqli_query($con, $sql2)) {
                                        $output .= '  
                                        <tr>  
                                        <td>' . $kota . '</td> 
                                        <td>' . $kota_emb . '</td>
                                        <td>' . $visa . '</td> 
                                        <td>' . $jenis . '</td>
                                        <td>' . $tipe . '</td> 
                                        <td>' . $durasi . '</td>
                                        <td>' . $emb_price . '</td>
                                        <td>' . $agent_price . '</td>
                                        <td>' . $sell_price . '</td>
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
          $output .= "</br><label class='text-success'>Data Update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal update : " . $gagal_update . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
