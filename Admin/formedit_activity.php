<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM cruise_activity WHERE id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

?>
<div class="content-wrapper">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FORM EDIT ACTIVITY</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" onclick="reloadcruise(2,<?php echo $row['pack_id'] ?>,0)" class="btn btn-default"><i class="fa fa-arrow-left"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="insertPricePackage.php">
                            <div class="card-body">
                                <!-- content disini -->
                                <div class="form-group">
                                    <label>DAY</label>
                                    <input type="text" class="form-control" name="day" id="day" value="<?php echo $row['day']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PORT OF CHARGERS</label>
                                    <input type="text" class="form-control" name="poc" id="poc" value="<?php echo $row['poc']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>ARRIVAL</label>
                                    <input type="text" class="form-control" name="arrival" id="arrival" value="<?php echo $row['arrival']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>DEPATURE</label>
                                    <input type="text" class="form-control" name="depature" id="depature" value="<?php echo $row['depature']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>ACTIVITY</label>
                                    <input type="text" class="form-control" name="activity" id="activity" value="<?php echo $row['activity']; ?>">
                                </div>
                                <input name="id" id="id" value="<?php echo $row['id']; ?>" type='hidden' >

                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="but_upload">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function(){
$("#but_upload").click(function(){
    var fd = new FormData();
    var a = $("input[name=id]").val();
    var b = $("input[name=day]").val();
    var c = $("input[name=poc]").val();
    var d = $("input[name=arrival]").val();
    var e = $("input[name=depature]").val();
    var f = $("input[name=activity]").val();

    fd.append('id',a);
    fd.append('day',b);
    fd.append('poc',c);
    fd.append('arrival',d);
    fd.append('depature',e);
    fd.append('activity',f);

    $.ajax({
        url: 'update_activity.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            // alert(response);
            reloadcruise(0,<?php echo $row['pack_id'] ?>,0);
        },
    });
});
});
</script>
        },
    });
});
});
</script>
