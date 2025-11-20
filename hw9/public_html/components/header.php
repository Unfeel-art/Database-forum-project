<?php include __DIR__ . '/url.php'; ?>
<header>
    <div class="base-div">
        <a href="<?php echo $baseUrl; ?>/index.php">
            <div class="logo">
                <img src="<?php echo $baseUrl; ?>/img/logo.png" class="logo-img">
                <h1>Forum</h1>
            </div>
        </a>
        <nav>
            <a href="<?php echo $baseUrl; ?>/index.php">Home</a>
            <a href="<?php echo $baseUrl; ?>/index.php#categories">Categories</a>
            <a href="<?php echo $baseUrl; ?>/index.php#threads">Threads</a>
            <a href="<?php echo $baseUrl; ?>/imprint.php">Imprint</a>
            <a href="<?php echo $baseUrl; ?>/maintenance.php">Maintenance</a>
            <a href="<?php echo $baseUrl; ?>/queries.php">Queries</a>
            <a href="<?php echo $baseUrl; ?>/demo.php">Search Demo</a>
        </nav>
        <div class="header-btn">
            <button id="theme-btn" class="theme-btn">
                <span class="theme-icon">◐</span>
            </button>
            <div id="header-signin-menu" class="header-signin-menu" style="display: none;">
                <a href="<?php echo $baseUrl; ?>/signin_page.php" class="btn-same">Sign In</a>
                <a href="<?php echo $baseUrl; ?>/signup.php" class="btn-rev">Sign Up</a>
            </div>
            <div id="account-menu" class="header-account-menu" style="display: none;">
                <button id="username-display" class="btn-same"></button>
            </div>
        </div>
    </div>
</header>


<script src="<?php echo $baseUrl; ?>/js/auth_tools.js"></script>

<script>
    checkSignIn().then(res => {
        if (res.signedIn) {
            document.getElementById('header-signin-menu').style.display = 'none';
            document.getElementById('account-menu').style.display = 'block';
            document.getElementById('username-display').textContent = res.username;
            document.getElementById('username-display').addEventListener('click', signOut);
        } else {
            document.getElementById('header-signin-menu').style.display = 'block';
            document.getElementById('header-account-menu').style.display = 'none';
        }
    });
</script>