<!DOCTYPE html>
<html>
<head>
    <title>Customer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3"> &larr; Back to Home</a>
        <h2>Register Customer</h2>

        <form action="php/new_customer_handler.php" method="POST" class="mb-5">
            <div class="mb-2">
                <label>Title</label>
                <select name="title" class="form-select" required>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                </select>
            </div>
            <div class="mb-2">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
             <div class="mb-2">
                <label>Middle Name</label>
                <input type="text" name="middle_name" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Contact Number</label>
                <input type="text" name="contact_no" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>District</label>
                <select name="district_id" class="form-select" required>
                    <option value="">Select a District</option>
                    <?php
                        
                        include 'php/db_connection.php';
                        $sql = "SELECT id, district FROM district WHERE active = 'yes'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['district'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Register Customer</button>
        </form>

        <hr>

        <h2>Customer List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Contact No.</th>
                    <th>District</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                include 'php/db_connection.php';
                $sql = "SELECT customer.id, customer.title, customer.first_name, customer.last_name, customer.contact_no, district.district 
                        FROM customer 
                        JOIN district ON customer.district = district.id";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["title"] . ". " . $row["first_name"] . " " . $row["last_name"] . "</td>";
                    echo "<td>" . $row["contact_no"] . "</td>";
                    echo "<td>" . $row["district"] . "</td>";
                    echo "</tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>