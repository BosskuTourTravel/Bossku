<?php
include "../db=connection.php";
include "Api_paket_tour.php";
session_start();
$show = get_rent();
$result = json_decode($show, true);
// /var_dump($result);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Upload Tokopedia Package <?php echo $_POST['id'] ?></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append" style="text-align: right;">
                            <a class="btn btn-warning btn-sm tip" onclick="MP_Package(1,0,0)" title="Back" style="margin: 2px;"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#new_package" style="margin: 2px;">Insert</i></a>
                                <a class="btn btn-warning btn-sm" style="margin: 2px;" onclick="edit_pack(<?php echo $_POST['id'] ?>)">Edit</i></a>
                                <a class="btn btn-success btn-sm" style="margin: 2px;" onclick="update_pack(<?php echo $_POST['id'] ?>)">Update</i></a>
                                <a class="btn btn-danger btn-sm" style="margin: 2px;" onclick="del_pack(<?php echo $_POST['id'] ?>)">Delete</i></a>
                                <a class="btn btn-danger btn-sm" style="margin: 2px;" onclick="del_all(<?php echo $_POST['id'] ?>)">Delete All</i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="MP_Package(4,<?php echo $_POST['id'] ?>,0)" title="Reload" style="margin: 2px;"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $no = 1;
                    ?>
                    <div style="padding: 20px;">
                        <table id="tokopedia" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr style="color: whitesmoke;">
                                    <th style="background-color: green;">ID</th>
                                    <th style="background-color: green; color: darkred;">Nama Produk</th>
                                    <th style="background-color: green; color: darkred;">Deskripsi</th>
                                    <th style="background-color: green; color: darkred;">Kode Kategori</th>
                                    <th style="background-color: green; color: darkred;">Berat (gram)</th>
                                    <th style="background-color: green; color: darkred;">Minimum Pesanan</th>
                                    <th style="background-color: green;">Nomor Etalase</th>
                                    <th style="background-color: green;">Waktu Preorder</th>
                                    <th style="background-color: green; color: darkred;">Kondisi</th>
                                    <th style="background-color: green; color: darkred;">Img 1</th>
                                    <th style="background-color: green;">Img 2</th>
                                    <th style="background-color: green;">Img 3</th>
                                    <th style="background-color: green;">Img 4</th>
                                    <th style="background-color: green;">Img 5</th>
                                    <th style="background-color: green;">Video 1</th>
                                    <th style="background-color: green;">Video 2</th>
                                    <th style="background-color: green;">Video 3</th>
                                    <th style="background-color: darkcyan;">Sku</th>
                                    <th style="background-color: darkcyan; color: darkred;">Status</th>
                                    <th style="background-color: darkcyan; color: darkred;">Jml Stok</th>
                                    <th style="background-color: darkcyan; color: darkred;">Harga</th>
                                    <th style="background-color: darkcyan; color: darkred;">Kurir</th>
                                    <th style="background-color: darkcyan; color: darkred;">Asuransi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM Upload_tokopedia_rent where mp_id='" . $_POST['id'] . "' ORDER BY id ASC limit 300";
                                $rs = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_array($rs)) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="upload_id" name="upload_id" value="<?php echo $row['id']  ?>">
                                                <label class="form-check-label"><?php echo $row['id'] ?></label>
                                            </div>
                                        </td>
                                        <td style="min-width: 300px;">
                                            <div><?php echo $row['produk_name'] ?></div>
                                            <div><?php echo $row['varian'] ?></div>
                                        </td>
                                        <td>
                                            <a class="btn btn-light btn-sm" data-toggle="modal" data-target="#view" data-id="<?php echo $row['id']  ?>" style="margin: 2px;">View Descriptions</i></a>
                                        </td>
                                        <td><?php echo $row['kategori'] ?></td>
                                        <td><?php echo $row['berat'] ?></td>
                                        <td><?php echo $row['min_pembelian'] ?></td>
                                        <td><?php echo $row['etalase'] ?></td>
                                        <td><?php echo $row['preorder'] ?></td>
                                        <td><?php echo $row['kondisi'] ?></td>
                                        <td><?php echo $row['img1'] ?></td>
                                        <td><?php echo $row['img2'] ?></td>
                                        <td><?php echo $row['img3'] ?></td>
                                        <td><?php echo $row['img4'] ?></td>
                                        <td><?php echo $row['img5'] ?></td>
                                        <td><?php echo $row['vid1'] ?></td>
                                        <td><?php echo $row['vid2'] ?></td>
                                        <td><?php echo $row['vid3'] ?></td>
                                        <td><?php echo $row['sku'] ?></td>
                                        <td><?php echo $row['status'] ?></td>
                                        <td><?php echo $row['stok'] ?></td>
                                        <td><?php echo "IDR " . number_format($row['Harga'])  ?></td>
                                        <td><?php echo $row['kurir'] ?></td>
                                        <td><?php echo $row['asuransi'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="new_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Insert Paket Tour</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Package Name</label>
                                        <input class="form-control form-control-sm" list="paket_list" name="paket" id="paket" autocomplete="off" placeholder="Pilih Negara" onchange="fungsi_city()">
                                        <datalist id="paket_list">
                                            <?php
                                            foreach ($result as $data) {
                                            ?>
                                                    <option label="<?php echo  $data['periode'] . " IN " . $data['city'] . " " . $data['country']  ?>" value="<?php echo $data['trans_type']." (".$data['seat']." Seat) ".$data['company'] ?>" data-id="<?php echo $data['id'] ?>">
                                                <?php
                                            }
                                                ?>
                                        </datalist>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_package(<?php echo $_POST['id'] ?>)">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content ">
                                <div class="modal-header" style="text-align: center;">
                                    <h5 class="modal-title" id="exampleModalLabel">Deskripsi Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="view-detail"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    Note : MAX data 300 
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
        $('#tokopedia').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 10
        });
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
        $('#view').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_view_desc_rent.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#view-detail').html(data);
                }
            });
        });
    });


    function add_package(x) {
        var paket = $("#paket_list option[value='" + $('#paket').val() + "']").attr('data-id');
        // alert(nama);
        $.ajax({
            url: "insert_paket_tokopedia_rent.php",
            method: "POST",
            asynch: false,
            data: {
                paket: paket,
                id: x
            },
            success: function(data) {
                alert(data);
            }
        });
    }

    function edit_pack(x) {
        var arr = [];
        $('input[name="upload_id"]:checked').each(function() {

            arr.push(this.value);
        });
        var arr = arr.toString();
        MP_Package(5, arr, x);
    }

    function del_pack(x) {
        var txt;
        var r = confirm("Apakah Kamu yakin menghapus data yang dipilih  ?");
        if (r == true) {
            let formData = new FormData();
            $('input[name="upload_id"]:checked').each(function() {
                // arr.push(this.value);
                var id = this.value;
                formData.append("id[]", id);
            });
            $.ajax({
                type: 'POST',
                url: "MP_tokopedia_rent_delete.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    alert(data);
                    MP_Package(4, x, 0);

                }
            });
        }
    }

    function del_all(x) {
        var txt;
        var r = confirm("Apakah Kamu yakin menghapus Semua data ?");
        if (r == true) {
            $.ajax({
                url: "MP_tokopedia_rent_delete_all.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    alert(data);
                    MP_Package(4, x, 0);
                }
            });
        }

    }

    function update_pack(x) {
        var txt;
        var r = confirm("Apakah Kamu yakin mengupdate semua harga ?");
        if (r == true) {
            $.ajax({
                url: "update_price_tokopedia_rent.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    alert(data);
                    MP_Package(4, x, 0);
                }
            });
        }
    }
</script>