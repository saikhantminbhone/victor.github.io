<!DOCTYPE html>
<html lang="en">

<head>
    <title>Victor Travel & Tour | checkout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" property="og:title" content="Victor Travel & Tour">
    <meta name="Keywords"
        content="Tour, travel, south-east asia, Aisa, vacation, beaches, packages, group travel, solo travel, travel plan">

    <!-- bootstrap css -->
    <link href="./assests/css/bootstrap.css" rel="stylesheet">
    <!-- custom-->
    <link href="./assests/css/style.css" rel="stylesheet">

    <script async src="https://js.stripe.com/v3/buy-button.js">
    </script>
</head>

<body>
<?php include './block/header.php';?>

<?php
include './config/database.php';
session_start();

$tour_id = $_GET['id'] ?? null;

if (!$tour_id) {
    echo "<h2 class='text-danger text-center'>Invalid tour ID.</h2>";
    exit;
}

$tour_stmt = $conn->prepare("SELECT * FROM tours WHERE id = ?");
$tour_stmt->bind_param("i", $tour_id);
$tour_stmt->execute();
$tour_result = $tour_stmt->get_result();

if ($tour_result->num_rows == 0) {
    echo "<h2 class='text-danger text-center'>Tour Not Found!</h2>";
    exit;
}
$tour = $tour_result->fetch_assoc();
?>

<div class="main">
    <div class="container py-5">
    <?php
                    session_start();
                    // print_r($_SESSION['user_id']);
                    if (isset($_SESSION['booking_success'])) {
                        echo '<div class="alert alert-success text-center">'.$_SESSION['booking_success'].'</div>';
                        unset($_SESSION['booking_success']); 
                    }

                    if (isset($_SESSION['booking_error'])) {
                        echo '<div class="alert alert-danger text-center">'.$_SESSION['booking_error'].'</div>';
                        unset($_SESSION['booking_error']); 
                    }
                    ?>


        <div class="checkout-container">
            <h2 class="mb-4 text-center color3">Checkout</h2>
            <div class="row">
                <!-- Billing Form -->
                <div class="col-md-6">
                    <h4 class="color3">Billing Details</h4>
                    <form method="POST" action="./action/checkout_action.php">
                        <input type="hidden" name="tour_id" value="<?= $tour_id ?>">
                        <input type="hidden" name="amount" value="<?= $tour['price']  ?>"> <!-- with service -->

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <button class="btn btn-custom w-100" type="submit">Proceed to Book</button>
                    </form>
                </div>

                <!-- Summary -->
                <div class="col-md-6">
                    <h4 class="color3">Order Summary</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= htmlspecialchars($tour['title']) ?></span>
                            <strong>$<?= $tour['price'] ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Additional Services</span>
                            <strong>$0</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>$<?= $tour['price'] ?></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php include './block/footer.php';?>
    <!-- for icon -->
    <script src="./assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="./assests/js/bootstrap.bundle.min.js"></script>
    <!-- tour array -->
    <script src="./tour.js"></script>

    
</body>

</html>