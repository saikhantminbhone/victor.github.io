<?php
session_start();

if($_SESSION['user_role']){
    $user_role = $_SESSION['user_role'];
}

if ($_COOKIE['cookie_consent']== 'accepted') {
    $user_role = $_COOKIE['user_role'] ?? null;
}
// echo $user_role;
// die;
if($user_role !== "admin" && $user_role !== "editor"){
    header("Location: ../index.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Custom Tours</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" property="og:title" content="Victor Travel & Tour">
    <meta name="Keywords"
        content="Tour, travel, south-east asia, Aisa, vacation, beaches, packages, group travel, solo travel, travel plan">

    <!-- bootstrap css -->
    <link href="../assests/css/bootstrap.css" rel="stylesheet">
    <!-- custom-->
    <link href="../assests/css/style.css" rel="stylesheet">
</head>

<body>

<?php include '../block/header.php';?>


<div class="container-fluid mt-4">
  <h2 class="text-center">Manage Custom Tour Requests</h2>

  <!-- Alert messages -->
  <?php if (isset($_SESSION['tour_success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['tour_success']; unset($_SESSION['tour_success']); ?></div>
  <?php elseif (isset($_SESSION['tour_error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['tour_error']; unset($_SESSION['tour_error']); ?></div>
  <?php endif; ?>

  <!-- Add Button -->
  <div class="text-end mb-3">
    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addTourModal">+ Add Custom Tour</button>
  </div>



  <!-- Table -->
  <div class="table-responsive mt-3">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>User Email</th>
          <th>Destination</th>
          <th>Custom Destination</th>
          <th>Duration</th>
          <th>Group Size</th>
          <th>Travel Date</th>
          <th>Services</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
       include '../config/database.php';
      $query = "SELECT * FROM custom_tour ORDER BY id DESC";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['user_email']) ?></td>
          <td><?= !empty($row['destination']) ? htmlspecialchars($row['destination']) : '-' ?></td>
        <td><?= !empty($row['custom_destination']) ? htmlspecialchars($row['custom_destination']) : '-' ?></td>

          <td><?= $row['duration'] ?> days</td>
          <td><?= $row['group_size'] ?></td>
          <td><?= $row['travel_date'] ?></td>
          <td><?= nl2br(htmlspecialchars($row['services'])) ?></td>
          <td><?= $row['created_at'] ?></td>
          <td>
            <div class="d-flex gap-2">
            <button class="btn btn-sm btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal<?= $row['id'] ?>">
            Edit
            </button>


              <button class="btn btn-sm btn-success"
                      data-bs-toggle="modal"
                      data-bs-target="#replyModal<?= $row['id'] ?>">
                Reply
              </button>
            </div>
          </td>
        </tr>

        <!-- Reply Modal -->
        <div class="modal fade" id="replyModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form action="../action/send_reply_email.php" method="POST">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reply to <?= htmlspecialchars($row['user_email']) ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="to_email" value="<?= htmlspecialchars($row['user_email']) ?>">
                  <div class="mb-3">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" required>
                  </div>
                  <div class="mb-3">
                    <label>Message</label>
                    <textarea class="form-control" name="message" rows="5" required></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="send_reply" class="btn btn-success">Send Email</button>
                </div>
              </div>
            </form>
          </div>
        </div>
<!-- Edit Tour Modal -->
<div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" onload="toggleEditCustomDestination(<?= $row['id'] ?>)">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="../action/admin_action.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tour Request #<?= $row['id'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php
                    $tour_query = "SELECT id, name FROM tours ORDER BY name ASC";
                    $tour_result = mysqli_query($conn, $tour_query);
                    ?>

                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Destination</label>
                        <select class="form-select" name="destination" id="destination" onchange="toggleEditCustomDestination(<?= $row['id'] ?>)" required>
                            <option disabled>Choose a destination</option>
                            <?php mysqli_data_seek($tour_result, 0); ?>
                            <?php while ($tour = mysqli_fetch_assoc($tour_result)): ?>
                                <option value="<?= htmlspecialchars($tour['name']) ?>"
                                <?= strtolower($row['destination']) === strtolower($tour['name']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($tour['name']) ?>
                                </option>
                            <?php endwhile; ?>
                            <option value="Other" <?= $row['destination'] === "Other" ? 'selected' : '' ?>>Other (Specify)</option>
                        </select>
                    </div>

                    <div class="mb-3" id="customDestinationDiv<?= $row['id'] ?>" style="<?= $row['destination'] === "Other" ? '' : 'display: none;' ?>">
                        <label for="customDestination<?= $row['id'] ?>" class="form-label">Enter Destination</label>
                        <input type="text" name="custom_destination" class="form-control" id="customDestination<?= $row['id'] ?>" value="<?= htmlspecialchars($row['custom_destination']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tour Duration (days)</label>
                        <input type="number" name="duration" class="form-control" value="<?= $row['duration'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Group Size</label>
                        <input type="number" name="group_size" class="form-control" value="<?= $row['group_size'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Travel Date</label>
                        <input type="date" name="travel_date" class="form-control" value="<?= $row['travel_date'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="user_email" class="form-control" value="<?= htmlspecialchars($row['user_email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Additional Services</label>
                        <?php 

                           $all_services = array_map('trim', explode(',', $row['services'] ?? ''));
                           
                           $known_services = ["Airport Pickup", "Hotel Booking", "Guided Tour"];
                           $selected_services = [];
                           $other_service = "";
                           
                           foreach ($all_services as $service) {
                               if (in_array($service, $known_services)) {
                                   $selected_services[] = $service;
                               } else {
                                   $other_service = $service;
                               }
                           }
                   
                           
                            // if(in_array("Airport Pickup", $selected_services)){
                            //     echo "exist";
                            // }
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[]" value="Airport Pickup" <?= in_array("Airport Pickup", $selected_services) ? 'checked' : '' ?>>
                            <label class="form-check-label">Airport Pickup</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[]" value="Hotel Booking" <?= in_array("Hotel Booking", $selected_services) ? 'checked' : '' ?>>
                            <label class="form-check-label">Hotel Booking</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[]" value="Guided Tour" <?= in_array("Guided Tour", $selected_services) ? 'checked' : '' ?>>
                            <label class="form-check-label">Guided Tour</label>
                        </div>
                        <div class="mt-2">
                        <input type="text" class="form-control" name="services[]" placeholder="Other (Specify)" value="<?= htmlspecialchars($other_service) ?>">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" name="edit_custom_tour" class="btn btn-primary">Update Request</button>
                </div>
            </div>
        </form>
    </div>
</div>


      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

  <!-- Add Tour Modal -->
<!-- Add Tour Request Modal -->
<div class="modal fade" id="addTourModal" tabindex="-1" aria-labelledby="addTourModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="../action/admin_action.php" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Custom Tour Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <?php
        include './config/database.php';
        $tour_query = "SELECT id, name FROM tours ORDER BY name ASC";
        $tour_result = mysqli_query($conn, $tour_query);
        ?>

        <div class="mb-3">
            <label for="destination" class="form-label">Select Destination</label>
            <select class="form-select" name="destination" id="adddestination" onchange="toggleCustomDestination()" required>
                <option selected disabled>Choose a destination</option>
                <?php while($tour = mysqli_fetch_assoc($tour_result)): ?>
                    <option value="<?= htmlspecialchars($tour['name']) ?>">
                        <?= htmlspecialchars($tour['name']) ?>
                    </option>
                <?php endwhile; ?>
                <option value="Other">Other (Specify)</option>
            </select>
        </div>

        <div class="mb-3" id="addcustomDestinationDiv" style="display: none;">
            <label for="customDestination" class="form-label">Enter Destination</label>
            <input type="text" name="custom_destination" class="form-control" id="addcustomDestination" placeholder="Enter your destination">
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Tour Duration (days)</label>
            <input type="number" name="duration" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="groupSize" class="form-label">Group Size</label>
            <input type="number" name="group_size" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="travelDate" class="form-label">Travel Date</label>
            <input type="date" name="travel_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="user_email" class="form-control" required>
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
      </div>

      <div class="modal-footer">
        <button type="submit" name="add_custom_tour" class="btn btn-primary">Submit Request</button>
      </div>
    </form>
  </div>
</div>

<script>
  // For Add Tour Modal
  function toggleCustomDestination() {
            let destinationSelect = document.getElementById("adddestination");
            let customDestinationDiv = document.getElementById("addcustomDestinationDiv");
            let customDestinationInput = document.getElementById("addcustomDestination");

            if (destinationSelect.value === "Other") {
                customDestinationDiv.style.display = "block";
                customDestinationInput.required = true;
            } else {
                customDestinationDiv.style.display = "none";
                customDestinationInput.required = false;
            }
        }

  function toggleEditCustomDestination(id) {
    const select = document.querySelector(`#editModal${id} select[name="destination"]`);
    const customDiv = document.getElementById(`customDestinationDiv${id}`);
    const input = document.getElementById(`customDestination${id}`);

    // Check if "Other" is selected and display the custom input
    if (select.value === "Other") {
        customDiv.style.display = "block";
        input.required = true;
    } else {
        customDiv.style.display = "none";
        input.required = false;
    }

  }

  // load if the destination is "Other"
  document.addEventListener('DOMContentLoaded', function () {
    <?php
      mysqli_data_seek($result, 0); // Reset the result pointer
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        if (empty($row['destination']) && !empty($row['custom_destination'])) {
          echo "toggleEditCustomDestination($id);\n";
        }
      }
    ?>
  });
</script>



    <!-- for icon -->
    <script src="../assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="../assests/js/bootstrap.bundle.min.js"></script>

</body>

</html>