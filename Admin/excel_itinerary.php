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
                    <h3 class="card-title" style="font-weight:bold;">List Itinerary</h3>
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
                    <div class="container" style="padding: 20px;">
                        <?php
                        if ($_SESSION['staff'] == "Lestari" or  $_SESSION['staff'] == "Neno Kusminto" or $_SESSION['staff'] == "Thesa Natalia Barus" or $_SESSION['staff'] == "Elisa" or $_SESSION['staff'] == "Nurul Afila") {

                        ?>
                            <!-- <div>
                                <label>File input Rute</label>
                                <form mehtod="post" id="import_rute">
                                    <div class="form-group">
                                        <input type="file" name="excel_rute" id="excel_rute">
                                    </div>
                                </form>
                                <div id="result_rute" style="padding-bottom: 20px;">
                                </div>
                            </div> -->
                        <?php
                        }
                        if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto" or $_SESSION['staff'] == "Elisa" or $_SESSION['staff'] == "Lestari") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_transport">
                                    <label>File input Transport</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_transport" id="excel_transport">
                                    </div>
                                </form>
                                <div id="result_transport" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        if ($_SESSION['staff'] == "Elisa" or  $_SESSION['staff'] == "Neno Kusminto" or $_SESSION['staff'] == "Thesa Natalia Barus" or $_SESSION['staff'] == "Nurul Afila") {
                        ?>
                            <!-- <div>
                                <form mehtod="post" id="import_tempat">
                                    <label>File input Tempat</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_tempat" id="excel_tempat">
                                    </div>
                                </form>
                                <div id="result_tempat" style="padding-bottom: 20px;">
                                </div>
                            </div> -->
                        <?php
                        }
                        if ($_SESSION['staff'] == "Sherliana Tanjaya" or $_SESSION['staff'] == "Lestari" or $_SESSION['staff'] == "Elisa" or  $_SESSION['staff'] == "Neno Kusminto" or $_SESSION['staff'] == "Nurul Afila" or $_SESSION['staff'] == "Nadia") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_meal">
                                    <label>File input Guest excel_meal</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_meal" id="excel_meal">
                                    </div>
                                </form>
                                <div id="result_meal" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        if ($_SESSION['staff'] == "Lestari" or  $_SESSION['staff'] == "Neno Kusminto" or $_SESSION['staff'] == "Nurul Afila" or $_SESSION['staff'] == "Selvi" ) {
                        ?>
                            <div>
                                <form mehtod="post" id="import_gmeal">
                                    <label>File input Guide excel_meal</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_gmeal" id="excel_gmeal">
                                    </div>
                                </form>
                                <div id="result_gmeal" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        if ($_SESSION['staff'] == "Yunia Taher" or  $_SESSION['staff'] == "Neno Kusminto") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_flight">
                                    <label>File input Flight</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_flight" id="excel_flight">
                                    </div>
                                </form>
                                <div id="result_flight" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        if ($_SESSION['staff'] == "Lestari" or  $_SESSION['staff'] == "Neno Kusminto" or  $_SESSION['staff'] == "Nadia") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_LT">
                                    <label>File input LT</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_LT" id="excel_LT">
                                    </div>
                                </form>
                                <div id="result_LT" style="padding-bottom: 20px;">
                                </div>
                            </div>
                            <div>
                                <form mehtod="post" id="import_agentLT">
                                    <label>File input Agent LT</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_agentLT" id="excel_agentLT">
                                    </div>
                                </form>
                                <div id="result_agentLT" style="padding-bottom: 20px;">
                                </div>
                            </div>
                            <div>
                                <form mehtod="post" id="import_tipsLT">
                                    <label>File input Tips LT</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_tipsLT" id="excel_tipsLT">
                                    </div>
                                </form>
                                <div id="result_tipsLT" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php

                        }
                        if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_TL">
                                    <label>File input TL FEE</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_TL" id="excel_TL">
                                    </div>
                                </form>
                                <div id="result_TL" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_include">
                                    <label>File input Include / Exclude</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_include" id="excel_include">
                                    </div>
                                </form>
                                <div id="result_include" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto") {
                        ?>
                            <!-- <div>
                                <form mehtod="post" id="import_tips">
                                    <label>Tips</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_tips" id="excel_tips">
                                    </div>
                                </form>
                                <div id="result_tips" style="padding-bottom: 20px;">
                                </div>
                            </div> -->
                        <?php
                        }
                        if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_ferry">
                                    <label>ferry</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_ferry" id="excel_ferry">
                                    </div>
                                </form>
                                <div id="result_ferry" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto" or $_SESSION['staff'] == "Nadia") {
                        ?>
                            <div>
                                <form mehtod="post" id="import_visa">
                                    <label>Visa</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_visa" id="excel_visa">
                                    </div>
                                </form>
                                <div id="result_visa" style="padding-bottom: 20px;">
                                </div>
                            </div>
                            <div>
                                <form mehtod="post" id="import_feetl">
                                    <label>FEE TL</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_feetl" id="excel_feetl">
                                    </div>
                                </form>
                                <div id="result_feetl" style="padding-bottom: 20px;">
                                </div>
                            </div>
                            <div>
                                <form mehtod="post" id="import_menu">
                                    <label>Role Menu</label>
                                    <div class="form-group">
                                        <input type="file" name="excel_menu" id="excel_menu">
                                    </div>
                                </form>
                                <div id="result_menu" style="padding-bottom: 20px;">
                                </div>
                            </div>
                        <?php
                        }
                        ?>





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
    $(document).ready(function() {
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });
</script>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('#excel_rute').change(function() {
    //         $('#import_rute').submit();
    //     });
    //     $('#import_rute').on('submit', function(event) {
    //         event.preventDefault();
    //         $.ajax({
    //             url: "insert_rute.php",
    //             method: "POST",
    //             data: new FormData(this),
    //             contentType: false,
    //             processData: false,
    //             success: function(data) {
    //                 $('#result_rute').html(data);
    //                 $('#excel_rute').val('');
    //             }
    //         });
    //     });
    // });
    $(document).ready(function() {
        $('#excel_transport').change(function() {
            $('#import_transport').submit();
        });
        $('#import_transport').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "insert_transportnew.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_transport').html(data);
                    $('#excel_transport').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_tempat').change(function() {
            $('#import_tempat').submit();
        });
        $('#import_tempat').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "insert_tempat.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_tempat').html(data);
                    $('#excel_tempat').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_meal').change(function() {
            $('#import_meal').submit();
        });
        $('#import_meal').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "insert_meal.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_meal').html(data);
                    $('#excel_meal').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_gmeal').change(function() {
            $('#import_gmeal').submit();
        });
        $('#import_gmeal').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "insert_gmeal.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_gmeal').html(data);
                    $('#excel_gmeal').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_flight').change(function() {
            $('#import_flight').submit();
        });
        $('#import_flight').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "insert_flight.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_flight').html(data);
                    $('#excel_flight').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_LT').change(function() {
            $('#import_LT').submit();
        });
        $('#import_LT').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_LT.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_LT').html(data);
                    $('#excel_LT').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_agentLT').change(function() {
            $('#import_agentLT').submit();
        });
        $('#import_agentLT').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_agentLT.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_agentLT').html(data);
                    $('#excel_agentLT').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_tipsLT').change(function() {
            $('#import_tipsLT').submit();
        });
        $('#import_tipsLT').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_tipsLT.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_tipsLT').html(data);
                    $('#excel_tipsLT').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_TL').change(function() {
            $('#import_TL').submit();
        });
        $('#import_TL').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_TL.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_TL').html(data);
                    $('#excel_TL').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_include').change(function() {
            $('#import_include').submit();
        });
        $('#import_include').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_include.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_include').html(data);
                    $('#excel_include').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_tips').change(function() {
            $('#import_tips').submit();
        });
        $('#import_tips').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_tips.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_tips').html(data);
                    $('#excel_tips').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_ferry').change(function() {
            $('#import_ferry').submit();
        });
        $('#import_ferry').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_ferry.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_ferry').html(data);
                    $('#excel_ferry').val('');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#excel_visa').change(function() {
            $('#import_visa').submit();
        });
        $('#import_visa').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_visa.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_visa').html(data);
                    $('#excel_visa').val('');
                }
            });
        });
    });

    $(document).ready(function() {
        $('#excel_menu').change(function() {
            $('#import_menu').submit();
        });
        $('#import_menu').on('submit', function(event) {
            event.preventDefault();
            // alert("on");
            $.ajax({
                url: "insert_menu.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#result_menu').html(data);
                    $('#excel_menu').val('');
                }
            });
        });
    });

    // $(document).ready(function() {
    //     $('#excel_tlfee').change(function() {
    //         $('#import_tlfee').submit();
    //     });
    //     $('#import_tlfee').on('submit', function(event) {
    //         event.preventDefault();
    //         // alert("on");
    //         $.ajax({
    //             url: "insert_tlfee.php",
    //             method: "POST",
    //             data: new FormData(this),
    //             contentType: false,
    //             processData: false,
    //             success: function(data) {
    //                 $('#result_tlfee').html(data);
    //                 $('#excel_tlfee').val('');
    //             }
    //         });
    //     });
    // });
</script>