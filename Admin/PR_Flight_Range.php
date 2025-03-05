<?php
session_start();
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title" style="font-weight:bold;">Flight Package List</h3> -->
                    <!-- <div class="card-tools"> -->
                    <div class="input-group input-group-sm">
                        <div class="input-group-append" style="text-align: left;">
                            <div style="padding-right: 5px;">
                                <button type="submit" onclick="PR_Package(2,0,0)" class="btn btn-primary  btn-sm"><i class="fa fa-plus"></i></button>
                                <button type="submit" onclick="edit_tr()" class="btn btn-success  btn-sm">Edit</button>
                                <button type="submit" onclick="edit_all()" class="btn btn-warning  btn-sm">Edit ALL</button>
                            </div>
                            <h3 class="card-title" style="font-weight:bold;">Flight Profit Range List</h3>
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  LT_profit_range order by price1 ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tgl</th>
                                <th>Start From</th>
                                <th>Until</th>
                                <th>Profit</th>
                                <th>Admin</th>
                                <th>Marketing</th>
                                <th>Sub Agent</th>
                                <th>Staff Eksekutor</th>
                                <th>Nominal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                // var_dump($data);
                            ?>
                                <tr>
                                    <td><?php echo  $row['id'] ?></td>
                                    <td><?php echo  $row['tgl'] ?></td>
                                    <td><?php echo number_format($row['price1'], 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($row['price2'], 0, ",", ".") ?></td>
                                    <td><?php echo  $row['profit'] . " %" ?></td>
                                    <td><?php echo  $row['adm_mkp'] . " %" ?></td>
                                    <td><?php echo number_format($row['marketing'], 0, ",", ".") . " %" ?></td>
                                    <td><?php echo number_format($row['sub_agent'], 0, ",", ".") . " %" ?></td>
                                    <td><?php echo number_format($row['staff_eks'], 0, ",", ".")  ?></td>
                                    <td style="max-width: 120px;">
                                        <input type="text" class="form-control form-control-sm" id="nominal<?php echo $row['id'] ?>" name="nominal<?php echo $row['id'] ?>" value="<?php echo $row['nominal'] ?>" onchange="set_nominal(<?php echo $row['id'] ?>)">
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input position-static" type="checkbox" id="chck" name="chck" value="<?php echo $row['id'] ?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });
    });
</script>
<script>
    function edit_tr(x) {
        let formData = new FormData();
        let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
        let output = [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
        var data = output.toString();
        PR_Package(7, data, 0);
    }

    function edit_all(x) {
        PR_Package(7, 0, 1);
    }
    function set_nominal(x){
        var txt;
        var r = confirm("Are you sure to Change ?");
        if (r == true) {
            var nominal = $("input[name=nominal"+x+"]").val();
            let formData = new FormData();
            formData.append("id", x);
            formData.append("nominal",nominal);
			$.ajax({
				type: 'POST',
				url: "change_nominal_fl.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
                    PR_Package(1, 0, 0);
				},
				error: function() {
					alert("Data Gagal Diupload");
                    PR_Package(1, 0, 0);
				}
			}); 
        }
    }
</script>