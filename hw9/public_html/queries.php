<?php include __DIR__ . '/logger/logger.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php'; ?>

<body>
    <?php include __DIR__ . '/components/header.php'; ?>

    <main>
        <div class="maintenance-page">
            <h2>Queries</h2>
            <div class="base-div">
                <ul class = "add-options-list">
                    <li><a href="query/threads_by_category.php" class="add-option-btn">Threads of a specific category</a></li>
                    <li><a href="query/reported_posts.php" class="add-option-btn">Reported posts</a></li>
                    <li><a href="query/most_liked_threads.php" class="add-option-btn">Most liked threads</a></li>
                </ul>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/components/footer.php'; ?>

    <script src="js/theme.js"></script>
</body>
</html>