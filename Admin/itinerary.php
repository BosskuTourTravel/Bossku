<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Itenerary</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <button type="submit" onclick="reloadLandtour(3,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div style="padding: 20px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="header">
                                        <div class="card">
                                            <div class="card-header">
                                                Input Image
                                            </div>
                                            <div class="card-body">
                                                <div style="padding: 10px;">
                                                    <a href="#" class="btn btn-primary">Upload Image</a>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col">
                                                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col">
                                                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col">
                                                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col">
                                                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="img-fluid" alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card" style="padding-top: 10px;">
                                            <div class="card-header">
                                                Input Data
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Judul</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Total Peserta</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Landtour</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div style="border: 2px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Pilih Jumlah Day</label>
                                            <select class="form-control" name="sel_day" id="sel_day" onchange="get_sub()">
                                                <?php
                                                for ($i = 1; $i <= 15; $i++) {
                                                ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub" name="sub" id="sub">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card" style="padding-top: 10px;">
                                                <div class="card-header">
                                                    Day 1
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Rute</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Transport</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Pilih Jumlah Tujuan</label>
                                                            <select class="form-control" name="sel_tujuan" id="sel_tujuan" onchange="get_tujuan()">
                                                                <?php
                                                                for ($i = 1; $i <= 10; $i++) {
                                                                ?>
                                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <!-- tujuan -->
                                                        <div class="st" name="st" id="st" style="padding-left: 20px;">
                                                            <label for="exampleFormControlInput1">Tujuan 1</label>
                                                            <select class="form-control" id="" name="">
                                                                <option value="">Tempat 1</option>
                                                                <option value="">Tempat 2</option>
                                                                <option value="">Tempat 3</option>
                                                                <option value="">Tempat 4</option>
                                                            </select>
                                                        </div>
                                                        <div class="st2" name="st2" id="st2" style="padding-left: 20px;"></div>
                                                        <!-- end tujuan -->
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Breakfast</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Lunch</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Dinner</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card" style="padding-top: 10px;">
                                                <div class="card-header">
                                                    Input Guide
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Fee</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">S Fee</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Meal</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub" name="sub2" id="sub2"></div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card" style="padding-top: 10px;">
                                            <div class="card-header">
                                                Landtour
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Transport</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Admission Ticket</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Type Transport</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card" style="padding-top: 10px;">
                                            <div class="card-header">
                                                Tour Leader
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">TL</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Pendeta</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Meal</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
<script>
    function get_sub() {
        var a = document.getElementById("sel_day").options[document.getElementById("sel_day").selectedIndex].value;
        $.ajax({
            url: "sub_day.php",
            method: "POST",
            asynch: false,
            data: {
                sub: a,
            },
            success: function(data) {
                $('#sub2').html(data);
                document.getElementById('sub').style.display = 'none';
                document.getElementById('sub2').style.display = 'block';
            }
        });
        // }

    }

    function get_tujuan() {
        var a = document.getElementById("sel_tujuan").options[document.getElementById("sel_tujuan").selectedIndex].value;
        $.ajax({
            url: "sub_tujuan.php",
            method: "POST",
            asynch: false,
            data: {
                tujuan: a,
            },
            success: function(data) {
                $('#st2').html(data);
                document.getElementById('st').style.display = 'none';
                document.getElementById('st2').style.display = 'block';
            }
        });
    }

    // function get_tq() {
    //     var a = document.getElementById("sel_tq").options[document.getElementById("sel_tq").selectedIndex].value;
    //     $.ajax({
    //         url: "sub_tq.php",
    //         method: "POST",
    //         asynch: false,
    //         data: {
    //             tujuan: a,
    //         },
    //         success: function(data) {
    //             $('#tq2').html(data);
    //             document.getElementById('tq').style.display = 'none';
    //             document.getElementById('tq2').style.display = 'block';
    //         }
    //     });
    // }
</script>