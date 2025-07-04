<?php
header('Content-Type: application/json');
include 'db_connection.php';

$categoryId = $_GET['category_id'];

$subcategories = [];

if ($categoryId) {
    
    $sql = "SELECT id, sub_category_name FROM item_sub_categories WHERE category_id = $categoryId";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $subcategories[] = $row;
    }
}

$conn->close();


echo json_encode($subcategories);
?>