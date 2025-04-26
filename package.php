<!DOCTYPE html>
<html lang="en">

<head>
  <title>Victor Travel & Tour | Packages</title>
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
    <div class="container mt-3">
      <h3 class="why-title color3">Top Packages in Victor</h3>

      <div class="row" id="tourlist">
    <?php
    include './config/database.php';
    if ($_COOKIE['cookie_consent']== 'accepted') {
      $user_id = $_COOKIE['user_id'];
      }else{
          $user_id = $_SESSION['user_id'];
      }

    if (isset($user_id)) {
       // echo $user_id;
        $wishlistQuery = "SELECT tour_id FROM wishlists WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $wishlistQuery);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        while ($row = mysqli_fetch_assoc($result)) {
            $wishlistedTourIds[] = $row['tour_id'];
        }

      //  print_r($wishlistedTourIds);
    }

  
    $query = "SELECT * FROM tours ORDER BY id DESC";
    $connect = mysqli_query($conn,  $query);
    $tours = mysqli_fetch_all($connect, MYSQLI_ASSOC);
    // print_r($tours);
    foreach ($tours as $tour):
      $stars = '';
      for ($i = 0; $i < 5; $i++) {
        $stars .= '<i class="fa fa-star ' . ($i < floor($tour['rating']) ? 'text-warning' : 'text-muted') . '"></i>';
      }
      if($wishlistedTourIds){
      $isUserFav = in_array($tour['id'], $wishlistedTourIds);
      }
    $iconClass = $isUserFav ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart text-light';
    ?>
    
    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
      <div class="card position-relative">
        <a href="./pages/detail.php?page=<?= $tour['id'] ?>" target="_blank">
          <img src="<?= $tour['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($tour['title']) ?>"
               style="height: 180px; object-fit: cover;">
        </a>
        <div class="position-absolute top-0 end-0 m-1">
        <form method="post" action="./action/user_action.php" class="position-absolute top-0 end-0 m-1">
              <input type="hidden" name="wtour_id" value="<?= htmlspecialchars($tour['id']) ?>">
                  <button class="btn btn-link" type="submit">
                    <i class="h2 <?= $iconClass ?>"></i>
                  </button>
            </form>
        </div>
        <div class="card-body"
             onclick="event.preventDefault(); window.location.href='./pages/detail.php?page=<?= $tour['id'] ?>';">
          <div class="d-flex justify-content-between align-items-center">
            <div class="rating">
              <span class="text-warning"><?= $stars ?></span>
              <span class="text-muted">(<?= $tour['review_total'] ?>)</span>
            </div>
          </div>
          <h5 class="card-title"><?= htmlspecialchars($tour['title']) ?></h5>
          <ul class="list-unstyled">
            <li><i class="fa fa-check-circle"></i> Free Cancellation</li>
            <li><i class="fa fa-clock"></i> <?= htmlspecialchars($tour['duration']) ?></li>
            <li><i class="fa fa-map-marker-alt"></i> <?= htmlspecialchars($tour['locations']) ?></li>
            <li><i class="fa fa-calendar-alt"></i> Best time: <?= htmlspecialchars($tour['besttime']) ?></li>
            <li class="font-weight-bold">
              <span class="text-muted">From:</span> $<?= number_format($tour['price'], 2) ?>
            </li>
            <li class="text-muted">Price varies by group size</li>
          </ul>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</div>
    </div>


    <div class="container-fluid banner-container-lighter">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="banner-description">
            Were these results helpful? <i class="fa-regular fa-thumbs-up h4 color3"></i> <i
              class="fa-regular fa-thumbs-down h4 color3"></i>
          </div>
        </div>
      </div>
    </div>



    <div class="container my-5">
      <h2 class="text-center mb-4">Frequently Asked Questions</h2>
      <div class="faq-container">
        <div class="faq-item">
          <input type="checkbox" id="faq1">
          <label for="faq1" class="faq-title">What is included in the Southeast Asia tour package?</label>
          <div class="faq-content">
            <p>Our tour packages typically include accommodation, guided tours, transportation between destinations,
              some meals, and entrance fees for major attractions. Flights and personal expenses are usually not
              included.</p>
          </div>
        </div>

        <div class="faq-item">
          <input type="checkbox" id="faq2">
          <label for="faq2" class="faq-title">Do I need a visa for Southeast Asia countries?</label>
          <div class="faq-content">
            <p>Visa requirements vary by country. Many Southeast Asian countries offer visa-free entry or
              visa-on-arrival
              for certain nationalities. We recommend checking with your local embassy before booking.</p>
          </div>
        </div>

        <div class="faq-item">
          <input type="checkbox" id="faq3">
          <label for="faq3" class="faq-title">What is the best time to visit Southeast Asia?</label>
          <div class="faq-content">
            <p>The best time to visit is between November and April when the weather is dry and pleasant. However,
              certain destinations like Bali and the Philippines have different peak seasons.</p>
          </div>
        </div>

        <div class="faq-item">
          <input type="checkbox" id="faq4">
          <label for="faq4" class="faq-title">Are flights included in the package?</label>
          <div class="faq-content">
            <p>International flights are usually not included, but we can assist you with booking them. Domestic flights
              between destinations are also not included, it will be an additional charge.</p>
          </div>
        </div>

        <div class="faq-item">
          <input type="checkbox" id="faq5">
          <label for="faq5" class="faq-title">Is travel insurance required?</label>
          <div class="faq-content">
            <p>Travel insurance is not mandatory but highly recommended. It helps cover medical emergencies, trip
              cancellations, and lost baggage.</p>
          </div>
        </div>

        <div class="faq-item">
          <input type="checkbox" id="faq6">
          <label for="faq6" class="faq-title">What is the payment and cancellation policy?</label>
          <div class="faq-content">
            <p>A deposit is required to confirm your booking. Cancellations made 30 days before departure receive a full
              refund, while later cancellations may incur fees. Please check our detailed terms and conditions.</p>
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
function toggleWishlist(button) {
  var heartIcon = button.querySelector('i');
  if (heartIcon.classList.contains('fa-regular', 'fa-heart')) {
    heartIcon.classList.remove('fa-regular', 'fa-heart', 'text-light');
    heartIcon.classList.add('fa-solid', 'fa-heart', 'text-danger');
  } else {
    heartIcon.classList.remove('fa-solid', 'fa-heart', 'text-danger');
    heartIcon.classList.add('fa-regular', 'fa-heart', 'text-light');
  }
}
</script>

</body>

</html>