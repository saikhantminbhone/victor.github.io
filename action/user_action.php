<?php
session_start();
include '../config/database.php';

if (isset($_POST['register'])) {
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phone'];
    $password = $_POST['password'];
   // echo $fullname;
//    echo $email . $phonenumber. $password;

    // Check for existing email
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $checkEmailQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['error'] = "This email is already registered.";
        header("Location: ../register.php");
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   // echo $hashedPassword;

    $insertQuery = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $phonenumber, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        //i set the session to show error message or success message for user login
        $_SESSION['success'] = "Registration successful. Please login.";
        header("Location: ../login.php");
        exit;
    } else {
        $_SESSION['error'] = "Something went wrong. Try again later.";
        header("Location: ../register.php");
        exit;
    }
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //echo $email.$password;

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and password are required.";
        header("Location: ../login.php");
        exit;
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            // store user email and role in cookies
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
        
            if ($_COOKIE['cookie_consent'] == 'accepted') {
                setcookie("user_id", $user['id'], time() + (86400 * 7), "/");
                setcookie("user_name", $user['name'], time() + (86400 * 7), "/");
                setcookie("user_role", $user['role'], time() + (86400 * 7), "/");
            }

            // print_r($_SESSION['user']);
            // die;

            $_SESSION['success'] = "Login successful!";
            if ($user['role'] === 'admin' || $user['role'] === 'editor') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit;
        } else {
            $_SESSION['error'] = "Incorrect password.";
            header("Location: ../login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "No user found with this email.";
        header("Location: ../login.php");
        exit;
    }
}


if (isset($_POST['wtour_id'])) {

    if ($_COOKIE['cookie_consent']== 'accepted') {
    $user_id = $_COOKIE['user_id'] ;
    }else{
        $user_id = $_SESSION['user_id'];
    }

   // echo $user_id;die;
    if (!isset($user_id)) {
        header("Location: ../login.php");
        exit;
    }


    $tour_id = $_POST['wtour_id'];
    //echo $user_id. $tour_id;
    // Check it's already exist or not
        $checkQuery = "SELECT * FROM wishlists WHERE user_id = ? AND tour_id = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "ss", $user_id, $tour_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    //     echo "debug";
    // print_r(mysqli_stmt_num_rows($stmt));
        //if not exist it will add
        if (mysqli_stmt_num_rows($stmt) == 0) {
          //  echo "not exist";
            $insertQuery = "INSERT INTO wishlists (user_id, tour_id) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, "ss", $user_id, $tour_id);
            mysqli_stmt_execute($stmt);
        }

      //  echo "exist";

        header("Location: ../package.php");
        exit;


}



if (isset($_POST['destination']) ||  isset($_POST['custom_destination'])) {
    

    if ($_COOKIE['cookie_consent']== 'accepted') {
        $user_id = $_COOKIE['user_id'] ?? null;
        }else{
            $user_id = $_SESSION['user_id'] ?? null;
        }
    $destination = $_POST['destination'];
    $custom_destination = $_POST['destination'] === 'Other' ? $_POST['custom_destination'] : null;
    // echo $destination. $custom;
    // die;
    $duration = $_POST['duration'] ?? "-";
    $group_size = $_POST['group_size'];
    $travel_date = $_POST['travel_date'];
    $email = $_POST['email'];
    $clean_services = array_filter(array_map('trim', $_POST['services']), function($s) {
        return $s !== '';
    });

    $services = implode(', ', $clean_services);

    $query = "INSERT INTO custom_tour 
        (user_email, destination, custom_destination, duration, group_size, travel_date, services,user_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?,?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssissss", $email, $destination, $custom_destination, $duration, $group_size, $travel_date, $services,$user_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Your tour request has been submitted successfully.";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }
    $_SESSION['success'] = "Custom Tour successfully Submitted";
    header("Location: ../custom.php"); // or return to form
    exit;
}

if (isset($_POST['send_message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // echo $name.$email.$message;
    // die;

    if ($_COOKIE['cookie_consent']== 'accepted') {
        $user_id = $_COOKIE['user_id'] ?? null;
        }else{
            $user_id = $_SESSION['user_id'] ?? null;
        }
    // echo $user_id;
    // die;

    $query = "INSERT INTO contact_messages (user_id, name, email, message) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isss", $user_id, $name, $email, $message);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Your message has been sent successfully!";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }

    header("Location: ../contact.php");
    exit;
}





?>
