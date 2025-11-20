<?php include __DIR__ . '/../logger/logger.php'; ?>
<?php require_once __DIR__ . '/../api/check_signin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../components/head.php'; ?>
<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    
    <main class="form-page">
        <div class="base-div">
            <h2>Add Category</h2>
            <div class="form-box">
                <form id="addForm">
                    <div class="form-field">
                        <label for="title">Category Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="Enter category title"
                            required
                        >
                    </div>
                    
                    <div class="form-field">
                        <label for="description">Category Description</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            placeholder="Enter category description"
                            required
                        ></textarea>
                    </div>
                    
                    <div class="form-btn">
                        <a href="../maintenance.php" class="form-cancel-btn">Cancel</a>
                        <button type="submit" class="form-add-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="../js/theme.js"></script>
    <script>   
        const form = document.getElementById('addForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const name  = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();

            const formData = {
                name  : name,
                description : description
            };

            try {
                const res = await fetch('/~achernii/api/index.php?table=Categories', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });
                const data = await res.json();
                if (!res.ok) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data.error || 'Error creating Category!')}`;
                    return;
                }

                window.location.href = `feedback.php?status=success&message=${encodeURIComponent('Category added successfully!')}&id=${data.id}`;
            } catch (err) {
                window.location.href = `feedback.php?status=error&message=${encodeURIComponent('Failed to send request!')}`;
            }
        });
    </script>
</body>
</html>