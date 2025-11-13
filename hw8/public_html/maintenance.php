<?php include __DIR__ . '/logger/logger.php'; ?>
<?php require_once __DIR__ . '/api/check_signin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php'; ?>

<body>
    <?php include __DIR__ . '/components/header.php'; ?>

    <main>
        <div class="maintenance-page">
            <h2>Data Maintenance</h2>
            <div class="base-div">
                <h3>Entities</h3>
                <ul class = "add-options-list">
                    <li><a href="add/user.php" class="add-option-btn">Add Regular User</a></li>
                    <li><a href="add/moderator.php" class="add-option-btn">Add Moderator</a></li>
                    <li><a href="add/thread.php" class="add-option-btn">Add Thread</a></li>
                    <li><a href="add/reply.php" class="add-option-btn">Add Reply</a></li>
                    <li><a href="add/category.php" class="add-option-btn">Add Category</a></li>
                    <li><a href="add/reaction.php" class="add-option-btn">Add Reaction</a></li>
                    <li><a href="add/report.php" class="add-option-btn">Add Report</a></li>
                </ul>
            </div>
            <div class="base-div">
                <h3>Relationships</h3>
                <ul class = "add-options-list">
                    <li><a href="add/contains.php" class="add-option-btn">Add Contains</a></li>
                    <li><a href="add/targets.php" class="add-option-btn">Add Targets</a></li>
                </ul>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/components/footer.php'; ?>

    <script src="js/theme.js"></script>
</body>
</html>