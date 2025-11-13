<?php include __DIR__ . '/../logger/logger.php'; ?>
<?php require_once __DIR__ . '/../api/check_signin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../components/head.php'; ?>
<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    
    <main class="form-page">
        <div class="base-div">
            <h2>Add Thread</h2>
            <div class="form-box">
                <form id="addForm">
                    <div class="form-field">
                        <label for="post">Select Post</label>
                        <select id="post" name="post" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>
                    
                    <div class="form-field">
                        <label for="content">Content</label>
                        <textarea
                            id="content"
                            name="content"
                            placeholder="Enter thread content"
                            required
                        ></textarea>
                    </div>
                    
                    <div class="form-field">
                        <label for="author">Select Author</label>
                        <select id="author" name="author" required>
                            <option value="">Loading...</option>
                        </select>
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
        document.addEventListener('DOMContentLoaded', () => {
            const postSelect = document.getElementById('post');
            fetch('/~achernii/api/index.php?table=Posts')
                .then(res => res.json())
                .then(data => {
                    postSelect.innerHTML = '';
                    if (data.length === 0) {
                        postSelect.innerHTML = '<option value="">No options</option>';
                        return;
                    }
                    data.forEach(post => {
                        const option = document.createElement('option');
                        option.value = post.post_id;
                        option.textContent = post.post_id;
                        postSelect.appendChild(option);
                    });
                })
                .catch(err => {
                    postSelect.innerHTML = '<option value="">Failed to load</option>';
                });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const authorSelect = document.getElementById('author');
            fetch('/~achernii/api/index.php?table=Users')
                .then(res => res.json())
                .then(data => {
                    authorSelect.innerHTML = '';
                    if (data.length === 0) {
                        authorSelect.innerHTML = '<option value="">No options</option>';
                        return;
                    }
                    data.forEach(author => {
                        const option = document.createElement('option');
                        option.value = author.user_id;
                        option.textContent = author.username;
                        authorSelect.appendChild(option);
                    });
                })
                .catch(err => {
                    authorSelect.innerHTML = '<option value="">Failed to load</option>';
                });
        });
    </script>
    <script>
        const form = document.getElementById('addForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const content_body  = document.getElementById('content').value.trim();
            const user_id  = document.getElementById('author').value
            const reply_post_id = document.getElementById('post').value;

            const formData = {
                content_body : content_body,
                user_id : user_id,
            };

            try {
                const res = await fetch('/~achernii/api/index.php?table=Posts', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });

                const data = await res.json();
                if (!res.ok || !data.id) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data.error || 'Error creating Post!')}`;
                    return;
                }

                const res2 = await fetch('/~achernii/api/index.php?table=Replies', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ post_id : data.id, reply_post_id : reply_post_id })
                });
                const data2 = await res2.json();
                if (!res2.ok) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data2.error || 'Error creating Reply!')}`;
                    return;
                }
                
                window.location.href = `feedback.php?status=success&message=${encodeURIComponent('Reply added successfully!')}&id=${data.id}`;
            } catch (err) {
                window.location.href = `feedback.php?status=error&message=${encodeURIComponent('Failed to send request!')}`;
            }
        });
    </script>
</body>
</html>