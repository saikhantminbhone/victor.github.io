<!DOCTYPE html>
<html lang="en">

<head>
    <title>Victor Travel & Tour | Tour Info</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" property="og:title" content="Victor Travel & Tour">
    <meta name="Keywords"
        content="Tour, travel, south-east asia, Asia, vacation, beaches, packages, group travel, solo travel, travel plan">

    <!-- bootstrap css -->
    <link href="../assests/css/bootstrap.css" rel="stylesheet">
    <!-- custom-->
    <link href="../assests/css/style.css" rel="stylesheet">
</head>



<body>
    <?php include '../block/header.php'; ?>

    <?php
        include '../config/database.php';

        $tour = null;

        if (isset($_GET['page'])) {
            $tourId = $_GET['page'];
           // echo $tourId;
            $query = "SELECT * FROM tours WHERE id = '$tourId' ";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
           // print_r($result);
            $tour = mysqli_fetch_assoc($result);
        }
        ?>
    <div class="main container my-5">
        <?php if (!$tour): ?>
            <div class="alert alert-danger">Tour Not Found!</div>
        <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="tour-details">
                    <h1 class="color3"><?php echo $tour['title']; ?></h1>
                    <img src=".<?php echo $tour['image']; ?>" class="img-fluid rounded mb-4" alt="Tour Image">
                    <p class="text-muted"><?php echo $tour['description']; ?></p>

                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="color3">Safety Notes</h3>
                            <ul class="list-group mb-4">
                                <li class="list-group-item"><i class="fa fa-check icon"></i> Always carry your ID and travel insurance.</li>
                                <li class="list-group-item"><i class="fa fa-check icon"></i> Follow local COVID-19 guidelines.</li>
                                <li class="list-group-item"><i class="fa fa-check icon"></i> Wear comfortable shoes for walking tours.</li>
                                <li class="list-group-item"><i class="fa fa-check icon"></i> Stay hydrated and avoid street food if unsure.</li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <h3 class="color3">Things to Bring</h3>
                            <ul class="list-group mb-4">
                                <li class="list-group-item"><i class="fa fa-suitcase icon"></i> Passport & Visa Documents</li>
                                <li class="list-group-item"><i class="fa fa-tshirt icon"></i> Comfortable Clothing & Footwear</li>
                                <li class="list-group-item"><i class="fa fa-sun icon"></i> Sunscreen & Sunglasses</li>
                                <li class="list-group-item"><i class="fa fa-first-aid icon"></i> Personal Medications & First Aid Kit</li>
                                <li class="list-group-item"><i class="fa fa-camera icon"></i> Camera & Power Bank</li>
                                <li class="list-group-item"><i class="fa fa-money-bill-wave icon"></i> Local Currency Cash & Credit Card</li>
                            </ul>
                        </div>
                    </div>

                    <h3 class="color3">Where to Go</h3>
                    <ul id="location-list" class="list-group mb-4">
                        <?php
                            $locations = explode(',', $tour['locations']);
                            foreach ($locations as $location) {
                                echo "<li class='list-group-item'><i class='fa fa-map-marker-alt icon'></i> $location</li>";
                            }
                        ?>
                    </ul>

                    <a href="../checkout.php?id=<?php echo $tour['id']; ?>" class="btn btn-custom w-100">Book This Tour</a>
                </div>
            </div>

            <!-- Tour Sidebar -->
            <div class="col-lg-4 mt-3">
                <div class="tour-details">
                    <h3 class="color3">Tour Details</h3>
                    <p><i class="fa fa-clock icon"></i> <strong>Duration:</strong> <?php echo $tour['duration']; ?></p>
                    <p><i class="fa fa-dollar-sign icon"></i> <strong>Price:</strong> $<?php echo $tour['price']; ?> per person</p>
                    <p><i class="fa fa-car icon"></i> <strong>Best Time:</strong> <?php echo $tour['besttime']; ?></p>
                    <p><i class="fa fa-hotel icon"></i> <strong>Accommodation:</strong> Included in the package</p>
                    <p><i class="fa-solid fa-location-dot icon"></i> <strong>Hotel Pickup/Drop off:</strong> Included in the package</p>
                    <p><i class="fa fa-utensils icon"></i> <strong>Food & Drink:</strong> Budget: $10-20 - Mid-range: $30-50</p>
                    <p><i class="fa fa-users icon"></i> <strong>Private & Group Tours Available</strong></p>

                    <h3 class="color3">Contact for More Info</h3>
                    <p><i class="fa fa-phone icon"></i> +66 9123456789</p>
                    <p><i class="fa fa-envelope icon"></i> info@victor.com</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php include '../block/footer.php'; ?>

    <!-- JS and Bootstrap -->
    <script src="../assests/js/icon.js"></script>
    <script src="../assests/js/bootstrap.bundle.min.js"></script>
</body>


</html>