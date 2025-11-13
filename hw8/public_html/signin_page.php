<?php include __DIR__ . '/logger/logger.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php'; ?>
<body>
    <?php include __DIR__ . '/components/header.php'; ?>
    
    <main class="form-page">
        <div class="base-div">
            <h2>Sign In</h2>
            <div class="form-box">
                <div id="error-message"></div>
                <form id="loginForm">
                    <div class="form-field">
                        <label for="username">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Enter username"
                            required
                        >
                    </div>
                    <div class="form-field">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter password"
                            required
                        >
                    </div>

                    <div class="form-btn">
                        <a href="index.php" class="form-cancel-btn">Cancel</a>
                        <button type="submit" class="form-add-btn">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <?php include __DIR__ . '/components/footer.php'; ?>

    <script src="js/theme.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        const errorMessage = document.getElementById('error-message');
        if (error === 'unauthorized') {
            errorMessage.textContent = 'You have to sign in to access this page';
        }

        const form = document.getElementById('loginForm');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            try {
                const res = await fetch('/~achernii/api/signin.php?action=signin', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, password })
                });

                const data = await res.json();

                if (data.success) {
                    const redirect = urlParams.get('redirect');
                    if (redirect) {
                        window.location.href = redirect;
                    } else {
                        window.location.href = 'index.php';
                    }
                } else {
                    errorMessage.textContent = data.error;
                }
            } catch (err) {
                errorMessage.textContent = 'Failed to connect to server';
            }
        });
    </script>
</body>
</html>