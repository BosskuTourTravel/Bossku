<?php
//export.php  

if (!empty($_FILES["excel_menu"])) {
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_menu"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>ID</th> 
                          <th>Menu</th> 
                          <th>Sub Menu</th>
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_menu"]["tmp_name"]);
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
                         $id = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $menu = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());

                         if ($menu != '') {
                              $query_update = "SELECT * FROM Master_menu where id='" . $id . "'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                              if ($row_update['id'] == "") {

                                   $sql = "INSERT INTO Master_menu VALUES ($id,'$menu')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $id . '</td> 
                                             <td>' . $menu . '</td>
                                             <td></td>
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql2 = "UPDATE Master_menu SET menu='" . $menu . "' where id =" . $row_update['id'];
                                   if (mysqli_query($con, $sql2)) {
                                        $output .= '  
                                        <tr>  
                                        <td>' . $id . '</td> 
                                        <td>' . $menu . '</td>
                                        <td></td>
                                        </tr>  
                                        ';
                                        $update++;
                                   } else {
                                        $gagal_update++;
                                   }
                              }
                         }
                    }
               } else if ($halaman == 2) {
                    for ($row2 = 2; $row2 <= $highestRow; $row2++) {
                         $id2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row2)->getValue());
                         $menu2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row2)->getValue());
                         $sub_menu = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row2)->getValue());
                         if ($menu != '' && $sub_menu != '') {
                              $query_update2 = "SELECT * FROM Master_menu_sub where id='" . $id2 . "'";
                              $rs_update2 = mysqli_query($con, $query_update2);
                              $row_update2 = mysqli_fetch_array($rs_update2);

                              if ($row_update2['id'] == "") {
                                   $sql3 = "INSERT INTO Mater_menu_sub VALUES ('$id2','$menu2','$sub_menu')";
                                   // var_dump($sql3);
                                   if (mysqli_query($con, $sql3)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $id2 . '</td> 
                                             <td>' . $menu2 . '</td>
                                             <td>' . $sub_menu . '</td>
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql4 = "UPDATE Mater_menu_sub SET menu_sub='" . $sub_menu . "' where id =" . $row_update2['id'];
                                   if (mysqli_query($con, $sql4)) {
                                        $output .= '  
                                        <tr>  
                                        <td>' . $id2 . '</td> 
                                        <td>' . $menu2 . '</td>
                                        <td>' . $sub_menu . '</td>
                                        </tr>  
                                        ';
                                        $update++;
                                   } else {
                                        $gagal_update++;
                                   }
                              }
                         }
                    }
               } else {
               }
               $halaman++;
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
