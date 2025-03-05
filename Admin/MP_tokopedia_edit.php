<?php
include "../db=connection.php";
include "Api_paket_tour.php";
session_start();
$id = explode(",", $_POST['id']);
?>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">EDIT Tokopedia Package </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="MP_Package(2,'<?php echo $_POST['z'] ?>',0)" title="Back" style="margin: 2px;"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="MP_Package(3,'<?php echo $_POST['id'] ?>',<?php echo $_POST['z'] ?>)" title="Reload" style="margin: 2px;"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div style="padding: 20px 40px; width: max-content;">
                        <?php
                        foreach ($id as $val) {
                            $query = "SELECT * FROM Upload_tokopedia where id=" . $val;
                            $rs = mysqli_query($con, $query);
                            $row = mysqli_fetch_array($rs);
                            // var_dump($query);
                        ?>
                            <div class="row g-3">
                                <div class="col">
                                    <label for="">Nama Produk</label>
                                    <input type="text" class="form-control" id="produk_name<?php echo $row['id'] ?>" value="<?php echo $row['produk_name'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Kategori</label>
                                    <input type="text" class="form-control" id="kategori<?php echo $row['id'] ?>" value="<?php echo $row['kategori'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">berat</label>
                                    <input type="text" class="form-control" id="berat<?php echo $row['id'] ?>" value="<?php echo $row['berat'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Min Pembelian</label>
                                    <input type="text" class="form-control" id="min_pembelian<?php echo $row['id'] ?>" value="<?php echo $row['min_pembelian'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Etalase</label>
                                    <input type="text" class="form-control" id="etalase<?php echo $row['id'] ?>" value="<?php echo $row['etalase'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Preorder</label>
                                    <input type="text" class="form-control" id="preorder<?php echo $row['id'] ?>" value="<?php echo $row['preorder'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Kondisi</label>
                                    <input type="text" class="form-control" id="kondisi<?php echo $row['id'] ?>" value="<?php echo $row['kondisi'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Print Flayer</label>
                                    <form action="../Data_promo/landtour_master_tokped.php?id=<?php echo $row['copy_id'] ?>&grub_id=<?php echo $row['grub_id'] ?>&sfee_id=<?php echo $row['sfee_id'] ?>" method="post" target="_blank">
                                        <?php
                                        $query_sfee_tgl = "SELECT tgl FROM LTP_tgl_sfee where sfee_id='" . $row['sfee_id'] . "' order by tgl ASC limit 1";
                                        $rs_sfee_tgl = mysqli_query($con, $query_sfee_tgl);
                                        $row_sfee_tgl = mysqli_fetch_array($rs_sfee_tgl);
                                        
                                        ?>
                                        <input type="hidden"  id="tgl_ber" name="tgl_ber" value="<?php echo $row_sfee_tgl['tgl'] ?>">
                                        <button type="submit" class="btn btn-success">Print Flayer</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <label for="">Img1</label>
                                    <input type="text" class="form-control" id="img1<?php echo $row['id'] ?>" value="<?php echo $row['img1'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Img2</label>
                                    <input type="text" class="form-control" id="img2<?php echo $row['id'] ?>" value="<?php echo $row['img2'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Img3</label>
                                    <input type="text" class="form-control" id="img3<?php echo $row['id'] ?>" value="<?php echo $row['img3'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Img4</label>
                                    <input type="text" class="form-control" id="img4<?php echo $row['id'] ?>" value="<?php echo $row['img4'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Img5</label>
                                    <input type="text" class="form-control" id="img5<?php echo $row['id'] ?>" value="<?php echo $row['img5'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Vid1</label>
                                    <input type="text" class="form-control" id="vid1<?php echo $row['id'] ?>" value="<?php echo $row['vid1'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Vid2</label>
                                    <input type="text" class="form-control" id="vid2<?php echo $row['id'] ?>" value="<?php echo $row['vid2'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Vid3</label>
                                    <input type="text" class="form-control" id="vid3<?php echo $row['id'] ?>" value="<?php echo $row['vid3'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">SKU</label>
                                    <input type="text" class="form-control" id="sku<?php echo $row['id'] ?>" value="<?php echo $row['sku'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Status</label>
                                    <input type="text" class="form-control" id="status<?php echo $row['id'] ?>" value="<?php echo $row['status'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Stok</label>
                                    <input type="text" class="form-control" id="stok<?php echo $row['id'] ?>" value="<?php echo $row['stok'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Harga</label>
                                    <input type="text" class="form-control" id="harga<?php echo $row['id'] ?>" value="<?php echo $row['Harga'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Kurir</label>
                                    <input type="text" class="form-control" id="kurir<?php echo $row['id'] ?>" value="<?php echo $row['kurir'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Asuransi</label>
                                    <input type="text" class="form-control" id="asuransi<?php echo $row['id'] ?>" value="<?php echo $row['asuransi'] ?>">
                                </div>
                                <div class="col">
                                    <label for="">Varian</label>
                                    <input type="text" class="form-control" id="varian<?php echo $row['id'] ?>" value="<?php echo $row['varian'] ?>">
                                </div>
                            </div>
                            <div style="max-width: 1200px; padding: 10px;">
                                <label for="">Deskripsi</label>
                                <textarea class="summernote" id="ket<?php echo $row['id'] ?>"><?php echo $row['deskripsi'] ?></textarea>
                            </div>
                        <?php
                        }
                        ?>
                        <div>
                            <button type="button" class="btn btn-warning" style="width: 160px;" onclick="edit('<?php echo $_POST['id'] ?>')">EDIT</button>
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
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });


    function edit(x) {
        let formData = new FormData();
        const arr = x.split(",");
        for (let i = 0; i < arr.length; ++i) {
            var e = arr[i];
            var produk_name = document.getElementById("produk_name" + e).value;
            var desc = document.getElementById("ket" + e).value;
            var kategori = document.getElementById("kategori" + e).value;
            var berat = document.getElementById("berat" + e).value;
            var min_pembelian = document.getElementById("min_pembelian" + e).value;
            var etalase = document.getElementById("etalase" + e).value;
            var preorder = document.getElementById("preorder" + e).value;
            var kondisi = document.getElementById("kondisi" + e).value;
            var img1 = document.getElementById("img1" + e).value;
            var img2 = document.getElementById("img2" + e).value;
            var img3 = document.getElementById("img3" + e).value;
            var img4 = document.getElementById("img4" + e).value;
            var img5 = document.getElementById("img5" + e).value;
            var vid1 = document.getElementById("vid1" + e).value;
            var vid2 = document.getElementById("vid2" + e).value;
            var vid3 = document.getElementById("vid3" + e).value;
            var sku = document.getElementById("sku" + e).value;
            var status = document.getElementById("status" + e).value;
            var stok = document.getElementById("stok" + e).value;
            var harga = document.getElementById("harga" + e).value;
            var kurir = document.getElementById("kurir" + e).value;
            var asuransi = document.getElementById("asuransi" + e).value;
            var varian = document.getElementById("varian" + e).value;

            formData.append("produk_name[]", produk_name);
            formData.append("deskripsi[]", desc);
            formData.append("kategori[]", kategori);
            formData.append("berat[]", berat);
            formData.append("min_pembelian[]", min_pembelian);
            formData.append("etalase[]", etalase);
            formData.append("preorder[]", preorder);
            formData.append("kondisi[]", kondisi);
            formData.append("img1[]", img1);
            formData.append("img2[]", img2);
            formData.append("img3[]", img3);
            formData.append("img4[]", img4);
            formData.append("img5[]", img5);
            formData.append("vid1[]", vid1);
            formData.append("vid2[]", vid2);
            formData.append("vid3[]", vid3);
            formData.append("sku[]", sku);
            formData.append("status[]", status);
            formData.append("stok[]", stok);
            formData.append("harga[]", harga);
            formData.append("kurir[]", kurir);
            formData.append("asuransi[]", asuransi);
            formData.append("varian[]", varian);

        }
        formData.append("id", arr);

        $.ajax({
            type: 'POST',
            url: "MP_tokopedia_edit_list.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                alert(data);
            }
        });

    }
</script>