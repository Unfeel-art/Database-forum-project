<?php require_once __DIR__ . '/../api/check_signin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../components/head.php'; ?>
<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    
    <main class="form-page">
        <div class="base-div">
            <h2>Add Contains Relation</h2>
            <div class="form-box">
                <form id="addForm">
                    <div class="form-field">
                        <label for="category">Select Category</label>
                        <select id="category" name="category" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="thread">Select Thread</label>
                        <select id="thread" name="thread" required>
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
            const categorySelect = document.getElementById('category');
            fetch('/~achernii/api/index.php?table=Categories')
                .then(res => res.json())
                .then(data => {
                    categorySelect.innerHTML = '';
                    if (data.length === 0) {
                        categorySelect.innerHTML = '<option value="">No options</option>';
                        return;
                    }
                    data.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.category_id;
                        option.textContent = category.name;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(err => {
                    categorySelect.innerHTML = '<option value="">Failed to load</option>';
                });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const threadSelect = document.getElementById('thread');
            fetch('/~achernii/api/index.php?table=Threads')
                .then(res => res.json())
                .then(data => {
                    threadSelect.innerHTML = '';
                    if (data.length === 0) {
                        threadSelect.innerHTML = '<option value="">No options</option>';
                        return;
                    }
                    data.forEach(thread => {
                        const option = document.createElement('option');
                        option.value = thread.post_id;
                        option.textContent = thread.title;
                        threadSelect.appendChild(option);
                    });
                })
                .catch(err => {
                    threadSelect.innerHTML = '<option value="">Failed to load</option>';
                });
        });
    </script>
    <script>
        const form = document.getElementById('addForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                category_id: document.getElementById('category').value,
                thread_post_id: document.getElementById('thread').value,
            };

            try {
                const res = await fetch('/~achernii/api/index.php?table=Contains', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });

                const data = await res.json();

               if (!res.ok) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data.error || 'Error creating Contains relation!')}`;
                    return;
                }
                window.location.href = `feedback.php?status=success&message=${encodeURIComponent('Contains relation added successfully!')}`;
            } catch (err) {
                window.location.href = `feedback.php?status=error&message=${encodeURIComponent('Failed to send request!')}`;
            }
        });
    </script>
</body>
</html>