<?php include __DIR__ . '/../logger/logger.php'; ?>
<?php require_once __DIR__ . '/../api/check_signin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../components/head.php'; ?>
<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    
    <main class="form-page">
        <div class="base-div">
            <h2>Add Reaction</h2>
            <div class="form-box">
                <form id="addForm">
                    <div class="form-field">
                        <label for="action">Select Action</label>
                        <select id="action" name="action" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="post">Select Post</label>
                        <select id="post" name="post" required>
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
            const actionSelect = document.getElementById('action');
            fetch('/~achernii/api/index.php?table=Actions')
                .then(res => res.json())
                .then(data => {
                    actionSelect.innerHTML = '';
                    if (data.length === 0) {
                        actionSelect.innerHTML = '<option value="">No options</option>';
                        return;
                    }
                    data.forEach(action => {
                        const option = document.createElement('option');
                        option.value = action.action_id;
                        option.textContent = action.action_id;
                        actionSelect.appendChild(option);
                    });
                })
                .catch(err => {
                    actionSelect.innerHTML = '<option value="">Failed to load</option>';
                });
        });
    </script>
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
        const form = document.getElementById('addForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                action_id: document.getElementById('action').value,
                post_id: document.getElementById('post').value,
            };

            try {
                const res = await fetch('/~achernii/api/index.php?table=Targets', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });

                const data = await res.json();

                if (!res.ok) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data.error || 'Error creating Targets relation!')}`;
                    return;
                }
                window.location.href = `feedback.php?status=success&message=${encodeURIComponent('Targets relation added successfully!')}`;
            } catch (err) {
                window.location.href = `feedback.php?status=error&message=${encodeURIComponent('Failed to send request!')}`;
            }
        });
    </script>
</body>
</html>