<?php
include "db=connection.php";
include "slug.php";
if ($_POST['id'] !== "") {
?>
    <div class="row" style="text-align: center;">
        <?php
        $query_upload2 =  "SELECT * FROM Upload_Drive2 where p_cons='1' && status='on' order by id ASC limit " . $_POST['id'];
        $rs_upload2 = mysqli_query($con, $query_upload2);
        // var_dump($query_upload2);
        while ($row_upload2 = mysqli_fetch_array($rs_upload2)) {
            if($row_upload2['thumbnail'] == "" or $row_upload2['thumbnail']==NULL){

                $link2 = $domain_web."img/performaa.PNG";
                $documents2 = "";
            }else{
                $link2 = $row_upload2['thumbnail'];
                $doc2 = $row_upload2['documents'];
                $headers2 = explode('/', $link2);
                $doc_header2 =  explode('/', $doc2);
                $thumbnail2 = $headers2[5];
                $doc_link2 = $doc_header2[5];
                $link2 = "https://drive.google.com/thumbnail?id=" . $thumbnail2;
                $documents2 = "https://drive.google.com/file/d/" . $doc_link2 . "/view";
            }
            
        ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style="padding: 10px;">
                <a href="<?php echo $documents2 ?>" target="_blank" style="text-decoration: none; color:black">
                    <div class="card card-promo">
                        <img src="<?php echo $link2 ?>" class="card-img-top img-promo">
                        <div class="card-body" style="padding: 5px;">
                            <p class="card-text" style="text-align: left; font-weight: bold;"><?php echo $row_upload2['judul'] ?></p>
                        </div>
                        <div class="card-footer" style="font-weight: bold;">
                            <?php echo "IDR " . number_format($row_upload2['price'], 0, ".", ".") ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>