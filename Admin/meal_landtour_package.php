<?php
session_start();
include "../site.php";
include "../db=connection.php";
include "../slug.php";
include "Api_LT_total_baru.php";
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Meal Landtour</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="Meal_Package(0,0,0)"><i class="fas fa-sync-alt"></i></a>
                                <a class="btn btn-primary btn-sm tip" data-toggle="modal" data-target="#add-modal"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-2">
                    <?php
                    $query = "SELECT Guest_meal2.id,Guest_meal2.negara,Guest_meal2.kurs, bf_meal.price as breakfast,ln_meal.price as lunch,dn_meal.price as dinner, Guest_meal2.ket FROM Guest_meal2 LEFT JOIN Guest_meal2 as bf_meal ON (bf_meal.negara = Guest_meal2.negara && bf_meal.meal_type='BREAKFAST' && bf_meal.ket=Guest_meal2.ket) LEFT JOIN Guest_meal2 as ln_meal ON (ln_meal.negara = Guest_meal2.negara && ln_meal.meal_type='LUNCH' && ln_meal.ket=Guest_meal2.ket) LEFT JOIN Guest_meal2 as dn_meal ON (dn_meal.negara = Guest_meal2.negara && dn_meal.meal_type='DINNER' && dn_meal.ket=Guest_meal2.ket) GROUP BY Guest_meal2.ket  order by Guest_meal2.negara ASC";
                    $rs = mysqli_query($con, $query);
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Negara</th>
                                <th>Kurs</th>
                                <th>Breakfast</th>
                                <th>Lunch</th>
                                <th>Dinner</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($rs)) {
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row['negara'] ?></td>
                                    <td><?php echo $row['kurs'] ?></td>
                                    <td><?php echo $row['breakfast'] ?></td>
                                    <td><?php echo $row['lunch'] ?></td>
                                    <td><?php echo $row['dinner'] ?></td>
                                    <td><?php echo $row['ket'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm p-1" data-toggle="modal" data-target="#edit-modal" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm p-1"  onclick="del_meal('<?php echo $row['ket'] ?>')"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ADD MEAL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-add"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_meal()" data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ADD MEAL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-edit"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="update_meal()" data-id="" data-dismiss="modal">Submit</button>
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
            "iDisplayLength": 15
        });
        $('#add-modal').on('show.bs.modal', function(e) {
            $.ajax({
                url: "form_add_meal.php",
                method: "POST",
                asynch: false,
                success: function(data) {
                    $('.modal-data-add').html(data);
                }
            });
        });
        $('#edit-modal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "form_edit_meal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id
                },
                success: function(data) {
                    $('.modal-data-edit').html(data);
                }
            });
        });

    });

    function add_meal() {
        var negara = document.getElementById("negara").value;
        var kurs = document.getElementById("kurs").value;
        var bf = document.getElementById("bf").value;
        var ln = document.getElementById("ln").value;
        var dn = document.getElementById("dn").value;
        var ket = document.getElementById("ket").value;
        if (negara === "" || kurs === "") {
            alert("Negara dan Kurs belum di input !");
        } else {
            $.ajax({
                url: "cek_insert_form_meal.php",
                method: "POST",
                asynch: false,
                data: {
                    negara: negara,
                    kurs: kurs,
                    bf: bf,
                    ln: ln,
                    dn: dn,
                    ket: ket
                },
                success: function(data) {
                    if (data === "sama") {
                        alert("Data Keterangan Yang Di masukkan Sudah tersedia, Data gagal di input !");
                    } else {
                        insert_meal();
                    }
                    // alert(data);
                    // Meal_Package(0, 0, 0);
                }
            });
        }
    }


    function update_meal() {
        var negara = document.getElementById("negara_edit").value;
        var kurs = document.getElementById("kurs_edit").value;
        var bf = document.getElementById("bf_edit").value;
        var ln = document.getElementById("ln_edit").value;
        var dn = document.getElementById("dn_edit").value;
        var ket = document.getElementById("ket_edit").value;
        if (negara === "" || kurs === "") {
            alert("Negara dan Kurs belum di input !");
        } else {
            $.ajax({
                url: "update_form_meal.php",
                method: "POST",
                asynch: false,
                data: {
                    negara: negara,
                    kurs: kurs,
                    bf: bf,
                    ln: ln,
                    dn: dn,
                    ket: ket
                },
                success: function(data) {
                    alert(data);
                    Meal_Package(0, 0, 0);
                }
            });
        }

    }

    function insert_meal() {
        var negara = document.getElementById("negara").value;
        var kurs = document.getElementById("kurs").value;
        var bf = document.getElementById("bf").value;
        var ln = document.getElementById("ln").value;
        var dn = document.getElementById("dn").value;
        var ket = document.getElementById("ket").value;
        if (negara === "" || kurs === "") {
            alert("Negara dan Kurs belum di input !");
        } else {
            $.ajax({
                url: "insert_form_meal.php",
                method: "POST",
                asynch: false,
                data: {
                    negara: negara,
                    kurs: kurs,
                    bf: bf,
                    ln: ln,
                    dn: dn,
                    ket: ket
                },
                success: function(data) {
                    alert(data);
                    Meal_Package(0, 0, 0);
                }
            });
        }
    }

    function edit_meal(x) {
        $.ajax({
            url: "edit_form_meal.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
            },
            success: function(data) {
                alert(data);
                Meal_Package(0, 0, 0);
            }
        });
    }
    function del_meal(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "delete_meal.php",
                method: "POST",
                asynch: false,
                data: {
                    slug: x
                },
                success: function(data) {
                    if (data == "success") {
                        Meal_Package(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>