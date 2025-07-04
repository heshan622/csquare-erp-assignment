<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $item_code = $_POST['item_code'];
    $item_category_id = $_POST['item_category_id'];
    $item_subcategory_id = $_POST['item_subcategory_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    
    $sql = "INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price) 
            VALUES ('$item_code', '$item_category_id', '$item_subcategory_id', '$item_name', '$quantity', '$unit_price')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: ../item.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>