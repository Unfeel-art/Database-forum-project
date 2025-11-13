<footer>
    <div class="base-div">
        <nav>
            <a href="/~achernii/index.php">Home</a>
            <a href="/~achernii/index.php#categories">Categories</a>
            <a href="/~achernii/index.php#threads">Threads</a>
            <a href="/~achernii/imprint.php">Imprint</a>
            <a href="/~achernii/maintenance.php">Maintenance</a>
            <a href="/~achernii/queries.php">Queries</a>
        </nav>
        <div class="footer-btn">
            <div id="footer-signout"class="footer-signout-menu" style="display: none;">
                <button id="signout-btn" class="btn-same">Sign Out</button>
            </div>
            <div id="footer-signin-menu" class="footer-signin-menu" style="display: none;">
                <a href="/~achernii/signin.php" class="btn-same">Sign In</a>
                <a href="/~achernii/signup.php" class="btn-rev">Sign Up</a>
            </div>
        </div>
    </div>
</footer>

<script src="/~achernii/js/auth_tools.js"></script>

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