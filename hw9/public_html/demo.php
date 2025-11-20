<?php include __DIR__ . '/logger/logger.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php'; ?>

<body>
    <?php include __DIR__ . '/components/header.php'; ?>
    <main class="form-page">
        <div class="base-div">
            <h2>Search Demo</h2>
            <div class="form-box">
                <div class="form-field">
                    <label for="search-user">Username</label>
                    <input type="text" id="search-user" placeholder="Search for a user by username...">
                </div>
                <div class="form-field">
                    <label for="search-thread">Thread</label>
                    <input type="text" id="search-thread" placeholder="Search for a thread by title...">
                </div>
                <div class="form-field">
                    <label for="search-category">Category</label>
                    <input type="text" id="search-category" placeholder="Search for a category by title...">
                </div>
                <div class="form-field">
                    <label for="search-posts">Posts</label>
                    <input type="text" id="search-posts" placeholder="Search for a post by content...">
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#search-user").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/~achernii/api/index.php",
                    dataType: "json",
                    data: {
                        search: request.term,
                        table: 'Users'
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.username,
                                value: item.username,
                                id: item.user_id
                            };
                        }));
                    }
                });
            }
        });

        $("#search-thread").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/~achernii/api/index.php",
                    dataType: "json",
                    data: {
                        search: request.term,
                        table: 'Threads'
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.title,
                                value: item.title,
                                id: item.thread_id
                            };
                        }));
                    }
                });
            }
        });

        $("#search-category").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/~achernii/api/index.php",
                    dataType: "json",
                    data: {
                        search: request.term,
                        table: 'Categories'
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.name,
                                value: item.name,
                                id: item.category_id
                            };
                        }));
                    }
                });
            }
        });

        $("#search-posts").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/~achernii/api/index.php",
                    dataType: "json",
                    data: {
                        search: request.term,
                        table: 'Posts'
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.content_body,
                                value: item.content_body,
                                id: item.post_id
                            };
                        }));
                    }
                });
            }
        });
    </script>
</body>
</html>