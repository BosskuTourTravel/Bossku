<?php
$data = explode(",", $_POST['id']);

// var_dump($data);
// spring = 0
// summer =1
// winter =2
// autumn=3
$querytmp2 = "SELECT * FROM  List_tempat_img where tmp_id='" . $data[0] . "'";
$rstmp2 = mysqli_query($con, $querytmp2);
$rowtmp2 = mysqli_fetch_array($rstmp2);
$p = $data[1];
if ($rowtmp2[$p] == "") {
?>
    <img src="https://www.2canholiday.com/Admin/images/image.png" width="100" height="100" alt="Card image cap">
<?php
} else {
    $link = $row_img[$p];
    $headers = explode('/', $link);
    $thumbnail = $headers[5];
?>
    <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="200px" alt="Card image cap">
<?php
}
?>