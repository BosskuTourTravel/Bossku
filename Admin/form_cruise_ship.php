<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

?>
<div class='content-wrapper'>
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body table-responsive p-0' style="padding: 20px !important;">
                    FORM INSERT CRUISE SHIP
                </div>
            </div>
            <div class="container" style="max-width: 760px; padding: 20px;">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Kapal</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="masukkan Nama Kapal">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">NOTES</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                            <div class='form-group'>
                                <label for='exampleInputFile'>Image Content</label>
                                <div class='input-group'>
                                    <div class='custom-file'>
                                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                                    </div>

                                </div>
                            </div>
                            <div class='form-group'>
                                <label for='header'>Image Header</label>
                                <div class='input-group'>
                                    <div class='custom-file'>
                                        <input name='header' id='header' accept='image/*' type='file' />
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id='but_upload'>CREATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#but_upload").click(function() {
        var fd = new FormData();
        var a = $("input[name=nama]").val();
        var b = $("textarea[name=notes]").val();
        var files = $('#fileToUpload')[0].files[0];
        var e = $('#header')[0].files[0];
        fd.append('fileToUpload', files);
        fd.append('name', a);
        fd.append('note', b);
        fd.append('header', e);
       
        $.ajax({
            url: 'Insert_cruise_ship.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == "success") {
                    alert(response);
                    reloadManual(11, 0, 0);
                } else {
                    alert(response);
                }
            },
        });
    });
</script>