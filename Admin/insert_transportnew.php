<?php
//export.php  

if (!empty($_FILES["excel_transport"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_transport"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered table-sm'>  
                     <tr> 
                          <th>Nama Agent</th> 
                          <th>Continent</th>
                          <th>Country</th> 
                          <th>City</th> 
                          <th>Periode</th> 
                          <th>Kurs</th>    
                          <th>Transport Type</th>
                          <th>Seat</th> 
                          <th>Rentype</th> 
                          <th>Harga</th>  
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_transport"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $agent_berhasil = 0;
          $agent_gagal = 0;
          $update_agent = 0;
          $gagal_update_agent = 0;
          $datasama = 0;
          $worksheet = $object->getSheetByName('agent');
          $worksheet2 = $object->getSheetByName('New_Transport');
          $halaman = 1;
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == '1') {
                    // agent
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $agent_code = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $nama = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $email = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $tlpn = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $fax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $car_phone = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $homepage = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $alamat = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                         $kota = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         $post_code = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         $state = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                         $tour_con = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                         $web = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                         $hp  = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                         $fax2  = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                         $pager = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
                         $company = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                         $job_tt = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                         $notes = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(19, $row)->getValue());
                         $category = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(20, $row)->getValue());

                         $query_agn = "SELECT * FROM  agent_transport where agent_code='" . $agent_code . "'";
                         $rs_agn = mysqli_query($con, $query_agn);
                         $row_agn = mysqli_fetch_array($rs_agn);
                         if ($row_agn['id'] == "") {

                              $sql3 = "INSERT INTO agent_transport VALUES ('','" . $nama . "','" . $agent_code . "','" . $email . "','" . $tlpn . "','" . $fax . "','" . $car_phone . "','" . $homepage . "','" . $alamat . "','" . $kota . "','" . $post_code . "','" . $state . "','" . $negara . "','" . $tour_con . "','" . $web . "','" . $hp . "','" . $fax2 . "','" . $pager . "','" . $company . "','" . $job_tt . "','" . $notes . "','" . $category . "')";
                              if (mysqli_query($con, $sql3)) {
                                   $agent_berhasil++;
                              } else {
                                   $agent_gagal++;
                              }
                         } else {
                              $sql4 = "UPDATE agent_transport SET
                              name ='" . $nama . "',
                              agent_code ='" . $agent_code . "',
                              email = '" . $email . "',
                              home_phone = '" . $tlpn . "',
                              home_fax = '" . $fax . "',
                              car_phone = '" . $car_phone . "';
                              home_webpage = '" . $homepage . "',
                              street = '" . $alamat . "',
                              city = '" . $kota . "',
                              zipcode= '" . $post_code . "',
                              state = '" . $state . "',
                              country = '" . $negara . "',
                              tour_country = '" . $tour_con . "',
                              website = '" . $web . "',
                              phone = '" . $hp . "',
                              fax = '" . $fax2 . "',
                              pager = '" . $pager . "',
                              company = '" . $company . "',
                              job_title = '" . $job_tt . "',
                              notes = '" . $notes . "',
                              category = '" . $category . "',
                              where id ='" . $row_agn['id'] . "'";
                              if (mysqli_query($con, $sql4)) {
                                   $update_agent++;
                              } else {
                                   $gagal_update_agent++;
                              }
                         }
                    }
                    // echo "========================"." </br>";

               } else if ($halaman == '2') {
                    // transport
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $agent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $continent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $country = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $city = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $periode = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $tr_type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $seat = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                         $durasi = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         $oneway = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         $twoway = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                         $hd1 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                         $hd2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                         $fd1 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                         $fd2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                         $kaisoda = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                         $luarkota = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
                         $remark = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                         $img = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                         // var_dump($agent);

                         // echo "$agent"." </br>";
                         if ($agent != "" && $seat != '') {

                              $query_agn2 = "SELECT * FROM  agent_transport where company like '" . $agent . "'";
                              $rs_agn2 = mysqli_query($con, $query_agn2);
                              $row_agn2 = mysqli_fetch_array($rs_agn2);

                              $query_tp = "SELECT * FROM  Transport_new where agent ='" . $row_agn2['id'] . "' AND  continent='$continent' and city='$city' and country='$country' and periode='$periode' and trans_type='$tr_type' and seat='$seat'";
                              $rs_tp = mysqli_query($con, $query_tp);
                              $row_tp = mysqli_fetch_array($rs_tp);



                              // var_dump($query_tp);

                              if($row_tp['id']==''){
                                   $sql = "INSERT INTO Transport_new VALUES ('','".$row_agn2['id']."','".$continent."','".$country."','".$city."','".$periode."','".$kurs."','".$tr_type."','".$seat."','".$durasi."','".$oneway."','$twoway','".$hd1."','".$hd2."','".$fd1."','".$fd2."','".$kaisoda."','".$luarkota."','".$remark."','".$img."')";
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $agent . '</td> 
                                             <td>' . $continent . '</td>
                                             <td>' . $country . '</td> 
                                             <td>' . $city . '</td>
                                             <td>' . $periode . '</td> 
                                             <td>' . $kurs . '</td>
                                             <td>' . $tr_type . '</td> 
                                             <td>' . $seat . '</td>
                                             <td>' . $oneway . '</td>
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              }else{

                                   $sql2 = "UPDATE  Transport_new SET 
                                   agent='".$agent."',
                                   continent='".$continent."',
                                   country='".$country."',
                                   city='".$city."',
                                   periode='".$periode."',
                                   kurs='".$kurs."',
                                   trans_type='".$tr_type."',
                                   seat='".$seat."',
                                   durasi='".$durasi."',
                                   oneway='".$oneway."',
                                   twoway='".$twoway."',
                                   hd1='".$hd1."',
                                   hd2='".$hd2."',
                                   fd1='".$fd1."',
                                   fd2='".$fd2."',
                                   kaisoda='".$kaisoda."',
                                   luarkota= '".$luarkota."',
                                   remarks= '".$remark."',
                                   img= '".$img."',
                                   where  id='" .$row_tp['id'] . "'";
                                   if (mysqli_query($con, $sql2)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $agent . '</td> 
                                             <td>' . $continent . '</td>
                                             <td>' . $country . '</td> 
                                             <td>' . $city . '</td>
                                             <td>' . $periode . '</td> 
                                             <td>' . $kurs . '</td>
                                             <td>' . $tr_type . '</td> 
                                             <td>' . $seat . '</td>
                                             <td>' . $oneway . '</td>
                                        </tr>  
                                        ';
                                        $datasama++;
                                   }else{
                                        $gagal++;
                                   }

                              }
                         }
                    }
               } else {
               }

               $halaman++;
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label></br> ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label> </br>";
          $output .= "<label class='text-success'>agent berhasil : " . $agent_berhasil . "</label></br> ";
          $output .= "</br><label class='text-danger'>agent gagal : " . $agent_gagal . "</label> </br>";
          $output .= "</br><label class='text-warning'>data Update : " . $datasama . "</label> </br>";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
