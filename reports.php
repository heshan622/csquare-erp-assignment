<?php
$report_headers = [];
$report_data = [];
$report_title = "Please select a report type.";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'php/db_connection.php';

    $report_type = $_POST['report_type'];

    
    if ($report_type == 'invoice_report' && !empty($_POST['start_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $report_title = "Invoice Report from $start_date to $end_date";
        $report_headers = ['Invoice Number', 'Date', 'Customer', 'District', 'Item Count', 'Amount'];
        $sql = "SELECT i.invoice_no, i.date, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, d.district, i.item_count, i.amount 
                FROM invoice AS i
                JOIN customer AS c ON i.customer = c.id
                JOIN district AS d ON c.district = d.id
                WHERE i.date BETWEEN '$start_date' AND '$end_date'";
    } 
    
    elseif ($report_type == 'invoice_item_report' && !empty($_POST['start_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $report_title = "Invoice Item Report from $start_date to $end_date";
        
        $report_headers = ['Invoice No', 'Date', 'Customer', 'Item Name', 'Unit Price', 'Amount'];
       
        $sql = "SELECT im.invoice_no, i.date, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, it.item_name, im.unit_price, im.amount
                FROM invoice_master AS im
                JOIN invoice AS i ON im.invoice_no = i.invoice_no
                JOIN customer AS c ON i.customer = c.id
                JOIN item AS it ON im.item_id = it.id
                WHERE i.date BETWEEN '$start_date' AND '$end_date'";
    } 
    
    elseif ($report_type == 'item_report') {
        $report_title = "Item Report (Grouped)";
        $report_headers = ['Item Name', 'Item Category', 'Item Subcategory', 'Total Quantity Sold'];
        $sql = "SELECT it.item_name, c.category, sc.sub_category, SUM(im.quantity) as total_sold
                FROM invoice_master as im
                JOIN item as it ON im.item_id = it.id
                JOIN item_category as c ON it.item_category = c.id
                JOIN item_subcategory as sc ON it.item_subcategory = sc.id
                GROUP BY it.item_name, c.category, sc.sub_category
                ORDER BY it.item_name";
    }

    if (isset($sql)) {
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $report_data[] = $row;
            }
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3"> &larr; Back to Home</a>
        <h2>Reports</h2>

        <form action="reports.php" method="POST" class="mb-5 p-4 border rounded">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <p class="mb-1">Select a report to generate:</p>
                    <div class="btn-group">
                        <button type="submit" name="report_type" value="invoice_report" class="btn btn-primary">Invoice</button>
                        <button type="submit" name="report_type" value="invoice_item_report" class="btn btn-primary">Invoice Item</button>
                        <button type="submit" name="report_type" value="item_report" class="btn btn-secondary">Item</button>
                    </div>
                </div>
            </div>
            <small class="form-text text-muted">Date range is required for Invoice reports.</small>
        </form>

        <hr>

        <h3><?php echo $report_title; ?></h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <?php foreach ($report_headers as $header) { echo "<th>$header</th>"; } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($report_data) && $_SERVER["REQUEST_METHOD"] == "POST") {
                    echo "<tr><td colspan='" . count($report_headers) . "' class='text-center'>No data found.</td></tr>";
                } else {
                    foreach ($report_data as $row) {
                        echo "<tr>";
                        foreach ($row as $cell) {
                            echo "<td>$cell</td>";
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>