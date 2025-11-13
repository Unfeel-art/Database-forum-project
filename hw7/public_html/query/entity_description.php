<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../components/head.php'; ?>
<body>
    <?php include __DIR__ . '/../components/header.php'; ?>
    
<main class="form-page">
    <div class="base-div">
        <h2>Description</h2>
        <div class="form-box" id="description-container">
            <h3 id="entity-title"></h3>   
            <p id="description-message"></p>
            <div id="description"></div>
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
            const entity = urlParams.get('entity');
            const id = urlParams.get('id');
            const query = urlParams.get('query');
            const author = urlParams.get('author');
            const category = urlParams.get('category');
            const report_count = urlParams.get('report_count');
            const upvote_count = urlParams.get('upvote_count');
            
            
            const entityTitle = document.getElementById('entity-title');
            const descriptionMessage = document.getElementById('description-message');
            const descriptionDiv = document.getElementById('description');

            fetch(`/~achernii/api/index.php?table=${entity}&id=${id}`)
            .then(res => res.json())
            .then(data => {
                let desc = '<div class="description-content">';
                entityTitle.textContent = `${entity} Details (ID: ${id})`;
                descriptionMessage.textContent = `Here are the details for the selected ${entity.toLowerCase()}.`;
                desc += `<strong>General Info:</strong><br>`;
                for (const [key, value] of Object.entries(data)) {
                    desc += `<span>${key}</span>: ${value}<br>`;
                }
                desc += `<br><strong>Additional Info:</strong><br>`;
                const additional = {
                    'Query Type': query,
                    'Author': author,
                    'Category': category,
                    'Report Count': report_count,
                    'Upvote Count': upvote_count
                }
                for (const [key, value] of Object.entries(additional)) {
                    if (value !== null)
                        desc += `<span>${key}</span>: ${value}<br>`;
                }
                desc += '</div>';
                descriptionDiv.innerHTML = desc;
            })
            .catch(err => {
                entityTitle.textContent = 'Error';
                descriptionMessage.textContent = 'Failed to load entity description.';
                console.log(err);
            });
        });
    </script>
</body>
</html>