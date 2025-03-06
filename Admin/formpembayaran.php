<?php
include "../site.php";
include "../db=connection.php";
$bulan = array(
    '01' => 'JANUARI',
    '02' => 'FEBRUARI',
    '03' => 'MARET',
    '04' => 'APRIL',
    '05' => 'MEI',
    '06' => 'JUNI',
    '07' => 'JULI',
    '08' => 'AGUSTUS',
    '09' => 'SEPTEMBER',
    '10' => 'OKTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DESEMBER',
  );

$queryg = "SELECT * FROM login_staff";
$rsg=mysqli_query($con,$queryg);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM PEMBAYARAN</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='insertPage(22,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>
              <div class='card card-primary'>";
                    echo"
                    <div class='container'>
                    <form>
                    <div class='form-row'>
                    <div class='col'>
                    <label for='bayar'>Nama Staff</label>
                    <select class='custom-select my-1 mr-sm-2' id='staff' name='staff'>
                    <option selected>Pilih Staff...</option>";
                    while($rowg = mysqli_fetch_array($rsg)){
                    echo"<option value='".$rowg['id']."'>".$rowg['name']."</option>";
                    }
                
                  echo"</select>
                    </div>
                    <div class='col'>
                    <label for='bayar'>Gaji Bulan</label>
                    <select class='custom-select my-1 mr-sm-2' id='bln' name='bln'>
                    <option value='1'>January</option>
                    <option value='2'>Febuary</option>
                    <option value='3'>Maret</option>
                    <option value='4'>April</option>
                    <option value='5'>Mei</option>
                    <option value='6'>Juni</option>
                    <option value='7'>Juli</option>
                    <option value='8'>Agustus</option>
                    <option value='9'>September</option>
                    <option value='10'>Oktober</option>
                    <option value='11'>November</option>
                    <option value='12'>Desember</option>
                  </select>
                    </div>
                    <div class='col'>
                    <label for='bayar'>Tahun</label>
                    <select class='custom-select my-1 mr-sm-2' id='thn' name='thn'>
                    <option value='2020'>2020</option>
                    <option value='2021'>2021</option>
                    <option value='2022'>2022</option>
                    <option value='2023'>2023</option>
                    </select>
                    </div>
                  </div>
                    <div class='form-group'>
                        <label for='bayar'>Jumlah dibayarkan</label>
                        <input type='text' class='form-control' id='bayar' name='bayar' placeholder='Masukkan Nominal yang akan dibayarkan'>
                    </div>
                    <div class='form-group'>
                    <label for='tgl'>Jenis Pembayaran</label>
                    <select class='custom-select my-1 mr-sm-2' id='jp' name='jp'>
                    <option value='cash'>Cash</option>
                    <option value='transfer'>Transfer</option>
                  </select>
                </div>
                    <button type='button' class='btn btn-primary' onclick='insert()'>Submit</button>
                    </form>
                    </div></br>";
                echo "
                <div class=form-group' name='divtb' id='divtb'>
                <table class='table' style='font-size:12px;'>
                <thead>
                <tr>
                <th scope='col'>TGL</th>
                <th scope='col'>NAMA STAFF</th>
                <th scope='col'>GAJI BULAN</th>
                <th scope='col'>JENIS PEMBAYARAN</th>
                <th scope='col'>TOTAL HOURS</th>
                <th scope='col'>DIBAYARKAN</th>
                <th scope='col'>OPTION</th>
                <th>     
                </th>
                </tr>
                </thead>
                <tbody>";
                $queryp= "SELECT * FROM pembayaran";
                $rsp=mysqli_query($con,$queryp);
                while($rowpembayaran= mysqli_fetch_array($rsp)){
                    $bln=$rowpembayaran['bln'];
                    echo"
                          <tr style='font-weight:bold;'>
                          <td>".$rowpembayaran['tgl']."</td>";
                          $querystaff= "SELECT * FROM login_staff where id=".$rowpembayaran['staff'];
                          $rsstaff=mysqli_query($con,$querystaff);
                          $rowstaff=mysqli_fetch_array($rsstaff);
                          echo"
                          <td>".$rowstaff['name']."</td>
                          <td>".$bulan[$bln]." &nbsp; ".$rowpembayaran['thn']."</td>
                          <td>".$rowpembayaran['jenis']."</td>
                          <td>".$rowpembayaran['hours']."&nbsp h</td>
                          <td> Rp".number_format($rowpembayaran['nominal'], 0, ".", ".")."</td>
                          <td><button type='submit' onclick='del(".$rowpembayaran['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                    </tr>"; 
                }              
                echo"
                </tbody>
                </table>
            </div>
            </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              </tbody>
            </table>
            </div>
            </div>

              </div>
            </div>
          </div>
        </div>
        </div>";
?>

<script>
 $(document).ready(function(){
});
function insert(){
    var a =  document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
    var b =  document.getElementById("bln").options[document.getElementById("bln").selectedIndex].value;
    var d =  document.getElementById("thn").options[document.getElementById("thn").selectedIndex].value;
    var c =  document.getElementById("jp").options[document.getElementById("jp").selectedIndex].value;
    var g =  $("input[name=bayar]").val();

    $.ajax({
        url:"InsertPembayaran.php",
        method: "POST",
        asynch: false,
        data:{staff:a,bln:b,jp:c,bayar:g,thn:d},
        success:function(data){
          $('#divtb').html(data);
          insertPage(23,0,0);

        }
      });
    
  }

  function del(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delbayar.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            insertPage(23,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }

</script>
