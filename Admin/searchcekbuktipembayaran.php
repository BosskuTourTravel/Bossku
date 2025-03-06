<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<script src="../assets/css/datatables.min.css"></script>
<script src="../assets/js/datatables.min.js"></script>

<style>
.tableFixHead          { overflow-y: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; }

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}

/* Just common table stuff. Really. */
th     { background:#ffff; }

</style>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

$grandtotalFinal = 0;

if($_POST['tipe']==1){
    $string = 'tanggal_transfer';
}else{
    $string = 'stamp';
}


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>CEK PEMBAYARAN</h3>
                <table class='table-striped table-bordered table-sm' style='margin-top:-1%;margin-left:1%;'>

                  	  <tr>
                  	  <td>
                    <input class='form-control' type='text' name='datefilter' id='datefilter' value='".$_POST['tanggal2']."' style='width:100%;height:2%;'/>
              
                    </td>
                     <td>
                    <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$_POST['tanggalx2']."' style='width:100%;height:2%;'/>
              
                    </td>
               		<td>
                    <button type='button' class='btn btn-primary' id='but_transfer' style='font-size:12px;width:100px;height:2%;'>Tanggal Transfer</button>
             		</td>
                 	<td>
                    <button type='button' class='btn btn-primary' id='but_upload' style='font-size:12px;width:100px;height:2%;'>Tanggal Upload</button>
                    </td>
                    </tr>
                    </table>";
                    
                  
                    echo "
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    

                      
                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";

              include "../site.php";
              include "../db=connection.php";
              $querybank2 = "SELECT * FROM bank";
              $rsbank2=mysqli_query($con,$querybank2);
              while($rowbank2 = mysqli_fetch_array($rsbank2)){
            
                $date = $_POST['tanggal'];
                $date2 = $_POST['tanggalx'];


                $querycek = "SELECT COUNT(*) as total FROM payment_detail WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_bank=".$rowbank2['id'];
                $rscek=mysqli_query($con,$querycek);
                $rowcek = mysqli_fetch_assoc($rscek);

                $querycek2 = "SELECT COUNT(*) as total FROM payment_detail_visapassport WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_type NOT LIKE 'Cash' AND payment_bank=".$rowbank2['id'];
                $rscek2=mysqli_query($con,$querycek2);
                $rowcek2 = mysqli_fetch_assoc($rscek2);

                $querycek4 = "SELECT COUNT(*) as total FROM payment_detail_flight WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_type NOT LIKE 'Cash' AND payment_bank=".$rowbank2['id'];
                $rscek4=mysqli_query($con,$querycek4);
                $rowcek4 = mysqli_fetch_assoc($rscek4);

                 $querycek5 = "SELECT COUNT(*) as total FROM payment_detail_hotel WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_type NOT LIKE 'Cash' AND payment_bank=".$rowbank2['id'];
                $rscek5=mysqli_query($con,$querycek5);
                $rowcek5 = mysqli_fetch_assoc($rscek5);
                // echo $querycek."</br>";
                //  echo $rowcek['total']." = ".$rowcek2['total']."</br>";
                //  echo $querycek2."</br>";

                if($rowcek['total']>0 OR $rowcek2['total']>0 OR $rowcek4['total']>0 OR $rowcek5['total']>0){
                	echo "<center><h3>BANK ".$rowbank2['short']." ( ".$rowbank2['nama']." )</h3></center>";
                	$query = "SELECT * FROM payment_detail WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_bank=".$rowbank2['id']." ORDER BY ".$string." ASC ";
                	$rs=mysqli_query($con,$query);

                	$query2 = "SELECT * FROM payment_detail_visapassport WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_bank=".$rowbank2['id']." ORDER BY ".$string." ASC ";
                	$rs2=mysqli_query($con,$query2);

                    $query4 = "SELECT * FROM payment_detail_flight WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_bank=".$rowbank2['id']." ORDER BY ".$string." ASC ";
                    $rs4=mysqli_query($con,$query4);

                    $query5 = "SELECT * FROM payment_detail_hotel WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' AND payment_bank=".$rowbank2['id']." ORDER BY ".$string." ASC ";
                    $rs5=mysqli_query($con,$query5);

                	$grandtotal = 0;
                	echo "<table id='dtBasicExample1' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                	<thead>
                	<tr>
                	<th width='8%'>Tanggal Transfer</th>
                	<th width='8%'>Tanggal Upload</th>
                	<th width='5%'>Invoice ID</th>
                	<th width='14%'>Nama Customer</th>

                	<th width='20%'>Jumlah</th>
                	<th width='30%'>Bank</th>
                	<th width='10%'>Jenis</th>
                	<th width='5%'>Diterima / Tidak</th>
                	</tr>
                	</thead>
                	<tbody id='myTable'>";
                	while($row=mysqli_fetch_array($rs)){

                		if($row['payment_type']!='Cash'){
                			echo "
                			<tr >";

                			$queryinvoice = "SELECT * FROM invoice WHERE id =".$row['invoice_id'];
                			$rsinvoice=mysqli_query($con,$queryinvoice);
                			$rowinvoice = mysqli_fetch_array($rsinvoice);

                			$querycustomer = "SELECT * FROM customer_list WHERE id =".$rowinvoice['customer_id'];
                			$rscustomer=mysqli_query($con,$querycustomer);
                			$rowcustomer = mysqli_fetch_array($rscustomer);

                			$querybank = "SELECT * FROM bank WHERE id =".$row['payment_bank'];
                			$rsbank=mysqli_query($con,$querybank);
                			$rowbank = mysqli_fetch_array($rsbank);
                			echo "<td>".$row['tanggal_transfer']."</td>";
                			echo "<td>".$row['stamp']."</td>";
                			echo "<td><button onclick='printPaymentDetail(".$row['invoice_id'].",0)'>".$row['invoice_id']."</button></td>";
                			echo "<td>".$rowcustomer['customer_name']."</td>";
                			echo "<td>Rp ".number_format($row['payment_price'], 0, ".", ".")."</td>";
                			echo "<td>".$rowbank['short']." ( ".$rowbank['nama']." )</td>";
                			echo "<td>Land Tour</td>";
                			if($_SESSION['type']==1 OR $_SESSION['type']==2){
                                if($row['status_cek']==0){
                				    echo "<td><input type='checkbox' onclick='updateCek(".$row['id'].",0)' name='pilihan".$row['id']."' value='".$row['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                			}else{
                                if($row['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row['id'].",0)' name='pilihan".$row['id']."' value='".$row['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                			}

                			echo "</tr>";

                			$grandtotal = $grandtotal + $row['payment_price'];
                		}

                	}


                    //visa
                	while($row2=mysqli_fetch_array($rs2)){
                		if($row2['payment_type']!='Cash'){
                			echo "
                			<tr >";

                			$queryinvoice = "SELECT * FROM invoiceVisaPassport WHERE id =".$row2['invoice_id'];
                			$rsinvoice=mysqli_query($con,$queryinvoice);
                			$row2invoice = mysqli_fetch_array($rsinvoice);

                			$querycustomer = "SELECT * FROM customer_list WHERE id =".$row2invoice['customer_id'];
                			$rscustomer=mysqli_query($con,$querycustomer);
                			$row2customer = mysqli_fetch_array($rscustomer);

                			$querybank = "SELECT * FROM bank WHERE id =".$row2['payment_bank'];
                			$rsbank=mysqli_query($con,$querybank);
                			$row2bank = mysqli_fetch_array($rsbank);
                			echo "<td>".$row2['tanggal_transfer']."</td>";
                			echo "<td>".$row2['stamp']."</td>";
                			echo "<td><button onclick='printPaymentDetail(".$row2['invoice_id'].",1)'>".$row2['invoice_id']."</button></td>";
                			echo "<td>".$row2customer['customer_name']."</td>";
                			echo "<td>Rp ".number_format($row2['payment_price'], 0, ".", ".")."</td>";
                			echo "<td>".$row2bank['short']." ( ".$row2bank['nama']." )</td>";
                			echo "<td>Visa Passport</td>";
                			if($_SESSION['type']==1 OR $_SESSION['type']==2){
                               if($row2['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row2['id'].",1)' name='pilihan".$row2['id']."' value='".$row2['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                			}else{
                                if($row2['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row2['id'].",1)' name='pilihan".$row2['id']."' value='".$row2['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                			}

                			echo "</tr>";

                			$grandtotal = $grandtotal + $row2['payment_price'];
                		}

                	}

                    //flight
                    while($row4=mysqli_fetch_array($rs4)){
                        if($row4['payment_type']!='Cash'){
                            echo "
                            <tr >";

                            $queryinvoice = "SELECT * FROM invoiceFlight WHERE id =".$row4['invoice_id'];
                            $rsinvoice=mysqli_query($con,$queryinvoice);
                            $row4invoice = mysqli_fetch_array($rsinvoice);

                            $querycustomer = "SELECT * FROM customer_list WHERE id =".$row4invoice['customer_id'];
                            $rscustomer=mysqli_query($con,$querycustomer);
                            $row4customer = mysqli_fetch_array($rscustomer);

                            $querybank = "SELECT * FROM bank WHERE id =".$row4['payment_bank'];
                            $rsbank=mysqli_query($con,$querybank);
                            $row4bank = mysqli_fetch_array($rsbank);
                            $tempCount = $row4['invoice_id'] + 30000;
                            echo "<td>".$row4['tanggal_transfer']."</td>";
                            echo "<td>".$row4['stamp']."</td>";
                            echo "<td><button onclick='printPaymentDetail(".$row4['invoice_id'].",4)'>".$tempCount."</button></td>";
                            echo "<td>".$row4customer['customer_name']."</td>";
                            echo "<td>Rp ".number_format($row4['payment_price'], 0, ".", ".")."</td>";
                            echo "<td>".$row4bank['short']." ( ".$row4bank['nama']." )</td>";
                            echo "<td>Flight</td>";
                            if($_SESSION['type']==1 OR $_SESSION['type']==2){
                               if($row4['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row4['id'].",4)' name='pilihan".$row4['id']."' value='".$row4['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }else{
                                if($row4['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row4['id'].",4)' name='pilihan".$row4['id']."' value='".$row4['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }

                            echo "</tr>";

                            $grandtotal = $grandtotal + $row4['payment_price'];
                        }

                    }

                    //hotel
                    while($row5=mysqli_fetch_array($rs5)){
                        if($row5['payment_type']!='Cash'){
                            echo "
                            <tr >";

                            $queryinvoice = "SELECT * FROM invoiceFlight WHERE id =".$row5['invoice_id'];
                            $rsinvoice=mysqli_query($con,$queryinvoice);
                            $row5invoice = mysqli_fetch_array($rsinvoice);

                            $querycustomer = "SELECT * FROM customer_list WHERE id =".$row5invoice['customer_id'];
                            $rscustomer=mysqli_query($con,$querycustomer);
                            $row5customer = mysqli_fetch_array($rscustomer);

                            $querybank = "SELECT * FROM bank WHERE id =".$row5['payment_bank'];
                            $rsbank=mysqli_query($con,$querybank);
                            $row5bank = mysqli_fetch_array($rsbank);
                            $tempCount = $row5['invoice_id'] + 50000;
                            echo "<td>".$row5['tanggal_transfer']."</td>";
                            echo "<td>".$row5['stamp']."</td>";
                            echo "<td><button onclick='printPaymentDetail(".$row5['invoice_id'].",5)'>".$tempCount."</button></td>";
                            echo "<td>".$row5customer['customer_name']."</td>";
                            echo "<td>Rp ".number_format($row5['payment_price'], 0, ".", ".")."</td>";
                            echo "<td>".$row5bank['short']." ( ".$row5bank['nama']." )</td>";
                            echo "<td>Hotel</td>";
                            if($_SESSION['type']==1 OR $_SESSION['type']==2){
                               if($row5['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row5['id'].",5)' name='pilihan".$row5['id']."' value='".$row5['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }else{
                                if($row5['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row5['id'].",5)' name='pilihan".$row5['id']."' value='".$row5['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }

                            echo "</tr>";

                            $grandtotal = $grandtotal + $row5['payment_price'];
                        }

                    }


                	
                	echo "<td colspan='4'>Total</td>";
                	echo "<td>Rp ".number_format($grandtotal, 0, ".", ".")."</td>";
                	echo "<td></td>";
                	echo "<td></td>";
                	echo "<td></td>";
                     $grandtotalFinal = $grandtotalFinal + $grandtotal;

                	echo "
                	</tbody>
                	</table>";

                	echo "</br>";
                }







                
            }

              echo "</div>
              <!-- /.card-body -->


              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
            
                include "../site.php";
                include "../db=connection.php";
                $date = $_POST['tanggal'];
                $date2 = $_POST['tanggalx'];
                $querycek = "SELECT COUNT(*) as total FROM payment_detail WHERE ".$string." >= '".$date."' AND payment_type LIKE 'Cash'";
                $rscek=mysqli_query($con,$querycek);
                $rowcek = mysqli_fetch_assoc($rscek);

                $querycek2 = "SELECT COUNT(*) as total FROM payment_detail_visapassport WHERE ".$string." >= '".$date."' AND payment_type LIKE 'Cash'";
                $rscek2=mysqli_query($con,$querycek2);
                $rowcek2 = mysqli_fetch_assoc($rscek2);

                $querycek3 = "SELECT COUNT(*) as total FROM pengeluaran_kantor WHERE ".$string." >= '".$date."'";
                $rscek3=mysqli_query($con,$querycek3);
                $rowcek3 = mysqli_fetch_assoc($rscek3);

                $querycek4 = "SELECT COUNT(*) as total FROM payment_detail_flight WHERE ".$string." >= '".$date."' AND payment_type LIKE 'Cash'";
                $rscek4=mysqli_query($con,$querycek4);
                $rowcek4 = mysqli_fetch_assoc($rscek4);

                $querycek5 = "SELECT COUNT(*) as total FROM payment_detail_hotel WHERE ".$string." >= '".$date."' AND payment_type LIKE 'Cash'";
                $rscek5=mysqli_query($con,$querycek5);
                $rowcek5 = mysqli_fetch_assoc($rscek5);

                if($rowcek['total']>0 OR $rowcek2['total']>0 OR $rowcek3['total']>0 OR $rowcek4['total']>0 OR $rowcek5['total']>0){

	                echo "<center><h3>CASH</h3></center>";
	                $query = "SELECT * FROM payment_detail WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' ORDER BY ".$string." ASC";
	                $rs=mysqli_query($con,$query);

	                $query2 = "SELECT * FROM payment_detail_visapassport WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' ORDER BY ".$string." ASC";
	                $rs2=mysqli_query($con,$query2);

                    $query3 = "SELECT * FROM pengeluaran_kantor WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' ORDER BY ".$string." ASC";
                    $rs3=mysqli_query($con,$query3);

                    $query4 = "SELECT * FROM payment_detail_flight WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' ORDER BY ".$string." ASC";
                    $rs4=mysqli_query($con,$query4);

                    $query5 = "SELECT * FROM payment_detail_hotel WHERE ".$string." >= '".$date."' AND ".$string." <= '".$date2."' ORDER BY ".$string." ASC";
                    $rs5=mysqli_query($con,$query5);

	                $grandtotal = 0;
                    $debit = 0;


	                echo "<table id='dtBasicExample2' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
	                <thead>
	                <tr>
	                <th width='8%'>Tanggal Transfer</th>
                	<th width='8%'>Tanggal Upload</th>
                	<th width='5%'>Invoice ID</th>
                	<th width='14%'>Nama Customer</th>
                    <th width='15%'>Keperluan</th>
                    <th width='15%'>Debit</th>
	                <th width='15%'>Kredit</th>
	                <th width='15%'>Tipe Pembayaran</th>
	                <th width='10%'>Jenis</th>
	                <th width='5%'>Diterima / Tidak</th>
	                </tr>
	                </thead>
	                <tbody id='myTable'>";
                    //landtour
	                while($row=mysqli_fetch_array($rs)){

	                	if($row['payment_type']=='Cash'){
	                		echo "
	                		<tr >";

	                		$queryinvoice = "SELECT * FROM invoice WHERE id =".$row['invoice_id'];
	                		$rsinvoice=mysqli_query($con,$queryinvoice);
	                		$rowinvoice = mysqli_fetch_array($rsinvoice);

	                		$querycustomer = "SELECT * FROM customer_list WHERE id =".$rowinvoice['customer_id'];
	                		$rscustomer=mysqli_query($con,$querycustomer);
	                		$rowcustomer = mysqli_fetch_array($rscustomer);

	                		$querybank = "SELECT * FROM bank WHERE id =".$row['payment_bank'];
	                		$rsbank=mysqli_query($con,$querybank);
	                		$rowbank = mysqli_fetch_array($rsbank);
	                		echo "<td>".$row['tanggal_transfer']."</td>";
	                		echo "<td>".$row['stamp']."</td>";
	                		echo "<td><button onclick='printPaymentDetail(".$row['invoice_id'].",0)'>".$row['invoice_id']."</button></td>";
	                		echo "<td>".$rowcustomer['customer_name']."</td>";
                            echo "<td>-</td>";
                            echo "<td>0</td>";
	                		echo "<td>Rp ".number_format($row['payment_price'], 0, ".", ".")."</td>";
	                		echo "<td>".$row['payment_type']."</td>";
	                		echo "<td>Land Tour</td>";
	                		if($_SESSION['type']==1 OR $_SESSION['type']==2){
	                			if($row['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row['id'].",0)' name='pilihan".$row['id']."' value='".$row['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
	                		}else{
	                			if($row['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row['id'].",0)' name='pilihan".$row['id']."' value='".$row['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
	                		}

	                		echo "</tr>";

	                		$grandtotal = $grandtotal + $row['payment_price'];
	                	}
	               
	                }

                    //visa
	                while($row2=mysqli_fetch_array($rs2)){
	                	if($row2['payment_type']=='Cash'){
	                		echo "
	                		<tr >";

	                		$queryinvoice = "SELECT * FROM invoiceVisaPassport WHERE id =".$row2['invoice_id'];
	                		$rsinvoice=mysqli_query($con,$queryinvoice);
	                		$row2invoice = mysqli_fetch_array($rsinvoice);

	                		$querycustomer = "SELECT * FROM customer_list WHERE id =".$row2invoice['customer_id'];
	                		$rscustomer=mysqli_query($con,$querycustomer);
	                		$row2customer = mysqli_fetch_array($rscustomer);

	                		$querybank = "SELECT * FROM bank WHERE id =".$row2['payment_bank'];
	                		$rsbank=mysqli_query($con,$querybank);
	                		$row2bank = mysqli_fetch_array($rsbank);
	                		echo "<td>".$row2['tanggal_transfer']."</td>";
	                		echo "<td>".$row2['stamp']."</td>";
	                		echo "<td><button onclick='printPaymentDetail(".$row2['invoice_id'].",1)'>".$row2['invoice_id']."</button></td>";
	                		echo "<td>".$row2customer['customer_name']."</td>";
                            echo "<td>-</td>";
                            echo "<td>0</td>";
	                		echo "<td>Rp ".number_format($row2['payment_price'], 0, ".", ".")."</td>";
	                		echo "<td>".$row2['payment_type']."</td>";
	                		echo "<td>Visa Passport</td>";
	                		if($_SESSION['type']==1 OR $_SESSION['type']==2){
                                if($row2['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row2['id'].",1)' name='pilihan".$row2['id']."' value='".$row2['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
	                		}else{
	                			if($row2['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row2['id'].",1)' name='pilihan".$row2['id']."' value='".$row2['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
	                		}

	                		echo "</tr>";

	                		$grandtotal = $grandtotal + $row2['payment_price'];
	                	}

	                }

                    //flight
                     while($row4=mysqli_fetch_array($rs4)){
                        if($row4['payment_type']=='Cash'){
                            echo "
                            <tr >";

                            $queryinvoice = "SELECT * FROM invoiceFlight WHERE id =".$row4['invoice_id'];
                            $rsinvoice=mysqli_query($con,$queryinvoice);
                            $row4invoice = mysqli_fetch_array($rsinvoice);

                            $querycustomer = "SELECT * FROM customer_list WHERE id =".$row4invoice['customer_id'];
                            $rscustomer=mysqli_query($con,$querycustomer);
                            $row4customer = mysqli_fetch_array($rscustomer);

                            $querybank = "SELECT * FROM bank WHERE id =".$row4['payment_bank'];
                            $rsbank=mysqli_query($con,$querybank);
                            $row4bank = mysqli_fetch_array($rsbank);
                            $tempCount = $row4['invoice_id'] + 30000;
                            echo "<td>".$row4['tanggal_transfer']."</td>";
                            echo "<td>".$row4['stamp']."</td>";
                            echo "<td><button onclick='printPaymentDetail(".$row4['invoice_id'].",4)'>".$tempCount."</button></td>";
                            echo "<td>".$row4customer['customer_name']."</td>";
                            echo "<td>-</td>";
                            echo "<td>0</td>";
                            echo "<td>Rp ".number_format($row4['payment_price'], 0, ".", ".")."</td>";
                            echo "<td>".$row4['payment_type']."</td>";
                            echo "<td>Flight</td>";
                            if($_SESSION['type']==1 OR $_SESSION['type']==2){
                                if($row4['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row4['id'].",4)' name='pilihan".$row4['id']."' value='".$row4['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }else{
                                if($row4['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row4['id'].",4)' name='pilihan".$row4['id']."' value='".$row4['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }

                            echo "</tr>";

                            $grandtotal = $grandtotal + $row4['payment_price'];
                        }

                    }

                    //hotel
                     while($row5=mysqli_fetch_array($rs5)){
                        if($row5['payment_type']=='Cash'){
                            echo "
                            <tr >";

                            $queryinvoice = "SELECT * FROM invoiceFlight WHERE id =".$row5['invoice_id'];
                            $rsinvoice=mysqli_query($con,$queryinvoice);
                            $row5invoice = mysqli_fetch_array($rsinvoice);

                            $querycustomer = "SELECT * FROM customer_list WHERE id =".$row5invoice['customer_id'];
                            $rscustomer=mysqli_query($con,$querycustomer);
                            $row5customer = mysqli_fetch_array($rscustomer);

                            $querybank = "SELECT * FROM bank WHERE id =".$row5['payment_bank'];
                            $rsbank=mysqli_query($con,$querybank);
                            $row5bank = mysqli_fetch_array($rsbank);
                            $tempCount = $row5['invoice_id'] + 50000;
                            echo "<td>".$row5['tanggal_transfer']."</td>";
                            echo "<td>".$row5['stamp']."</td>";
                            echo "<td><button onclick='printPaymentDetail(".$row5['invoice_id'].",5)'>".$tempCount."</button></td>";
                            echo "<td>".$row5customer['customer_name']."</td>";
                            echo "<td>-</td>";
                            echo "<td>0</td>";
                            echo "<td>Rp ".number_format($row5['payment_price'], 0, ".", ".")."</td>";
                            echo "<td>".$row5['payment_type']."</td>";
                            echo "<td>Hotel</td>";
                            if($_SESSION['type']==1 OR $_SESSION['type']==2){
                                if($row5['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row5['id'].",5)' name='pilihan".$row5['id']."' value='".$row5['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }else{
                                if($row5['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row5['id'].",5)' name='pilihan".$row5['id']."' value='".$row5['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }

                            echo "</tr>";

                            $grandtotal = $grandtotal + $row5['payment_price'];
                        }

                    }

                    //pengeluarankantor
                    while($row3=mysqli_fetch_array($rs3)){
                            echo "
                            <tr >";

                            echo "<td>".$row3['tanggal_transfer']."</td>";
                            echo "<td>".$row3['stamp']."</td>";
                            echo "<td>-</td>";
                            echo "<td>-</td>";
                            echo "<td>".$row3['description']."</td>";
                            echo "<td>Rp ".number_format($row3['total'], 0, ".", ".")."</td>";
                            echo "<td>0</td>";
                            echo "<td>Cash</td>";
                            echo "<td>Keperluan Kantor</td>";
                            if($_SESSION['type']==1 OR $_SESSION['type']==2){
                                if($row3['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row3['id'].",2)' name='pilihan".$row3['id']."' value='".$row3['id']."'></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }else{
                                if($row3['status_cek']==0){
                                    echo "<td><input type='checkbox' onclick='updateCek(".$row3['id'].",2)' name='pilihan".$row3['id']."' value='".$row3['id']."' disabled></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                }
                            }

                            echo "</tr>";

                            $debit = $debit + $row3['total'];

                    }

                    $grandtotalFinal2 = $grandtotal - $debit;

	                echo "<td colspan='5'>Total</td>";
                    echo "<td>Rp ".number_format($debit, 0, ".", ".")."</td>";
                    echo "<td>Rp ".number_format($grandtotal, 0, ".", ".")."</td>";
	                echo "<td></td>";
	                echo "<td></td>";

	                echo "<td></td>";



                    echo "<tr>";
                    echo "<td colspan='5'></td>";
                    echo "<td colspan='2'><center>Rp ".number_format($grandtotalFinal2, 0, ".", ".")."</center></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";

                    echo "</tr>";
                     $grandtotalFinal = $grandtotalFinal + $grandtotal - $debit;

	                echo "
	                </tbody>
	                </table>";
	                }
	            
                     echo "<center><span style='margin-top:100px;'>Total Pemasukkan : Rp ".number_format($grandtotalFinal, 0, ".", ".")."</span></center></br>";
              echo "</div>
              <!-- /.card-body -->






            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>

   function printPaymentDetail(x,y){
    window.open("https://www.2canholiday.com/Admin/printpaymentdetail.php?id="+x+"&tipe="+y, '_blank');
  }
$(document).ready(function(){
    $(".chosen").chosen();

    // $('#dtBasicExample1').DataTable();
    // $('.dataTables_length').addClass('bs-select');

    $('input[name="datefilter"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

    $("#but_transfer").click(function(){
        var fd = new FormData();
     
        var date=new Date($('input[name="datefilter"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var tanggal = year + "-" + month + "-" + day;
        var tanggal2 = month + "/" + day + "/" + year;

        fd.append('tanggal',tanggal);
        fd.append('tanggal2',tanggal2);



        var datex=new Date($('input[name="datefilter2"]').val());
        var monthx = ((datex.getMonth()+1)<10) ? "0" + (datex.getMonth()+1) : (datex.getMonth()+1);
        var dayx = (datex.getDate() < 10) ? "0" + datex.getDate() : datex.getDate();
        var yearx = datex.getFullYear();

        var tanggalx = yearx + "-" + monthx + "-" + dayx;
        var tanggalx2 = monthx + "/" + dayx + "/" + yearx;

        fd.append('tanggalx',tanggalx);
        fd.append('tanggalx2',tanggalx2);



        fd.append('tipe',1);
      
        $.ajax({

            url:"searchcekbuktipembayaran.php",

            method: "POST",

            asynch: false,

            data: fd,

            contentType: false,

            processData: false,

            success:function(data){

                $("#divReloadPage").html(data);

            }

        });

    });

    $("#but_upload").click(function(){
        var fd = new FormData();
     
        var date=new Date($('input[name="datefilter"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var tanggal = year + "-" + month + "-" + day;
        var tanggal2 = month + "/" + day + "/" + year;

        fd.append('tanggal',tanggal);
        fd.append('tanggal2',tanggal2);


        var datex=new Date($('input[name="datefilter2"]').val());
        var monthx = ((datex.getMonth()+1)<10) ? "0" + (datex.getMonth()+1) : (datex.getMonth()+1);
        var dayx = (datex.getDate() < 10) ? "0" + datex.getDate() : datex.getDate();
        var yearx = datex.getFullYear();

        var tanggalx = yearx + "-" + monthx + "-" + dayx;
        var tanggalx2 = monthx + "/" + dayx + "/" + yearx;

        fd.append('tanggalx',tanggalx);
        fd.append('tanggalx2',tanggalx2);

        
        fd.append('tipe',2);
      
        $.ajax({

            url:"searchcekbuktipembayaran.php",

            method: "POST",

            asynch: false,

            data: fd,

            contentType: false,

            processData: false,

            success:function(data){

                $("#divReloadPage").html(data);

            }

        });

    });

});

  function updateCek(x,y){
    var txt;
    var r = confirm("Are you sure to Cek this?");
    if (r == true) {
     $.ajax({
        url:"updateCekPaymentDetail.php",
        method: "POST",
        asynch: false,
        data:{id:x,tipe:y},
        success:function(data){
          if(data=="success"){
            alert(data);
            reloadCek(0,0,0);
          }else{
            alert("Fail to Cek");
          }
        }
      });
     } 
  }
</script>


