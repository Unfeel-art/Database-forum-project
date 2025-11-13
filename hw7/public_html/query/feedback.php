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
            <div id="results"></div>
            <div class="form-btn">
                <a href="../queries.php" class="form-cancel-btn">Back to Queries</a>
                <a href="../index.php" class="form-add-btn">Go to Home</a>
            </div>
        </div>
    </div>
</main>
    
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="../js/theme.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const message = urlParams.get('message');
            
            const icon = document.getElementById('feedback-icon');
            const title = document.getElementById('feedback-title');
            const messageb = document.getElementById('feedback-message');
            
            if (status === 'success') {
                icon.textContent = '✅';
                title.textContent = 'Success';
                messageb.textContent = message;
                messageb.style.color = 'var(--color-gray-dark)';

                const query = JSON.parse(localStorage.getItem('queryResults') || '{}');
                const results = document.getElementById('results');

                if (!query.data || query.data.length === 0) {
                    results.innerHTML = '<p>No results found</p>';
                    return;
                }
                const queryResults = query.data;
                const queryType = query.query;
                let res = '<div class="results-list">';
                queryResults.forEach(queryResult => {
                    let entity = 'Threads';
                    let additionalInfo = {};

                    if (queryType === 'threads_by_category') {
                        additionalInfo = `query=${encodeURIComponent("Threads by Category")}&category=${encodeURIComponent(queryResult.category_name)}&author=${encodeURIComponent(queryResult.username)}`;
                        res += `
                            <a href="entity_description.php?entity=${entity}&id=${queryResult.post_id}&${additionalInfo}">
                            <div class="result-card">
                                <div class="result-title">ID: ${queryResult.post_id}</div>
                                <div class="result-info">
                                    <p>Thread title: ${queryResult.title}</p>
                                    <p>Category: ${queryResult.category_name}</p>
                                    <p>Author: ${queryResult.username}</p>
                                </div>
                            </div>
                            </a>
                        `;
                    } else if (queryType === 'reported_posts') {
                        entity = 'Posts';
                        additionalInfo = `query=${encodeURIComponent('Reported Posts')}&report_count=${encodeURIComponent(queryResult.report_count)}`;
                        res += `
                            <a href="entity_description.php?entity=${entity}&id=${queryResult.post_id}&${additionalInfo}">
                            <div class="result-card">
                                <div class="result-title">ID: ${queryResult.post_id}</div>
                                <div class="result-info">
                                    <p>Reports count: ${queryResult.report_count}</p>
                                </div>
                            </div>
                            </a>
                        `;
                    } else if (queryType === 'most_liked_threads') {
                        additionalInfo = `query=${encodeURIComponent('Most Liked Threads')}&upvote_count=${encodeURIComponent(queryResult.upvote_count)}`;
                        res += `
                            <a href="entity_description.php?entity=${entity}&id=${queryResult.post_id}&${additionalInfo}">
                            <div class="result-card">
                                <div class="result-title">ID: ${queryResult.post_id}</div>
                                <div class="result-info">
                                    <p>Thread title: ${queryResult.title}</p>
                                    <p>Upvotes count: ${queryResult.upvote_count}</p>
                                </div>
                            </div>
                            </a>
                        `;
                    } else {
                        res += `
                            <div class="result-card">
                                <div class="result-title">Unknown Query Result</div>
                            </div>
                        `;
                    }
                });
                res += '</div>';
                results.innerHTML = res;
                
                localStorage.removeItem('queryResults');
            } else if (status === 'error') {
                icon.textContent = '❌';
                title.textContent = 'Error';
                messageb.textContent = message;
                messageb.style.color = 'var(--color-gray-dark)';
            } else {
                icon.textContent = '⚠️';
                title.textContent = 'No Information';
                messageb.textContent = 'No feedback available!';
                messageb.style.color = 'var(--color-gray-dark)';
            }
        });
    </script>
</body>
</html>