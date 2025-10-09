/* Q1: Get the most active users (by number of posts) */
SELECT u.user_id, u.username, COUNT(p.post_id)
FROM Users u
JOIN Posts p ON u.user_id = p.user_id
GROUP BY u.user_id, u.username
ORDER BY COUNT(p.post_id) DESC;

/* Q2: Get the most active users (by number of votes) */
SELECT u.user_id, u.username, COUNT(r.action_id)
FROM Users u
JOIN Posts p ON u.user_id = p.user_id
JOIN Targets tg ON p.post_id = tg.post_id
JOIN Reactions r ON tg.action_id = r.action_id
GROUP BY u.user_id, u.username
ORDER BY COUNT(r.action_id) DESC;

/* Q3: Get all threads of a specific category with their authors */
SELECT t.post_id, t.title, u.username
FROM Threads t
JOIN Posts p ON t.post_id = p.post_id
JOIN Users u ON p.user_id = u.user_id
JOIN Contains con ON con.thread_post_id = t.post_id
JOIN Categories c ON c.category_id = con.category_id
WHERE c.name = 'Programming';

/* Q4: Get post ids with reports exceeding a threshold */
SELECT tg.post_id, COUNT(r.action_id)
FROM Reports r
JOIN Targets tg ON r.action_id = tg.action_id
GROUP BY tg.post_id
HAVING COUNT(r.action_id) > 0
ORDER BY COUNT(r.action_id) DESC;

/* Q5: Get users with reports exceeding a threshold */
SELECT u.user_id, u.username, COUNT(r.action_id)
FROM Users u
JOIN Posts p ON u.user_id = p.user_id
JOIN Targets tg ON p.post_id = tg.post_id
JOIN Reports r ON tg.action_id = r.action_id
GROUP BY u.user_id, u.username
HAVING COUNT(r.action_id) > 0
ORDER BY COUNT(r.action_id) DESC;

/* Q6: Get the most loved threads (by upvotes) */
SELECT t.post_id, t.title, COUNT(r.action_id)
FROM Threads t
JOIN Contains con ON con.thread_post_id = t.post_id
JOIN Categories c ON c.category_id = con.category_id
JOIN Targets tg ON tg.post_id = t.post_id
JOIN Reactions r ON r.action_id = tg.action_id
WHERE r.reaction_type = 'up'
GROUP BY t.post_id, t.title
ORDER BY COUNT(r.action_id) DESC;

/* Q7: Get the most loved threads of a specific category */
SELECT t.post_id, t.title, COUNT(r.action_id)
FROM Threads t
JOIN Posts p ON t.post_id = p.post_id
JOIN Users u ON p.user_id = u.user_id
JOIN Contains con ON con.thread_post_id = t.post_id
JOIN Categories c ON c.category_id = con.category_id
JOIN Targets tg ON t.post_id = tg.post_id
JOIN Reactions r ON tg.action_id = r.action_id
WHERE r.reaction_type = 'up' AND c.name = 'Programming'
GROUP BY t.post_id, t.title, u.username
ORDER BY COUNT(r.action_id) DESC;

/* Q8: Get categories with the most threads */
SELECT c.category_id, c.name, COUNT(t.post_id)
FROM Categories c
JOIN Contains con ON c.category_id = con.category_id
JOIN Threads t ON con.thread_post_id = t.post_id
GROUP BY c.category_id, c.name
ORDER BY COUNT(t.post_id) DESC;

/* Q9: Get threads with no replies or votes*/
SELECT t.title
FROM Threads t
LEFT JOIN Replies rp ON rp.reply_post_id = t.post_id
LEFT JOIN Targets tg ON tg.post_id = t.post_id
LEFT JOIN Reactions r ON r.action_id = tg.action_id
WHERE rp.post_id IS NULL AND r.action_id IS NULL;