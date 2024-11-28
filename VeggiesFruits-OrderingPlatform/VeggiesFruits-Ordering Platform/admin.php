<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$del_admin = "DELETE FROM admin";
$conn->query($del_admin);

$user_data_admin_sql = "INSERT INTO admin (name, quantity, price) 
                   SELECT name, quantity, price 
                   FROM user";

$user_data_admin = $conn->query($user_data_admin_sql);


// Fetch data from admin table
$adminQuery = "SELECT * FROM admin";
$adminResult = $conn->query($adminQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            min-height: 100vh;
            font-family: monospace;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(#60bf5d, #6786c3);
            margin: 2rem 0;
        }
        .row {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        table {
            font-size: 1.5rem;
        }
        i:hover {
            color: #fff;
        }
    </style>

</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <h1 class="text-center">Admin Orders</h1>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class = 'text-center'>Name</th>
                    <th class = 'text-center'>Quantity</th>
                    <th class = 'text-center'>Price (₹)</th>
                    <th class = 'text-center'>Order</th>
                    <th class = 'text-center'>Process</th>
                    <th class = 'text-center'>Placed</th>
                    <th class = 'text-center'>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($adminResult->num_rows > 0) {
                    while ($order = $adminResult->fetch_assoc()) {
                        $orderDisabled = $order['order'] == 1 ? "disabled" : "";
                        $processDisabled = $order['order'] == 1 && $order['process'] == 0 ? "" : "disabled";
                        $placedDisabled = $order['process'] == 1 && $order['placed'] == 0 ? "" : "disabled";
                        $status = ($order['order'] == 1 && $order['process'] == 1 && $order['placed'] == 1) ? "Success" : "Failure";

                        echo "
                        <tr>
                            <td>{$order['name']}</td>
                            <td class = 'text-center'>{$order['quantity']}</td>
                            <td class = 'text-center'>{$order['price']}</td>
                            <td class = 'text-center'>
                                <button class='btn btn-primary btn-sm order-btn' data-id='{$order['id']}' $orderDisabled>Order</button>
                            </td>
                            <td class = 'text-center'>
                                <button class='btn btn-warning btn-sm process-btn' data-id='{$order['id']}' $processDisabled>Process</button>
                            </td>
                            <td class = 'text-center'>
                                <button class='btn btn-success btn-sm placed-btn' data-id='{$order['id']}' $placedDisabled>Placed</button>
                            </td>
                            <td class = 'text-center'>$status</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No orders yet</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <a href="home_page_php_file.php"><div class="col-12 text-center"><i class="fa-solid fa-house" style="font-size: 1.5rem; border-radius: 50%; cursor: pointer;"></i></div></a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Handle 'Order' button click
            $(".order-btn").click(function () {
                let id = $(this).data("id");
                updateAdminTable(id, "order");
            });

            // Handle 'Process' button click
            $(".process-btn").click(function () {
                let id = $(this).data("id");
                updateAdminTable(id, "process");
            });

            // Handle 'Placed' button click
            $(".placed-btn").click(function () {
                let id = $(this).data("id");
                updateAdminTable(id, "placed");
            });

            // Function to update the admin table via AJAX
            function updateAdminTable(id, action) {
                $.ajax({
                    url: "update_admin.php",
                    method: "POST",
                    data: { id: id, action: action },
                    success: function (response) {
                        location.reload(); // Reload the page to reflect changes
                    }
                });
            }
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>