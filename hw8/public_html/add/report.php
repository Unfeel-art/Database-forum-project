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
                        <label for="user">Select User</label>
                        <select id="user" name="user" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="reason">Report Reason</label>
                        <textarea
                            id="reason"
                            name="reason"
                            placeholder="Enter report reason"
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
        document.addEventListener('DOMContentLoaded', () => {
            const userSelect = document.getElementById('user');
            fetch('/~achernii/api/index.php?table=Users')
                .then(res => res.json())
                .then(data => {
                    userSelect.innerHTML = '';
                    if (data.length === 0) {
                        userSelect.innerHTML = '<option value="">No options</option>';
                        return;
                    }
                    data.forEach(user => {
                        const option = document.createElement('option');
                        option.value = user.user_id;
                        option.textContent = user.username;
                        userSelect.appendChild(option);
                    });
                })
                .catch(err => {
                    userSelect.innerHTML = '<option value="">Failed to load</option>';
                });
        });
    </script>
    <script>
        const form = document.getElementById('addForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const user  = document.getElementById('user').value;
            const report_reason  = document.getElementById('reason').value.trim();

            const formData = {
                user_id : user,
            };

            try {
                const res = await fetch('/~achernii/api/index.php?table=Actions', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });

                const data = await res.json();
                if (!res.ok || !data.id) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data.error || 'Error creating Action!')}`;
                    return;
                }

                const res2 = await fetch('/~achernii/api/index.php?table=Reports', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action_id : data.id, report_reason : report_reason })
                });
                const data2 = await res2.json();
                if (!res2.ok) {
                    window.location.href = `feedback.php?status=error&message=${encodeURIComponent(data2.error || 'Error creating Report!')}`;
                    return;
                }
                
                window.location.href = `feedback.php?status=success&message=${encodeURIComponent('Report added successfully!')}&id=${data.id}`;
            } catch (err) {
                window.location.href = `feedback.php?status=error&message=${encodeURIComponent('Failed to send request!')}`;
            }
        });
    </script>
</body>
</html>