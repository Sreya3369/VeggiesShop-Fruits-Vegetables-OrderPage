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

// Fetch vegetables and fruits
$vegQuery = "SELECT name, price FROM veg";
$fruQuery = "SELECT name, price FROM fru";

$vegResult = $conn->query($vegQuery);
$fruResult = $conn->query($fruQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="home_page.css">
</head>
<body>
    <div class="container mt-4">
        <div class="header">
            <div class="row">
                <div class="col-3">
                    <div class="btn">
                        <a href="http://localhost/RESTARENT/admin.php"><i class="fa-solid fa-user-tie"></i></a>
                    </div>
                </div>
                <div class="col-6">
                    <input type="text" placeholder="Search for the product" style="font-family: monospace;">
                </div>
                <div class="col-3">
                    <div class="btn">
                        <a href="http://localhost/RESTARENT/update_cart.php"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="vegatable-container">
            <div class="container">
                <div class="row">
                    <div class="display-5">Vegetables</div>
                </div>
                <div class="row" style="width: 100%; margin: auto;">
                    <div class="row p-2" style="width: 100%; margin: auto; gap: 2rem;">
                        <?php while ($veg = $vegResult->fetch_assoc()) { ?>
                            <div class="card col-2">
                                <img class="card-img-top" src="IMAGES/tomato.jpg" alt="<?php echo $veg['name']; ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $veg['name']; ?></h5>
                                    <p class="card-text">₹ <?php echo $veg['price']; ?> /Kg</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="btn btn-danger btn-sm decrease" data-name="<?php echo $veg['name']; ?>">-</button>
                                        <span class="quantity" id="<?php echo $veg['name']; ?>_quantity">0</span>
                                        <button class="btn btn-success btn-sm increase" data-name="<?php echo $veg['name']; ?>">+</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="vegatable-container">
            <div class="container">
                <div class="row">
                    <div class="display-5">Fruits</div>
                </div>
                <div class="row" style="width: 100%; margin: auto;">
                    <div class="row p-2" style="width: 100%; margin: auto; gap: 2rem;">
                        <?php while ($fru = $fruResult->fetch_assoc()) { ?>
                            <div class="card col-2">
                                <img class="card-img-top" src="IMAGES/tomato.jpg" alt="<?php echo $fru['name']; ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $fru['name']; ?></h5>
                                    <p class="card-text">₹ <?php echo $fru['price']; ?> /Kg</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="btn btn-danger btn-sm decrease" data-name="<?php echo $fru['name']; ?>">-</button>
                                        <span class="quantity" id="<?php echo $fru['name']; ?>_quantity">0</span>
                                        <button class="btn btn-success btn-sm increase" data-name="<?php echo $fru['name']; ?>">+</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".increase").click(function () {
                let name = $(this).data("name");
                let quantityElem = $("#" + name + "_quantity");
                let quantity = parseInt(quantityElem.text()) + 1;
                quantityElem.text(quantity);

                updateCart(name, quantity);
            });

            $(".decrease").click(function () {
                let name = $(this).data("name");
                let quantityElem = $("#" + name + "_quantity");
                let quantity = parseInt(quantityElem.text());
                if (quantity > 0) {
                    quantity--;
                    quantityElem.text(quantity);
                    updateCart(name, quantity);
                }
            });

            function updateCart(name, quantity) {
                $.ajax({
                    url: "update_cart.php",
                    method: "POST",
                    data: { name: name, quantity: quantity },
                    success: function (response) {
                        console.log("Cart updated:", response);
                    }
                });
            }
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
