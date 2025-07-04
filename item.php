<!DOCTYPE html>
<html>
<head>
    <title>Item Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3"> &larr; Back to Home</a>
        <h2>Register Item</h2>

        <form action="php/new_item_handler.php" method="POST" class="mb-5">
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Item Code</label>
                    <input type="text" name="item_code" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Item Name</label>
                    <input type="text" name="item_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Item Category</label>
                    <select name="item_category_id" class="form-select" required>
                        <option value="">Select a Category</option>
                        <?php
                            include 'php/db_connection.php';
                            $sql = "SELECT id, category FROM item_category";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Item Sub Category</label>
                    <select name="item_subcategory_id" class="form-select" required>
                        <option value="">Select a Sub Category</option>
                         <?php
                            include 'php/db_connection.php';
                            $sql = "SELECT id, sub_category FROM item_subcategory";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['sub_category'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                 <div class="col-md-6">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Unit Price</label>
                    <input type="text" name="unit_price" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Register Item</button>
        </form>

        <hr>

        <h2>Item List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                include 'php/db_connection.php';
                $sql = "SELECT item.item_code, item.item_name, item_category.category, item_subcategory.sub_category, item.quantity, item.unit_price 
                        FROM item
                        JOIN item_category ON item.item_category = item_category.id
                        JOIN item_subcategory ON item.item_subcategory = item_subcategory.id";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["item_code"] . "</td>";
                    echo "<td>" . $row["item_name"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>" . $row["sub_category"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["unit_price"] . "</td>";
                    echo "</tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>