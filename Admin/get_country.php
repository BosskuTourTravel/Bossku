<?php
include "../site.php";
include "../db=connection.php";

if (isset($_POST['continent'])) {
    $continent = $_POST["continent"];

    $sql = "select * from country where continent=$continent";
    $hasil = mysqli_query($con, $sql);
    while ($data = mysqli_fetch_array($hasil)) {
        ?>
        <option value="<?php echo  $data['id']; ?>"><?php echo $data['name']; ?></option>
        <?php
    }
}
if (isset($_POST['country'])) {
    $country = $_POST["country"];

    $sql = "select * from city where country=$country";
    $hasil = mysqli_query($con, $sql);
    while ($data = mysqli_fetch_array($hasil)) {
        ?>
        <option value="<?php echo  $data['id']; ?>"><?php echo $data['name']; ?></option>
        <?php
    }
}

?>