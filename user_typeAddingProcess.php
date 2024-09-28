<?php
require "connection_db.php";
// Check if form data is received via POST

if (!empty($_GET['user'])) {
    $user = $_GET['user'];
    $querySlidBarIcon = "SELECT * FROM `slidebar_icon`";
    $resultSlidBarIcon = $db->query($querySlidBarIcon);
    if ($resultSlidBarIcon) {

?>
        <div class="form-group row">
            <?php

            for ($i = 0; $i < $resultSlidBarIcon->num_rows; $i++) {

                $rowSlideBar = $resultSlidBarIcon->fetch_assoc();

                $iconid = $rowSlideBar['id'];

                $userqu = "SELECT * FROM `user_assing` WHERE user_type = $user AND icon_id = $iconid AND validate = 1";
                $userresult = $db->query($userqu);

            ?>
                <div class="col-6 col-md-3 col-lg-3">
                    <p class="mb-2"><?php echo $rowSlideBar['icon']; ?></p>
                    <label class="toggle-switch toggle-switch-info">
                        <?php
                        if ($userresult->num_rows != 0) {
                        ?>
                            <input onchange="changeUserEx('<?php echo $iconid; ?>','<?php echo $user; ?>')"  id="id<?php echo $iconid; ?>" value="<?php echo $rowSlideBar['id']; ?>"
                                type="checkbox" checked>
                        <?php
                        } else {
                        ?>
                            <input onchange="changeUserEx('<?php echo $iconid; ?>','<?php echo $user; ?>')" id="id<?php echo $iconid; ?>" value="<?php echo $rowSlideBar['id']; ?>"
                                type="checkbox">
                        <?php
                        }
                        ?>

                        <span class="toggle-slider round"></span>
                    </label>
                </div>
            <?php
            }

            ?>
        </div>

<?Php
    }
} else {
    echo "Plese select user for add user expirencess";
}

?>