<?php
include './config/database.php'; // your DB config
$query = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT * FROM tours WHERE name LIKE ? OR title LIKE ? OR description LIKE ? OR locations LIKE ?";
$stmt = mysqli_prepare($conn, $sql);
$searchTerm = "%{$query}%";
mysqli_stmt_bind_param($stmt, 'ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Victor Travel & Tour | Search</title>
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
<div class="container">
<div class="h-search-form text-center" style="padding:20px; margin:20px;  background-image:none!important;">
                <form action="search.php" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control" value="<?= htmlspecialchars($query) ?>" placeholder="Search..">
                                <button class="btn" type="submit"><i class="fa-solid fa-search"></i></button>
                            </div>
            </form>
</div>
</div>
    
<div class="container my-5">
    <h3 class="mb-4 text-center">Search Results for: <span class="text-success"><?= htmlspecialchars($query) ?></span></h3>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="row border rounded p-3 mb-3 align-items-center shadow-sm">
                <div class="col-md-4 topdestination" >
                    <img src="<?= $row['image'] ?>" class="img-fluid rounded" alt="<?= $row['title'] ?>">
                </div>
                <div class="col-md-8">
                    <h5 class="fw-bold"><?= $row['title'] ?></h5>
                    <p class="mb-1 text-muted"><i class="fa-solid fa-location-dot text-danger"></i> <?= $row['locations'] ?></p>
                    <p class="text-truncate"><?= $row['description'] ?></p>
                    <p class="mb-1"><strong>Duration:</strong> <?= $row['duration'] ?> | <strong>Best Time:</strong> <?= $row['besttime'] ?></p>
                    <p class="mb-2">
                    <?php
                        $stars = '';
                        for ($i = 0; $i < 5; $i++) {
                            $stars .= '<i class="fa fa-star ' . ($i < floor($row['rating']) ? 'text-warning' : 'text-muted') . '"></i>';
                        }
                        echo $stars;
                        ?>
                        <span class="ms-2">(<?= $row['review_total'] ?> reviews)</span>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary">$<?= number_format($row['price'], 2) ?></span>
                        <a href="./pages/detail.php?page=<?= $row['id'] ?>" class="btn btn-success btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="text-center"> End of Search Results </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No tours found related to "<strong><?= htmlspecialchars($query) ?></strong>".</div>
    <?php endif; ?>
</div>


    <?php include './block/footer.php';?>

    <!-- for icon -->
    <script src="./assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="./assests/js/bootstrap.bundle.min.js"></script>
</body>

</html>