<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district_id = $_POST['district_id'];

    
    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district) 
            VALUES ('$title', '$first_name', '$middle_name', '$last_name', '$contact_no', '$district_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../customer.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>