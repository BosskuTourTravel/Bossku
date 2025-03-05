<?php
session_start();
include "../site.php";
include "../db=connection.php";
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Otorisasi Staff</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <button type="button" onclick="insertPage(26,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_staff"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="add_staff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ADD NEW STAFF</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-add-staff">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control form-control-sm" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" class="form-control form-control-sm" id="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">No HP</label>
                                        <input type="text" class="form-control form-control-sm" id="tlpn">
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Role Type</label>
                                        <select class="form-control form-control-sm" id="item2" name="item2">
                                            <?php
                                            $query_lvl2 = "SELECT * FROM level order by id ASC ";
                                            $rs_lvl2 = mysqli_query($con, $query_lvl2);
                                            while ($row_lvl2 = mysqli_fetch_array($rs_lvl2)) {
                                            ?>
                                                <option value="<?php echo $row_lvl2['id'] ?>"><?php echo $row_lvl2['level'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cabang</label>
                                        <select class="form-control form-control-sm" id="cabang" name="cabang">
                                            <option value="">Pilih Cabang</option>
                                            <option value="2">SURABAYA</option>
                                            <option value="3">BATAM</option>
                                            <option value="4">JAKARTA</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_staff()">Add Staff</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php

                    $query = "SELECT * FROM login_staff order by id ASC";
                    $rs = mysqli_query($con, $query);
                    // var_dump(mysqli_fetch_array($rs));
                    ?>
                    <div style="padding: 20px;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Type</th>
                                    <th>Staff ID</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_array($rs)) {
                                    $query_lvl = "SELECT * FROM level where id=" . $row['type'];
                                    $rs_lvl = mysqli_query($con, $query_lvl);
                                    $row_lvl = mysqli_fetch_array($rs_lvl);

                                ?>
                                    <tr>
                                        <th><?php echo $no ?></th>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row_lvl['level'] ?></td>
                                        <td><?php echo $row['id'] ?></td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#role" data-id="<?php echo $row['id']  ?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-success btn-sm" onclick="change_user(<?php echo $row['id'] ?>)"><i class="fas fa-sign-in-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Role Type </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-role"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
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
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#role').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_role.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id
                },
                success: function(data) {
                    $('.modal-data-role').html(data);
                }
            });
        });
    });
</script>
<script>
    function change_user(x) {
        $.ajax({
            url: "change_user.php",
            method: "POST",
            asynch: false,
            data: {
                id: x
            },
            success: function(data) {
                alert("berhasil ganti akun");
                window.location.href = "https://www.2canholiday.com/Admin";
            }
        });
    }

    function add_staff() {
        var name = document.getElementById("nama").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var phone = document.getElementById("tlpn").value;
        var type = document.getElementById("item2").value;
        var cabang = document.getElementById("cabang").value;

        $.ajax({
            url: "insertStaff2.php",
            method: "POST",
            asynch: false,
            data: {
                name: name,
                email: email,
                password: password,
                phone: phone,
                staff: type,
                cabang: cabang
            },
            success: function(data) {
                alert(data);
            }
        });
    }
</script>