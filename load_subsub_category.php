<?php
include 'connection_db.php'; // Your database connection file

if (isset($_POST['subMainId'])) {
    $subMainId = intval($_POST['subMainId']);

    $query = "SELECT sc2_id, sub_category2_name FROM sub_category2 WHERE sc1_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $subMainId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output each sub-category as an <option> tag
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['sc2_id'] . '">' . htmlspecialchars($row['sub_category2_name']) . '</option>';
        }
    } else {
        echo '<option value="">No sub-categories found</option>';
    }

    $stmt->close();
    $db->close();
}
?>
