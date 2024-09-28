<?php
require_once "connection_db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Water Sports Daily Expenses Sheet | Diyakawa</title>

    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />

    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="images/logo.png">
</head>

<body onload="">
    <div class="container-scroller">

        <?php require "header.php"; ?>
        <?php require "nav_bar.php"; ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">


                                                <h4 class="card-title">Summery Sheet</h4>



                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">

                                                <p class="card-description">

                                                </p>
                                                <div class="table-responsive">

                                                    <table class="table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <!-- <th>serial No</th> -->
                                                                <th>Date</th>
                                                                <th>Total Sales</th>
                                                                <th>Total Expereance</th>
                                                                <th>Profit</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="iteamListingTableBody">



                                                            <?php



                                                            ?>
                                                            <!-- <td>
                                                                    <input readonly name="operetervalue" onkeyup="" id="operetervalue" class="form-control inpuFieldsBorders" type="text" />
                                                                </td> -->

                                                            <?php

                                                            $query = "SELECT DISTINCT date_billing FROM billing_tb ORDER BY date_billing";
                                                            $result = $db->query($query);

                                                            if ($result) {

                                                                $uniqueDates = [];
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $uniqueDates[] = $row['date_billing'];
                                                                }

                                                                foreach ($uniqueDates as $date) {

                                                                    $query1 = "
                                                                      SELECT pl.qty, pl.rate, pl.discount
                                                                      FROM billing_tb b
                                                                      INNER JOIN product_listing pl ON b.job_no = pl.job_no
                                                                      WHERE b.date_billing = $date;
                                                                  ";

                                                                    $result1 = $db->query($query1);

                                                                    if ($result1) {
                                                                        $total = 0;

                                                                        if ($result1->num_rows > 0) {

                                                                            while ($rowp = $result1->fetch_assoc()) {
                                                                                $qty = $rowp['qty'];
                                                                                $rate = $rowp['rate'];
                                                                                $discount = $rowp['discount'];

                                                                                $value = $qty * $rate;
                                                                                $total += ($value - ($value * $discount / 100));
                                                                            }

                                                                            echo $total;
                                                                        } else {
                                                                           
                                                                            $query1 = "
                                                                                SELECT pl.qty, pl.rate, pl.discount
                                                                                FROM billing_tb b
                                                                                INNER JOIN product_listing pl ON b.job_no = pl.job_no
                                                                                WHERE b.date_billing = '$date';"; 

                                                                            $result1 = $db->query($query1);

                                                                            if ($result1) {
                                                                                $total = 0;

                                                                                if ($result1->num_rows > 0) {
                                                                                    while ($rowp = $result1->fetch_assoc()) {
                                                                                        $qty = $rowp['qty'];
                                                                                        $rate = $rowp['rate'];
                                                                                        $discount = $rowp['discount'];

                                                                                        $value = $qty * $rate;
                                                                                        $total += ($value - ($value * $discount / 100));
                                                                                    }

                                                                                }
                                                                            } else {
                                                                                echo "Error executing query: " . $db->error . "<br>";
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo "Error executing query: " . $db->error;
                                                                    }
                                                            ?> <tr>
                                                                        <td>
                                                                            <input value="<?php echo $date; ?>" readonly name="operetervalue" onkeyup="" id="operetervalue" class="form-control inpuFieldsBorders" type="date" />
                                                                        </td>

                                                                        <td>
                                                                            <input value="<?php echo $total?>" readonly name="operetervalue" onkeyup="" id="operetervalue" class="form-control inpuFieldsBorders" type="text" />
                                                                        </td>

                                                                        <td>
                                                                            <input readonly name="driveramount" id="driveramount" class="form-control inpuFieldsBorders" type="text" />
                                                                        </td>
                                                                        <td>
                                                                            <input readonly id="total" disabled class="form-control inpuFieldsBorders" type="text" />
                                                                        </td>
                                                                        <td><i onclick="deleteRow(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>
                                                                    </tr>
                                                            <?php

                                                                }
                                                            } else {
                                                                echo "Error executing query: " . $conn->error;
                                                            }

                                                            ?>







                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <br>
                                                    <br><br>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addRowVenderCommission() {
            const newRow = `

                                                                                

                            `;

            document
                .getElementById("iteamVenderTableBody")
                .insertAdjacentHTML("beforeend", newRow);
        }
    </script>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="js/commission.js"></script>
</body>

</html>