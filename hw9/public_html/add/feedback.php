<?php include __DIR__ . '/../logger/logger.php'; ?>
<?php require_once __DIR__ . '/../api/check_signin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../components/head.php'; ?>
<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    
<main class="form-page">
    <div class="base-div">
        <h2>Feedback</h2>
        <div class="form-box" id="feedback-container">
            <div class="feedback-result">
                <div class="feedback-icon" id="feedback-icon"></div>
                <h3 id="feedback-title"></h3>
            </div>
            <p id="feedback-message"></p>
            <p class="feedback-id" id="feedback-id"></p>
            <div class="form-btn">
                <a href="../maintenance.php" class="form-cancel-btn">Back to Maintenance</a>
                <a href="../index.php" class="form-add-btn">Go to Home</a>
            </div>
        </div>
    </div>
</main>
    
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="../js/theme.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const message = urlParams.get('message');
        const id = urlParams.get('id');

        const container = document.getElementById('feedback-container');
        const icon = document.getElementById('feedback-icon');
        const title = document.getElementById('feedback-title');
        const messageb = document.getElementById('feedback-message');
        const idb = document.getElementById('feedback-id');

        if (status === 'success') {
            icon.textContent = '✅';
            title.textContent = 'Success';
            messageb.textContent = message || 'Added successfully!';
            messageb.style.color = 'var(--color-gray-dark)';
            if (id) {
                idb.textContent = `ID: ${id}`;
                idb.style.display = 'block';
            }
        } else if (status === 'error') {
            icon.textContent = '❌';
            title.textContent = 'Error';
            messageb.textContent = message || 'Error occurred!';
            messageb.style.color = 'var(--color-gray-dark)';
        } else {
            icon.textContent = '⚠️';
            title.textContent = 'No Information';
            messageb.textContent = 'No feedback available!';
            messageb.style.color = 'var(--color-gray-dark)';
        }
    </script>
</body>
</html>