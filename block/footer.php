<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5>About Us</h5>
            <p>Explore the world with us. Your adventure begins here! We offer the best tours at the most affordable
              prices.</p>
          </div>

          <div class="col-md-4">
            <h5>Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="./index.html">Home</a></li>
              <li><a href="./packages.html">Packages</a></li>
              <li><a href="./contact.html">Contact</a></li>
              <li><a href="#">FAQ</a></li>
            </ul>
          </div>

          <div class="col-md-4">
            <h5>Follow Us</h5>
            <a href="#" class="social-icon"><i class="fa fa-facebook"></i></a>
            <a href="#" class="social-icon"><i class="fa fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fa fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fa fa-youtube"></i></a>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12 text-center">
            <p>&copy; 2025 Victor Tour Website. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>

    <?php if (!isset($_COOKIE['cookie_consent'])): ?>
<div id="cookieConsent" class="cookie-consent">
  <form method="post" action="./action/cookie_action.php" class="cookie-box">
    <p>We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>
    <button type="submit" name="accept_cookie" class="btn btn-success btn-sm">Accept</button>
    <button type="submit" name="reject_cookie" class="btn btn-danger btn-sm">Reject</button>
  </form>
</div>
<?php endif; ?>
