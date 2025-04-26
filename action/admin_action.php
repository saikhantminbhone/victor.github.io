<?php

session_start();
include '../config/database.php';

// Update user
if (isset($_POST['update_user'])) {
    $id = $_POST['edit_user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];



    $query = "UPDATE users SET name=?, email=?, phone=?, role=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $role, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['admin_success'] = "User updated successfully!";
    } else {
        $_SESSION['admin_error'] = "Failed to update user.";
    }
    header("Location: ../admin/dashboard.php");
    exit;
}

//add new user
if (isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $query = "INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $password, $role);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['admin_success'] = "User added successfully.";
    } else {
        $_SESSION['admin_error'] = "Failed to add user.";
    }
    header("Location: ../admin/dashboard.php");
    exit;
}


// Delete user
if (isset($_POST['delete_user_id'])) {
    $id = $_POST['delete_user_id'];
    $query = "DELETE FROM users WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "User deleted.";
    } else {
        $_SESSION['error'] = "Failed to delete user.";
    }
    header("Location: ../admin/dashboard.php");
    exit;
}


// Handle add tour
if (isset($_POST['add_tour'])) {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    //  echo $name.$title.$description;
    //  die;
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $besttime = $_POST['besttime'];
    $locations = $_POST['locations'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    // echo $imageName;
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION); 
    //echo $imageExtension;

    //actual image path
    $imagePath = '../assests/img/' . $name . '.' . $imageExtension;

    //database image path
    $dbimagePath = './assests/img/' . $name . '.' . $imageExtension;
    
    // echo $imagePath;
    // move_uploaded_file($imageTmp, $imagePath);
    // die;
    if (move_uploaded_file($imageTmp, $imagePath)) {
        $query = "INSERT INTO tours (name, title, image, description, price, duration, besttime, locations) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $title, $dbimagePath, $description, $price, $duration, $besttime, $locations);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['admin_success'] = "Tour added successfully.";
        } else {
            $_SESSION['admin_error'] = "Failed to add tour.";
        }
    } else {
        $_SESSION['admin_error'] = "Failed to upload image.";
    }
    header("Location: ../admin/manage_tours.php");
    exit;
}

// Handle edit tour
if (isset($_POST['edit_tour'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $besttime = $_POST['besttime'];
    $locations = $_POST['locations'];

    if (!empty($_FILES['image']['name'])) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        // echo $imageName;
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION); 
        //echo $imageExtension;
    
        //actual image path
        $imagePath = '../assests/img/' . $name . '.' . $imageExtension;
    
        //database image path
        $dbimagePath = './assests/img/' . $name . '.' . $imageExtension;
        move_uploaded_file($imageTmp, $imagePath);
    } else {
        $query = "SELECT image FROM tours WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $dbimagePath = $row['image'];
    }

    $update = "UPDATE tours SET name=?, title=?, image=?, description=?, price=?, duration=?, besttime=?, locations=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $title, $dbimagePath, $description, $price, $duration, $besttime, $locations, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['admin_success'] = "Tour updated successfully.";
    } else {
        $_SESSION['admin_error'] = "Failed to update tour.";
    }
    header("Location: ../admin/manage_tours.php");
    exit;
}

if (isset($_POST['delete_tour'])) {
    $id = $_POST['delete_tour'];
    $delete = "DELETE FROM tours WHERE id=?";
    $stmt = mysqli_prepare($conn, $delete);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $_SESSION['admin_success'] = "Tour deleted successfully.";
    header("Location: ../admin/manage_tours.php");
    exit;
}

// for custom tour
if (isset($_POST['add_custom_tour'])) {
    $email = $_POST['user_email'];
    $destination = $_POST['destination'];
    $custom = $_POST['destination'] === 'Other' ? $_POST['custom_destination'] : null;
    $duration = $_POST['duration'];
    $group = $_POST['group_size'];
    $date = $_POST['travel_date'];
    // Trim each value, remove empties
    $clean_services = array_filter(array_map('trim', $_POST['services']), function($s) {
        return $s !== '';
    });

    $services = implode(', ', $clean_services);
    //echo $email.$destination.$custom.$duration.$group.$date.$services;
    // die;

    $query = "INSERT INTO custom_tour 
              (user_email, destination, custom_destination, duration, group_size, travel_date, services) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssisss", $email, $destination, $custom, $duration, $group, $date, $services);

    print_r($stmt);
    //die;



    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['tour_success'] = "Custom tour added successfully!";
    } else {
        $_SESSION['tour_error'] = "Failed to add custom tour.";
    }
    header("Location: ../admin/manage_ctours.php");
    exit;
}


if (isset($_POST['edit_custom_tour'])) {
    $id = $_POST['id'];
    $destination = $_POST['destination'];
    $custom_destination = $_POST['destination'] === 'Other' ? $_POST['custom_destination'] : null;
    $duration = $_POST['duration'];
    $group_size = $_POST['group_size'];
    $travel_date = $_POST['travel_date'];
    $user_email = $_POST['user_email'];
    $clean_services = array_filter(array_map('trim', $_POST['services']), function($s) {
        return $s !== '';
    });

    $services = implode(', ', $clean_services);
    $sql = "UPDATE custom_tour SET 
            destination = ?, custom_destination = ?, duration = ?, group_size = ?, travel_date = ?, user_email = ?, services = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissssi", $destination, $custom_destination, $duration, $group_size, $travel_date, $user_email, $services, $id);
    if ($stmt->execute()) {
        $_SESSION['tour_success'] = "Tour request updated successfully.";
    } else {
        $_SESSION['tour_error'] = "Failed to update tour request.";
    }
    header("Location: ../admin/manage_ctours.php");
    exit();
}



?>
