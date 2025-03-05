<?php
if (isset($_POST['cd'])) {
    $ad = $_POST['cd'];
    for ($t = 0; $t < $ad; $t++) {
?>
        <tr>
            <th>Adults :</th>
            <th></th>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Cabin</td>
            <td>9000</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Depature Tax</td>
            <td>800000</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Port Charger</td>
            <td>800000</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">Service</td>
            <td>800000</td>
        </tr>
<?php
    }
}
?>