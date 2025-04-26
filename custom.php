<!DOCTYPE html>
<html lang="en">

<head>
    <title>Victor Travel & Tour | Custom Tour</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" property="og:title" content="Victor Travel & Tour">
    <meta name="Keywords"
        content="Tour, travel, south-east asia, Aisa, vacation, beaches, packages, group travel, solo travel, travel plan">


    <!-- bootstrap css -->
    <link href="./assests/css/bootstrap.css" rel="stylesheet">
    <!-- custom-->
    <link href="./assests/css/style.css" rel="stylesheet">
</head>

<body>
<?php include './block/header.php';?>
    <div class="main container my-5">
        <h2 class="text-center mb-4 color3">Customize Your Tour</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">
            <?php
                    session_start();
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success text-center">'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']); 
                    }else{
          ?>


      <form method="POST" action="./action/user_action.php">
      <div class="mb-3">
    <label for="destination" class="form-label">Select Your Destination</label>
    <?php
        include './config/database.php';

        // Fetch destinations from tours table
        $tour_query = "SELECT id, name FROM tours ORDER BY name ASC";
        $tour_result = mysqli_query($conn, $tour_query);
        ?>

        <select class="form-select" name="destination" id="destination" onchange="toggleCustomDestination()" required>
        <option selected disabled>Choose a destination</option>

            <?php while($tour = mysqli_fetch_assoc($tour_result)): ?>
                <option value="<?= htmlspecialchars($tour['name']) ?>">
                    <?= htmlspecialchars($tour['name']) ?>
                </option>
            <?php endwhile; ?>

            <option value="Other">Other (Specify)</option>
        </select>
    </div>

    <div class="mb-3" id="customDestinationDiv" style="display: none;">
    <label for="customDestination" class="form-label">Enter Destination</label>
    <input type="text" name="custom_destination" class="form-control" id="customDestination" placeholder="Enter your destination">
</div>



    <div class="mb-3">
        <label for="duration" class="form-label">Tour Duration</label>
        <input type="number" name="duration" class="form-control" id="duration" placeholder="Number of days" required>
    </div>

    <div class="mb-3">
        <label for="groupSize" class="form-label">Group Size</label>
        <input type="number" name="group_size" class="form-control" id="groupSize" placeholder="Number of people" required>
    </div>

    <div class="mb-3">
        <label for="travelDate" class="form-label">Travel Date</label>
        <input type="date" name="travel_date" class="form-control" id="travelDate" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Additional Services</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="services[]" value="Airport Pickup" id="airportPickup">
            <label class="form-check-label" for="airportPickup">Airport Pickup</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="services[]" value="Hotel Booking" id="hotelBooking">
            <label class="form-check-label" for="hotelBooking">Hotel Booking</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="services[]" value="Guided Tour" id="guidedTour">
            <label class="form-check-label" for="guidedTour">Guided Tour</label>
        </div>
        <div class="mt-2">
            <input type="text" class="form-control" name="services[]" id="otherServiceInput" placeholder="Other (Specify)">
        </div>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-custom">Submit Request</button>
    </div>
</form>

<?php } ?>


            </div>
        </div>
    </div>



    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center p-4 shadow-sm rounded custom-banner">
                <h4 class="fw-bold color3">Free cancellation</h4>
                <p class="mt-2">You'll receive a full refund if you cancel at least 24 hours in advance of most
                    experiences.
                </p>
            </div>
        </div>
    </div>



    <!-- for icon -->
    <script src="./assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="./assests/js/bootstrap.bundle.min.js"></script>
    <script>
        //js for if customer choose others then the input box will display for user that will asllow user to input
        function toggleCustomDestination() {
            let destinationSelect = document.getElementById("destination");
            let customDestinationDiv = document.getElementById("customDestinationDiv");
            let customDestinationInput = document.getElementById("customDestination");

            if (destinationSelect.value === "Other") {
                customDestinationDiv.style.display = "block";
                customDestinationInput.required = true;
            } else {
                customDestinationDiv.style.display = "none";
                customDestinationInput.required = false;
            }
        }
    </script>

</body>

</html>