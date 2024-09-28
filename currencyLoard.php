<?php

$query = "SELECT * FROM currency";
$result = $db->query($query);
$options = "";

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['id']}'>{$row['currencyName']}</option>";
    }
}


$queryep = "SELECT * FROM employee_data";
$resultep = $db->query($queryep);
$optionsep = "";

if ($resultep) {
    while ($rowep = $resultep->fetch_assoc()) {
        $optionsep .= "<option value='{$rowep['id']}'>{$rowep['first_name']}  {$rowep['last_name']}</option>";
    }
}

$querycountry = "SELECT * FROM country";
$resultcountry = $db->query($querycountry);
$optionscountry = "";

if ($resultcountry) {
    while ($rowcountry = $resultcountry->fetch_assoc()) {
        $optionscountry .= "<option value='{$rowcountry['id']}'>{$rowcountry['country']} </option>";
    }
}

$querycompany = "SELECT * FROM company";
$resultcompany = $db->query($querycompany);
$optionscompany = "";

if ($resultcompany) {
    while ($rowcompany = $resultcompany->fetch_assoc()) {
        $optionscompany .= "<option value='{$rowcompany['id']}'>{$rowcompany['company_name']} </option>";
    }
}

$queryvendor = "SELECT * FROM vendor";
$resultvendor = $db->query($queryvendor);
$optionsvendor = "";

if ($resultvendor) {
    while ($rowvendor = $resultvendor->fetch_assoc()) {
        $optionsvendor .= "<option value='{$rowvendor['id']}'>{$rowvendor['vender_name']}</option>";
    }
}


$queryproduct = "SELECT * FROM product";
$resultproduct = $db->query($queryproduct);
$optionsproduct = "";

if ($resultproduct) {
    while ($rowproduct = $resultproduct->fetch_assoc()) {
        $optionsproduct .= "<option value='{$rowproduct['id']}'>{$rowproduct['prduct_name']}</option>";
    }
}


$querypaymentMethod = "SELECT * FROM payment_method";
$resultpaymentMethod = $db->query($querypaymentMethod);
$optionspaymentMethod = "";

if ($resultpaymentMethod) {
    while ($rowpaymentMethod = $resultpaymentMethod->fetch_assoc()) {
        $optionspaymentMethod .= "<option value='{$rowpaymentMethod['id']}'>{$rowpaymentMethod['payment_method']}</option>";
    }
}


$querystatus = "SELECT * FROM status";
$resultstatus = $db->query($querystatus);
$optionsstatus = "";

if ($resultstatus) {
    while ($rowstatus = $resultstatus->fetch_assoc()) {
        $optionsstatus .= "<option value='{$rowstatus['id']}'>{$rowstatus['status']}</option>";
    }
}

