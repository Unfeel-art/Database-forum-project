INSERT INTO Users (user_id, username, email) VALUES
(1, 'temo', 'temo@mail.com'),
(2, 'artem', 'artem@mail.com'),
(3, 'javidan', 'javidan@mail.com'),
(4, 'alice', 'alice@mail.com'),
(5, 'bob', 'bob@mail.com'),
(6, 'carol', 'carol@mail.com'),
(7, 'admin', 'admin@mail.com');

INSERT INTO RegularUsers (user_id) VALUES (1), (2), (3), (4), (5), (6);

INSERT INTO Moderators (user_id) VALUES (7);

INSERT INTO Posts (post_id, content_body, user_id) VALUES
(1, 'Welcome to the forum!', 1),
(2, 'Lets discuss Python projects.', 2),
(3, 'Forum rules and guidelines.', 3),
(4, 'Discussing JS frameworks.', 4),
(5, 'Latest gaming news.', 5),
(6, 'Reply to Python thread.', 3),
(7, 'Reply to JS debate.', 4),
(8, 'Reply to welcome thread.', 6);

INSERT INTO Threads (post_id, title) VALUES
(1, 'Welcome Thread'),
(2, 'Python Projects'),
(3, 'Forum Rules'),
(4, 'JS Framework Debate'),
(5, 'Gaming News');

INSERT INTO Replies (post_id, reply_post_id) VALUES
(6, 2),
(7, 4),
(8, 1);

INSERT INTO Categories (category_id, name, description) VALUES
(1, 'Announcements', 'Official announcements.'),
(2, 'General', 'General discussions.'),
(3, 'Programming', 'Programming-related topics.'),
(4, 'Gaming', 'Games and related topics.');

INSERT INTO Contains (category_id, thread_post_id) VALUES
(1, 1),
(2, 5),
(3, 2),
(3, 3),
(3, 4);

INSERT INTO Actions (action_id, user_id) VALUES
(1, 5),
(2, 6),
(3, 1),
(4, 2),
(5, 3),
(6, 4),
(7, 5),
(8, 1),
(9, 2);

INSERT INTO Targets (action_id, post_id) VALUES
(1, 2),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 2),
(7, 2),
(8, 5),
(9, 5);

INSERT INTO Reactions (action_id, reaction_type) VALUES
(1, 'down'),
(2, 'up'),
(3, 'up'),
(8, 'up'),
(9, 'up');

INSERT INTO Reports (action_id, report_reason) VALUES
(4, 'Inappropriate'),
(5, 'Off topic'),
(6, 'Spam'),
(7, 'Low quality');