<?php
include "../db=connection.php";
session_start();
$query_role = "SELECT * FROM Staff_role where staff_id='" . $_SESSION['staff_id'] . "'";
$rs_role = mysqli_query($con, $query_role);
$row_role = mysqli_fetch_array($rs_role);
$role_check = explode(",", $row_role['menu_sub']);
function hide_sub_menu($x, $y)
{
    $sub_menu = 0;
    $key_sub_menu = array_search($x, $y);
    if ($key_sub_menu !== false) {
        $sub_menu = 1;
    }
    return $sub_menu;

    // return json_encode(array("sub_menu" => $sub_menu), true);
}

?>
<div class="content-wrapper" style="width: 110%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Paket Tour List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px; ">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-success btn-sm" style="margin: 2px;" onclick=""><i class="fa fa-plus"></i></a>
                                <a class="btn btn-warning btn-sm" style="margin: 2px;" data-toggle="modal" data-target="#new_package">New Agent</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query_agn = "SELECT * FROM  agent_transport  order by id ASC";
                    $rs_agn = mysqli_query($con, $query_agn);

                    $no = 1;
                    ?>
                    <div style="padding: 20px;">
                        <table id="tb-pt-sub" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Agent Name</th>
                                    <th>Country</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row_agn = mysqli_fetch_array($rs_agn)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row_agn['id'] ?></td>
                                        <td>
                                            <div style="font-weight: bold; text-decoration: underline;"><?php echo $row_agn['name'] ?></div>
                                            <div><?php echo $row_agn['company'] ?></div>
                                        </td>
                                        <td>
                                            <div style="font-weight: bold; text-decoration: underline;"><?php echo $row_agn['country'] ?></div>
                                            <div><?php echo $row_agn['tour_country'] ?></div>
                                        </td>
                                        <td>
                                            <div style="font-weight: bold; text-decoration: underline;"><?php echo $row_agn['home_phone'] ?></div>
                                            <div><?php echo $row_agn['email'] ?></div>
                                            <div><?php echo $row_agn['website'] ?></div>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" onclick="view(<?php echo $row_agn['id'] ?>)"><i class="fas fa-list"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="loading2" style="padding: 20px; display: none;">
                        <div class="d-flex justify-content-center">
                            <h2><strong>Loading Transport </strong></h2>
                            <div style="padding: 10px;">
                                <div class="spinner-grow text-muted"></div>
                                <div class="spinner-grow text-primary"></div>
                                <div class="spinner-grow text-success"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="new_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Agent</label>
                                        <input type="text" class="form-control" id="nama_agent" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Company Agent</label>
                                        <input type="text" class="form-control" id="nama_company" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Agent Code</label>
                                        <input type="text" class="form-control" id="agent_code" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Tlpn</label>
                                        <input type="text" class="form-control" id="tlpn" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" id="website" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" id="alamat" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <input type="text" class="form-control" id="kota" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Negara</label>
                                        <input type="text" class="form-control" id="negara" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Tour Country</label>
                                        <input type="text" class="form-control" id="tour_code" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <input type="text" class="form-control" id="note" placeholder="Enter Package Name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_package()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 20px;" id="translist">
                    </div>
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
        $('#tb-pt-sub').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#tb-trans').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });
</script>
<script>
    function delete_itin(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_copy.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(40, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function view(x) {
        document.getElementById("loading2").style.display = "block";
        $.ajax({
            url: "TRN_landtrans_list.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
            },
            success: function(data) {
                document.getElementById("loading2").style.display = "none";
                $('#translist').html(data);
            }
        });
    }

    function add_package() {
        var agent = document.getElementById("nama_agent").value;
        var company = document.getElementById("nama_company").value;
        var code = document.getElementById("agent_code").value;
        var email = document.getElementById("email").value;
        var tlpn = document.getElementById("tlpn").value;
        var web = document.getElementById("website").value;
        var alamat = document.getElementById("alamat").value;
        var kota = document.getElementById("kota").value;
        var negara = document.getElementById("negara").value;
        var tour_code = document.getElementById("tour_code").value;
        var note = document.getElementById("note").value;
        $.ajax({
            url: "insert_agent_transport.php",
            method: "POST",
            asynch: false,
            data: {
                agent: agent,
                company:company,
                code:code,
                email:email,
                tlpn:tlpn,
                web:web,
                alamat:alamat,
                kota:kota,
                negara:negara,
                tour_code:tour_code,
                note:note

            },
            success: function(data) {
                alert(data);
            }
        });
    }
</script>