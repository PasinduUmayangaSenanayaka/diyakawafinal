<?php
require "connection_db.php";
if (isset($_POST)) {

    $currency = $_POST['currency'];



?>
    <td>
        <Select class="form-control card-title">
            <option value="${currencyRateSelect}">${currencyName}</option>
            <?php

            $queryCategory = "SELECT * FROM currency";
            $resultCategory = $db->query($queryCategory);
            if ($resultCategory) {
                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                    $row = $resultCategory->fetch_assoc();
                    if ($row['id'] == $currency) {
            ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['currencyName']; ?></option>
                    <?php
                    }
                }
                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                    $row = $resultCategory->fetch_assoc();
                    if ($row['id'] != $currency) {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['currencyName']; ?></option>
            <?php
                    }
                }
            } else {
                echo "Error: " . $db->error;
            }

            ?>

        </Select>
    </td>

<?php
}
?>