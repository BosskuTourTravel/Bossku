<?php
include "../site.php";
include "../db=connection.php"; 

session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>LIST LEMBUR STAFF </h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='newTab()' class='btn btn-default'><i class='fa fa-print'></i></button>
                      <button type='submit' onclick='insertPage(16,0,0)' class='btn btn-success'>iN</button>
                      <button type='submit' onclick='insertPage(20,0,0)' class='btn btn-danger'>OUT</button>
                      <button type='submit' onclick='reloadsallary(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
 

                $query = "SELECT * FROM lembur where staff='".$_SESSION['staff_id']."' ORDER BY tgl DESC";
                $rs=mysqli_query($con,$query);
                

                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>TANGGAL</th>
                <th>NAMA</th>
                <th>LOKASI</th>
                <th>JAM KERJA</th>
                <th>TELAT</th>
                <th>LEBIH AWAL</th>
                <th>OVER TIME</th>
                <th>LEMBUR</th>
                <th>option</th>
                </tr>
                </thead>
                <tbody>";
                while($row = mysqli_fetch_array($rs)){
                  $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
                  $rsstaff=mysqli_query($con,$querystaff);
                  $rowstaff = mysqli_fetch_array($rsstaff);
                  $telat= $row['telat'];
                    $jamtl    =floor($telat);
                    $menittl  =$telat - $jamtl ;
                    $gtl=$jamtl."h".floor( $menittl * 60)."m";
                  $rajin= $row['rajin'];
                  $jamrj    =floor($rajin);
                  $menitrj  =$rajin - $jamrj ;
                  $grj=$jamrj."h".floor( $menitrj * 60)."m";
                  $jam    =floor($row['durasi']);
                  $menit   =$row['durasi'] - $jam ;
                  $dur=$jam."h".floor( $menit * 60)."m";
                  $jamover    =floor($row['over']);
                  $menitover   =$row['over'] - $jamover ;
                  $durover=$jamover."h".floor( $menitover * 60)."m";

                echo"
                <tr style='font-weight:bold;'>
                <td>".$row['tgl']."</td>
                <td>".$rowstaff['name']."</td>
                <td>".$row['place']."</td>
                <td>".$row['mulai']."-".$row['end']." : ".$dur."</td>
                <td>".$gtl."</td>
                <td>".$grj."</td>
                <td>".$durover."</td>
                <td>Rp".number_format($row['total'], 0, ".", ".")."</td>
                <td>
                <button type='submit' onclick='dellembur(".$row['id_lembur'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                </tr>
                <tr>";      
  
                }

                echo "
                </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>
function newTab(url){
    var x = window.open('http://www.2canholiday.com/Admin/printabsen.php','_blank');
    x.focus();
}

  function dellembur(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"dellembur.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadsallary(4,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>
