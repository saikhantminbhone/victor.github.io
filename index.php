
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

    <div class="main">
        <div class="h-search-form text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <form action="search.php" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control" placeholder="Search..">
                                <button class="btn" type="submit"><i class="fa-solid fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- why book with us banner -->
        <div class="container">
            <h3 class="why-title">Why book with Victor?</h3>
            <div class="row g-4 align-items-center text-center">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <i class="fa-solid fa-phone-volume h2" style="color:rgb(247, 127, 147)"></i>
                    <h5>24/7 customer support</h5>
                    <p>No matter the time zone, we’re here to help.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <i class="fa-solid fa-gift color3 h2"></i>
                    <h5>Earn rewards</h5>
                    <p>Explore, earn, redeem, and repeat with our loyalty program.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <i class="fa-solid fa-star h2" style="color:#FED141"></i>
                    <h5>Millions of reviews</h5>
                    <p>Plan and book with confidence using reviews from fellow travelers.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <i class="fa-solid fa-calendar h3" style="color:#008768"></i>
                    <h5>Plan your way</h5>
                    <p>Stay flexible with free cancellation and the option to reserve now and pay later at no additional
                        cost.</p>
                </div>
            </div>
        </div>

        <!-- login banner -->
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 text-center p-4 shadow-sm rounded login-banner">
                    <h4 class="fw-bold color3">Log in to manage bookings &amp; Victor Rewards</h4>
                    <p class="mt-2">Don't have an account yet?
                        <a href="./register.php" class="text-decoration-none text-success fw-semibold">Sign up</a>
                    </p>
                    <a href="./login.php" class="btn btn-dark btn-lg w-20 mt-3">Log in</a>
                </div>
            </div>
        </div>

        <!-- line breaker -->
        <div class="container my-4">
            <div class="position-relative text-center">
                <hr class="w-100 border-2 border-secondary opacity-50">
                <div class="position-absolute top-50 start-50 translate-middle px-3 bg-white">
                    <a href="#" target="_blank" class="text-decoration-none fw-semibold" style="color:#B3B3B3">
                        Why you are seeing <span class="text-decoration-underline">these recommendations</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <h2 class="text-center mb-4">Top Destinations</h2>

            <?php
                include './config/database.php';
                $query = "SELECT * FROM tours ORDER BY rating DESC LIMIT 8";
                $connect = mysqli_query($conn, $query);
                $tours = mysqli_fetch_all($connect, MYSQLI_ASSOC);
               // print_r($tours);
                ?>

                <div class="row g-4" id="topdestionation">
                    <?php foreach ($tours as $tour): 
                        $firstWord = explode(" ", $tour['name'])[0];
                    ?>
                        <div class="col-md-6 col-lg-3">
                            <a href="./pages/detail.php?page=<?= $tour['id'] ?>" class="text-decoration-none">
                                <div class="topdestination">
                                    <img src="<?= $tour['image'] ?>" alt="<?= htmlspecialchars($tour['name']) ?>">
                                    <div class="topdestination-text"><?= htmlspecialchars($firstWord) ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

        </div>


        <!-- banner for ads -->
        <div class="container-fluid banner-container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="banner-title">Keep things flexible</div>
                    <div class="banner-description">
                        Use Reserve Now & Pay Later to secure the activities you don't want to miss without being locked
                        in.
                    </div>
                </div>
            </div>
        </div>


        <!-- tour pacage section -->
        <div class="container my-5">
            <div class="row row-cols-1 row-cols-md-4 g-4" id="tagtour">
                <!-- js will append here -->
            </div>
        </div>


        <!-- Review Section -->
        <div class="container mt-2">
            <div class="row review-section">
                <h3 class="why-title">Our Reviews</h3>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="review-item">
                        <div class="star-rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star-half-alt"></span>
                        </div>
                        <div class="review-author">John Doe</div>
                        <div class="review-date">Feb 20, 2025</div>
                        <p class="review-text">Great experience, would definitely recommend! The tour was amazing.</p>
                    </div>
                </div>

                <!-- Review Item 2 -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="review-item">
                        <div class="star-rating">
                            <!-- icon is from fontawesome -->
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star-half-alt"></span>
                            <span class="fa fa-star-half-alt"></span>
                        </div>
                        <div class="review-author">Jane Smith</div>
                        <div class="review-date">Feb 18, 2025</div>
                        <p class="review-text">Good value for money. The guide was very friendly and knowledgeable.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="review-item">
                        <div class="star-rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <div class="review-author">Michael Green</div>
                        <div class="review-date">Feb 16, 2025</div>
                        <p class="review-text">Amazing experience! Loved every moment of it.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="review-item">
                        <div class="star-rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star-half-alt"></span>
                            <span class="fa fa-star-half-alt"></span>
                            <span class="fa fa-star-half-alt"></span>
                        </div>
                        <div class="review-author">Emily White</div>
                        <div class="review-date">Feb 10, 2025</div>
                        <p class="review-text">Nice trip, but I wish the duration was a bit longer. Overall, good.</p>
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

    <script>
        // Function to generate star ratings
        function generateStars(rating) {
            let starsHTML = "";
            for (let i = 1; i <= 5; i++) {
                if (i <= Math.floor(rating)) {
                    starsHTML += `<i class="fa fa-star"></i>`;
                } else if (i - rating < 1) {
                    starsHTML += `<i class="fa fa-star-half"></i>`;
                } else {
                    starsHTML += `<i class="fa fa-star-o"></i>`;
                }
            }
            return starsHTML;
        }


        function createTagList() {

            const specialOffers = ["Special Offer", "New Arrival", "Discounted", "Limited Time", "Hot Deal"];
            const tagTour = document.getElementById("tagtour");
            tagTour.innerHTML = ""; // Clear previous content

            tours.slice(0, 4).forEach(tour => {
                const offerText = specialOffers[Math.floor(Math.random() * specialOffers
                .length)]; // Random offer
                const tourCard = document.createElement("div");
                tourCard.className = "col-md-3";
                tourCard.onclick = function () {
                    event.preventDefault();
                    window.location.href = `./pages/detail.php?page=${tour.id}`;
                };

                tourCard.innerHTML = `
            <div class="tour text-decoration-none">
                <img src="${tour.image}" alt="${tour.title}" class="tour-image">
                <div class="special-offer">${offerText}</div>
                <div class="tour-info">
                    <div class="tour-title">${tour.title}</div>
                    <div class="tour-rating">
                        ${generateStars((Math.random() * 0.55 + 4.5).toFixed(1))} (${Math.floor(Math.random() * (2200 - 1500 + 1) + 1500)} Reviews)
                    </div>
                    <div class="tour-duration">Duration: ${tour.duration}</div>
                    <div class="tour-price">$${tour.price}</div>
                </div>
                <div class="card-tag">$${tour.price}</div>
            </div>
        `;

                tagTour.appendChild(tourCard);
            });

        }

        document.addEventListener("DOMContentLoaded", createTourCards);
        document.addEventListener("DOMContentLoaded", createTagList);
    </script>
</body>

</html>