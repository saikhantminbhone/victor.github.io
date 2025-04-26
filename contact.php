<!DOCTYPE html>
<html lang="en">

<head>
    <title>Victor Travel & Tour | contact</title>
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
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-section">
                    <h2 class="color3 mb-4">Get in Touch</h2>
                    <?php
                    session_start();
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success text-center">'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']); 
                    }else{
          ?>
                    <form method="post" action="./action/user_action.php">
                        <div class="mb-3">
                            <label class="form-label color2">Your Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label color2">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label color2">Message</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Write your message" required></textarea>
                        </div>
                        <button type="submit" name="send_message" class="btn btn-custom w-100">Send Message</button>
                    </form>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="contact-section">
                    <h2 class="color3 mb-4">Contact Information</h2>
                    <p class="contact-info"><i class="fa fa-map-marker-alt"></i> 123 Street, Bangkok, Thailand</p>
                    <p class="contact-info"><i class="fa fa-phone"></i> +66 9123456789</p>
                    <p class="contact-info"><i class="fa fa-envelope"></i> <a class="text-decoration-none"
                            href="mailto:info@victor.com">info@victor.com</a></p>
                    <p class="contact-info"><i class="fa fa-clock"></i> Mon - Fri: 9:00 AM - 6:00 PM</p>
                    <h5 class="color3 mt-4">Follow Us</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
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
</body>

</html>