<?php include __DIR__ . '/url.php'; ?>
<footer>
    <div class="base-div">
        <nav>
            <a href="<?php echo $baseUrl; ?>/index.php">Home</a>
            <a href="<?php echo $baseUrl; ?>/index.php#categories">Categories</a>
            <a href="<?php echo $baseUrl; ?>/index.php#threads">Threads</a>
            <a href="<?php echo $baseUrl; ?>/imprint.php">Imprint</a>
            <a href="<?php echo $baseUrl; ?>/maintenance.php">Maintenance</a>
            <a href="<?php echo $baseUrl; ?>/queries.php">Queries</a>
            <a href="<?php echo $baseUrl; ?>/demo.php">Search Demo</a>
        </nav>
        <div class="footer-btn">
            <div id="footer-signout"class="footer-signout-menu" style="display: none;">
                <button id="signout-btn" class="btn-same">Sign Out</button>
            </div>
            <div id="footer-signin-menu" class="footer-signin-menu" style="display: none;">
                <a href="<?php echo $baseUrl; ?>/signin_page.php" class="btn-same">Sign In</a>
                <a href="<?php echo $baseUrl; ?>/signup.php" class="btn-rev">Sign Up</a>
            </div>
        </div>
    </div>
</footer>

<script src="<?php echo $baseUrl; ?>/js/auth_tools.js"></script>

<script>
    checkSignIn().then(res => {
        if (res.signedIn) {
            document.getElementById('footer-signin-menu').style.display = 'none';
            document.getElementById('footer-signout').style.display = 'block';
            document.getElementById('signout-btn').addEventListener('click', signOut);
        } else {
            document.getElementById('footer-signout').style.display = 'none';
            document.getElementById('footer-signin-menu').style.display = 'block';
        }
    });
</script>