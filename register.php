<!DOCTYPE html>
<html lang="en">

<head>
    <title>Victor Travel & Tour | Home</title>
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
        <h2 class="text-center mb-4 color3">Register</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- this is to show user error if register is unsuccessful -->
                <?php
                    session_start();
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success text-center">'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']); 
                    }

                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger text-center">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']); 
                    }
                    ?>
            <form method="POST" action="./action/user_action.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Please Enter Your Full Name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Please Enter Your email address" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Please Enter Your Phone Number" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Register</button>
                </div>
                <input type="hidden" name="register">

                <div class="text-center mt-3">
                    <p class="mt-2">Already have an account?
                        <a href="./login.php" class="text-decoration-none text-success fw-semibold">Sign in</a>
                    </p>
                </div>
                </form>

            </div>
        </div>
    </div>


<!-- for icon -->
<script src="./assests/js/icon.js"></script>
<!-- bootstrap js -->
<script src="./assests/js/bootstrap.bundle.min.js"></script>
</body>
</html>