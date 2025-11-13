<?php include __DIR__ . '/logger/logger.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php'; ?>
<body>
    <?php include __DIR__ . '/components/header.php'; ?>
    
    <main class="form-page">
        <div class="base-div">
            <h2>Sign Up</h2>
            <div class="form-box">
                <form id="addForm">
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
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter email"
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

                    <div class="form-field">
                        <label for="confirmPassword">Confirm Password</label>
                        <input 
                            type="password"
                            id="confirmPassword"
                            name="confirmPassword"
                            placeholder="Confirm password"
                            required
                        >
                    </div>
                    <div class="form-btn">
                        <a href="./index.php" class="form-cancel-btn">Cancel</a>
                        <button type="submit" class="form-add-btn">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <?php include __DIR__ . '/components/footer.php'; ?>

    <script src="./js/theme.js"></script>
    <script>
        const form = document.getElementById('addForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const username  = document.getElementById('username').value.trim();
            const email  = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return;
            }

            const formData = {
                username: username,
                email: email,
                password: password
            };

            try {
                const res = await fetch('/~achernii/api/index.php?table=Users', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });
                const data = await res.json();
                if (!res.ok || !data.id) {
                    alert('Error signing up!');
                    return;
                }
                const res2 = await fetch('/~achernii/api/index.php?table=RegularUsers', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_id: data.id })
                });
                const data2 = await res2.json();
                if (!res2.ok) {
                    alert('Error signing up!');
                    return;
                }
                alert('You signed up successfully!');
                window.location.href='./signin.php';
            } catch (err) {
                alert('Error signing up!');
            }
        });
    </script>
</body>
</html>