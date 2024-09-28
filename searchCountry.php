<?php
require "connection_db.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$array = [];

if (empty($data["search"])) {

    $query = "SELECT * FROM country";
    $resultCountry = $db->query($query);
    if ($resultCountry) {
        $resultCountry1 = $db->query($queryCountry);

        $htmlContent = '';

        for ($i = 0; $i < $resultCountry1->num_rows; $i++) {
            $row = $resultCountry1->fetch_assoc();
            $htmlContent .= '<tr>';
            $htmlContent .= '<td>' . $row['code'] . '</td>';
            $htmlContent .= '<td>' . $row['country'] . '</td>';
            $htmlContent .= '<td><button class="btn btn-primary btn-sm" onclick="viewCountry(\'' . $row['id'] . '\')">View</button></td>';
            $htmlContent .= '</tr>';
        }
        $array["content"] = ['html' => $htmlContent];
        $array["success"] = true;
    }
} else {
    $search = $data["search"];

    $queryCountry = "SELECT * FROM country WHERE country LIKE '%" . $search . "%' OR code LIKE '%" . $search . "%'";
    $resultCountry = $db->query($queryCountry);
    if ($resultCountry) {
        if ($resultCountry->num_rows == 0) {
        } else {


            $resultCountry1 = $db->query($queryCountry);

            $htmlContent = '';

            for ($i = 0; $i < $resultCountry1->num_rows; $i++) {
                $row = $resultCountry1->fetch_assoc();
                $htmlContent .= '<tr>';
                $htmlContent .= '<td>' . $row['code'] . '</td>';
                $htmlContent .= '<td>' . $row['country'] . '</td>';
                $htmlContent .= '<td><button class="btn btn-primary btn-sm" onclick="viewCountry(\'' . $row['id'] . '\')">View</button></td>';
                $htmlContent .= '</tr>';
            }


            $array["content"] = ['html' => $htmlContent];
            $array["success"] = true;
        }
    }
}
// Send the HTML content as a JSON response
header('Content-Type: application/json');
echo json_encode($array);
