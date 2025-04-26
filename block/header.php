<div class="header">
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">Victor</a>

                <!-- nav menu -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnavbar">
                    <i class="fa-solid fa-bars color3"></i>
                </button>

                <!-- nav dropdown list -->
                <div class="collapse navbar-collapse" id="topnavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <?php  
                     session_start(); 
                     if ($_COOKIE['cookie_consent']== 'accepted') {
                        $user_role = $_COOKIE['user_role'];
                        }else{
                            $user_role = $_SESSION['user_role'];
                        }
                    
                    ?>
            <?php if (empty($user_role) || $user_role == "user"): ?>

                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'package.php' ? 'active' : '' ?>" href="./package.php">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'custom.php' ? 'active' : '' ?>" href="./custom.php">Custom Tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>" href="./contact.php">Contact Us</a>
                    </li>

                <?php elseif ($user_role == "admin" || $user_role == "editor"): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Manage User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'manage_tours.php' ? 'active' : '' ?>" href="manage_tours.php">Manage Tours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'manage_ctours.php' ? 'active' : '' ?>" href="manage_ctours.php">Manage Custom Tours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'manage_messages.php' ? 'active' : '' ?>" href="manage_messages.php">Manage Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'manage_bookings.php' ? 'active' : '' ?>" href="manage_bookings.php">Manage Bookings</a>
                    </li>
                <?php endif; ?>

                <?php if ($user_role == "admin"): ?>
                    <!-- Settings Only For Admin -->
                    <li class="nav-item">
                        <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'setting.php' ? 'active' : '' ?>" href="setting.php">Settings</a>
                    </li>
                <?php endif; ?>

                   
                </ul>

                <div class="user-info dropdown">
                        <a class="nav-link dropdown-toggle user-icon d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user color3"></i>
                            <?php

                                if ($_COOKIE['cookie_consent']== 'accepted') {
                                    $user_name = $_COOKIE['user_name'];
                                    }else{
                                        $user_name = $_SESSION['user_name'];
                                    }

                                    // echo $user_name;
                            ?>
                            <?php if ($user_name): ?>
                                <span class="text-dark fw-semibold"><?= htmlspecialchars($user_name) ?></span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if ($user_name): ?>
                                <li class="dropdown-header text-success fw-semibold">
                                    Hello ! <?= htmlspecialchars($user_name) ?>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#"> 
                                        <i class="fa-solid fa-heart color3"></i> &nbsp; Wishlists
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../action/logout.php"> 
                                        <i class="fa-solid fa-right-from-bracket color3"></i> &nbsp; Logout
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="dropdown-item" href="./register.php">
                                        <i class="fa-solid fa-plus color3"></i> &nbsp; Register
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="./login.php">
                                        <i class="fa-solid fa-lock color3"></i> &nbsp; Login
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#"> 
                                    <i class="fa-solid fa-question color3"></i> &nbsp; Help
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </div>