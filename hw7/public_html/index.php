<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php'; ?>

<body>
    <?php include  __DIR__ . '/components/header.php'; ?>

    <main>
        <div class="hero">
            <div class="base-div">
                <h2>Welcome to Forum</h2>
                <p>Talk, discuss, connect, share, and engage with our community.</p>
                <div class="search">
                    <input type="text" class="search-inp" placeholder="Find a thread for you...">
                    <button class="search-btn">Search</button>
                </div>
            </div>
        </div>

        <div id="categories" class="categories">
            <div class="base-div">
                <h3>Popular Categories</h3>
                <div class="category-list">
                    <div class="category-card">
                        <h4>General Discussion</h4>
                        <p>Talk about anything and everything</p>
                        <span class="post-cnt">9 posts</span>
                    </div>
                    <div class="category-card">
                        <h4>Programming</h4>
                        <p>Latest programming news and discussions</p>
                        <span class="post-cnt">7 posts</span>
                    </div>
                    <div class="category-card">
                        <h4>Games</h4>
                        <p>Recent game news and updates</p>
                        <span class="post-cnt">6 posts</span>
                    </div>
                    <div class="category-card">
                        <h4>Sports</h4>
                        <p>Everything about sport</p>
                        <span class="post-cnt">2 posts</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="threads" class="threads">
            <div class="base-div">
                <h3>Popular Threads</h3>
                <div class="thread-list">
                    <div class="thread-card">
                        <div class="thread-card-top">
                            <h4>How to get started with web development?</h4>
                            <span class="thread-info">Posted by Javidan • 2 hours ago</span>
                        </div>
                        <p class="thread-card-prev">I'm interested in learning web development but don't know where to start. Any recommendations for newbies?</p>
                        <div class="thread-card-footer">
                            <span class="thread-stats">2 replies</span>
                            <span class="thread-stats">5 upvotes</span>
                            <span class="category-tag">Programming</span>
                        </div>
                    </div>

                    <div class="thread-card">
                        <div class="thread-card-top">
                            <h4>SQL queries issues</h4>
                            <span class="thread-info">Posted by Artem • 5 hours ago</span>
                        </div>
                        <p class="thread-card-prev">I have some issues writing SQL queries. Could you help me, please?</p>
                        <div class="thread-card-footer">
                            <span class="thread-stats">3 replies</span>
                            <span class="thread-stats">4 upvotes</span>
                            <span class="category-tag">Programming</span>
                        </div>
                    </div>

                    <div class="thread-card">
                        <div class="thread-card-top">
                            <h4>New upcoming release of Super Game 3000</h4>
                            <span class="thread-info">Posted by Temuri • 1 day ago</span>
                        </div>
                        <p class="thread-card-prev">Have you seen the news about Super Game 3000? Looks amazing, doesn't it?</p>
                        <div class="thread-card-footer">
                            <span class="thread-stats">11 replies</span>
                            <span class="thread-stats">43 upvotes</span>
                            <span class="category-tag">Games</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include  __DIR__ . '/components/footer.php'; ?>

    <script src="js/theme.js"></script>
</body>
</html>