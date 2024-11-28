<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $quantity = intval($_POST["quantity"]);

    // Fetch the price of the item
    $priceQuery = "SELECT price FROM veg WHERE name='$name' UNION SELECT price FROM fru WHERE name='$name'";
    $priceResult = $conn->query($priceQuery);

    if ($priceResult->num_rows > 0) {
        $price = $priceResult->fetch_assoc()["price"];
        $totalPrice = $quantity * $price;

        // Update or insert into user table
        $checkQuery = "SELECT * FROM user WHERE name='$name'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            // Update existing record
            $updateQuery = "UPDATE user SET quantity=$quantity, price=$totalPrice WHERE name='$name'";
            $conn->query($updateQuery);
        } else {
            // Insert new record
            $insertQuery = "INSERT INTO user (name, quantity, price) VALUES ('$name', $quantity, $totalPrice)";
            $conn->query($insertQuery);
        }

        echo "Cart updated successfully.";
    } else {
        echo "Item not found.";
    }
}
$dis = "select * from user";
$dis_row = $conn->query($dis);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
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
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <h1 class="text-center">Your Cart</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($cart = $dis_row->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$cart['id']}</td>
                            <td>{$cart['name']}</td>
                            <td>{$cart['quantity']}</td>
                            <td>{$cart['price']}</td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>

        <form method="POST" action="admin.php">
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success"><a href="http://localhost/RESTARENT/home_page_php_file.php" style="text-decoration: none; color: #fff; font-size: 1.2rem;">Buy</a></button>
                <button type="submit" class="btn btn-success"><a href="http://localhost/RESTARENT/home_page_php_file.php" style="text-decoration: none; color: #fff; font-size: 1.2rem;">Add Items</a></button>
            </div>
        </form>
    </div>
</div>
</body>
</html>