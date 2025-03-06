<?php
session_start();
include "../site.php";
include "../db=connection.php";

$query_tq = "SELECT DISTINCT  tour_pack FROM transquo";
$rs_tq=mysqli_query($con,$query_tq);
echo "<div class='content-wrapper'>
 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Transquo Package</h3>
                <div class='card-tools'>
                </form>
                  <div class='input-group input-group-sm'>
                      <select class='form-control' name='tq' id='tq' style='width:5%;'>
                         <option value=''>Pilih Itinerary</option>";
                              while($row_tq= mysqli_fetch_array($rs_tq)){
                                $query_tq2 = "SELECT * FROM tour_package where id=".$row_tq['tour_pack'];
                                $rs_tq2=mysqli_query($con,$query_tq2);
                                $row_tq2 = mysqli_fetch_array($rs_tq2);
                                       echo "<option value='".$row_tq2['id']."'>".$row_tq2['tour_name']."</option>";
                                  }
                        echo"</select>
                    
                    <div class='input-group-append'>
                    <button type='button' class='btn btn-default' onclick='search()'><i class='fas fa-search'></i></button>
                      </form>
                      <button type='button' onclick='reloadTransport(3,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            


                $query = "SELECT * FROM transquo order by id ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>No</th>
                <th>Itenerary</th>
                <th>Groub Name</th>
                <th>Durasi</th>
                <th>pax</th>
                <th>Kurs</th>
                <th>Cost / pax</th>
                <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>";
                  $no=1;
                while($row = mysqli_fetch_array($rs)){
                  $query_tour = "SELECT * FROM tour_package where id=".$row['tour_pack'];
                  $rs_tour=mysqli_query($con,$query_tour);
                  $row_tour = mysqli_fetch_array($rs_tour);
                  $total=$row['total']/$row['pax'];
                  $kurs=$row['kurs'];

                  $querykurs_tour= "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
                  $rs_kurs_tour=mysqli_query($con,$querykurs_tour);
                  $row_kurs_tour = mysqli_fetch_array($rs_kurs_tour);
                  $kurs2=$row_kurs_tour['name'];


                  $querykonv = "SELECT * FROM kurs_live WHERE name LIKE '$kurs2%'";
                  $rskonv=mysqli_query($con,$querykonv);
                  $rowkonv= mysqli_fetch_array($rskonv);
                  $kurs_konv=$rowkonv['jual'];
                  if($kurs==0){
                    $kurs2="IDR";
                    $harga=$total;
                  }else{
                    $kurs2=$row_kurs_tour['name'];
                    $harga= $total/$kurs_konv;
                  }
                  $harga2=round($harga,0);

                    echo"
                    <tr style='font-weight:bold;'>
                    <td>".$no."</td>
                    <td>".$row_tour['tour_name']."</td>
                    <td>".$row['grub']."</br>".$row['tlp']."</td>
                    <td>".$row['durasi']."</td>
                    <td>".$row['pax']."</td>
                    <td>".$kurs2."</td>
                    <td><b>".number_format($harga2, 0, ".", ".")."</b></td>
                    <td>".$row['ket']."</td>
                    <td>
                    
                    <button type='submit' onclick='del_transquo(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>
                    <button type='submit' onclick='edit_transquo(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-primary'><i class='fa fa-edit' aria-hidden='true'></i></button>
                    <button type='button'  class='btn btn-success' data-toggle='modal' data-target='#exampleModal' data-id=".$row['id']."><i class='fa  fa-th-list' aria-hidden='true''></i></button></td>
                    </tr>
                    <tr>";

                $no++;
                }

                echo "
                </tbody>
                </table>

                <!-- Modal -->
                <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='width:75%;'>
                  <div class='modal-dialog modal-xl' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Detail</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        <div class='fetched-data'></div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!--- End Modal ----!>




              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <div name='tb' id='tb'></div>
</div>";
?>

<script>
  function del_transquo(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"del_transquo.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            insertPage(24,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
  function search(){
    var a = document.getElementById("tq").options[document.getElementById("tq").selectedIndex].value;
  //  alert("ssss");
    $.ajax({
      url:"detail_all.php",
        method: "POST",
        asynch: false,
        data:{tq:a},
        success:function(data){
        $('#tb').html(data);
        }
      });
  }

  function edit_transquo(x,y){
     $.ajax({
        url:"edit_transquo.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
        console.log(data)
        $("#divReloadPage").html(data);
        }
      });
  }
  $(document).ready(function(){
        $('#exampleModal').on('show.bs.modal', function (e) {
          var x = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
           // alert(x);
            $.ajax({
                type : 'post',
                url : 'detail.php',
                data :  {id:x},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
</script>

