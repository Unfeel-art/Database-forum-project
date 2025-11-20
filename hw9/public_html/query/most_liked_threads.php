<?php include __DIR__ . '/../logger/logger.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../components/head.php'; ?>
<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    
    <main class="form-page">
        <div class="base-div">
            <h2>Most Liked Threads</h2>
            <div class="form-box">
                <form id="queryForm">
                    <div class="form-field">
                        <label for="number">Number of Threads</label>
                        <input
                            type="number"
                            id="number"
                            name="number"
                            min = 0
                            placeholder="Enter the number of threads to get (0 for all)"
                            required
                        >
                    </div>

                    <div class="form-btn">
                        <a href="../queries.php" class="form-cancel-btn">Cancel</a>
                        <button type="submit" class="form-add-btn">Get</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="../js/theme.js"></script>
    <script>
        const query = document.getElementById('queryForm');

        query.addEventListener('submit', async (e) => {
            e.preventDefault();
            const number  = document.getElementById('number').value

            try {
                const res = await fetch(`/~achernii/api/queries.php?query=most_liked_threads&limit=${number}`);
                if (!res.ok) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data.error || 'Error executing query!')}`;
                    return;
                }
                const data = await res.json();
                const response = { query: 'most_liked_threads', data: data };
                localStorage.setItem('queryResults', JSON.stringify(response));
                window.location.href = `feedback.php?status=success&message=${encodeURIComponent('Query executed successfully!')}`;
            } catch (err) {
                window.location.href = `feedback.php?status=error&message=${encodeURIComponent('Failed to send request!')}`;
            }
        });
    </script>
</body>
</html>