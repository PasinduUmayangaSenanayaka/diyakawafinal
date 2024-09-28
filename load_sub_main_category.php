<?php
if (isset($_POST['mainCategoryId'])) {
    $mainCategoryId = $_POST['mainCategoryId'];

    include 'connection_db.php';

    // Prepare SQL query to fetch sub-main categories
    $sql = "SELECT sm_id, sub_categories FROM sub_main_ctegory WHERE main_id = ?";
    
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("i", $mainCategoryId);  // Bind the main category ID as an integer

        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Loop through the sub-main categories and create <option> elements
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['sm_id'] . '" data-category-name="' . htmlspecialchars($row['sub_categories']) . '">' . htmlspecialchars($row['sub_categories']) . '</option>';
            }
            
        } else {
            echo '<option value="">No sub-main categories found</option>';
        }

        $stmt->close();
    } else {
        echo '<option value="">Error fetching sub-main categories</option>';
    }

    $db->close();
}
?>
