<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'achernii', 'tO9Wk1kU2uNSlGC1', 'db_achernii');

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed']));
}

$conn->set_charset('utf8mb4');

$query = $_GET['query'] ?? null;
$category = $_GET['category'] ?? '';   
$limit = (int)($_GET['limit'] ?? 0);
$threshold = (int)($_GET['threshold'] ?? 0);

switch ($query) {
    case 'threads_by_category':
        $sql = "SELECT t.post_id, t.title, u.username, c.name as category_name
                FROM Threads t
                JOIN Posts p ON t.post_id = p.post_id
                JOIN Users u ON p.user_id = u.user_id
                JOIN Contains con ON con.thread_post_id = t.post_id
                JOIN Categories c ON c.category_id = con.category_id
                WHERE c.name = ?";
        if ($limit > 0) $sql .= " LIMIT ?";
        $stmt = $conn->prepare($sql);
        if ($limit > 0) {
            $stmt->bind_param('si', $category, $limit);
        } else {
            $stmt->bind_param('s', $category);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        echo json_encode($res->fetch_all(MYSQLI_ASSOC));
        break;

    case 'reported_posts':
        $sql = "SELECT tg.post_id, COUNT(r.action_id) as report_count
                FROM Reports r
                JOIN Targets tg ON r.action_id = tg.action_id
                GROUP BY tg.post_id
                HAVING report_count > ?
                ORDER BY report_count DESC";
        if ($limit > 0) $sql .= " LIMIT ?";
        $stmt = $conn->prepare($sql);   
        if ($limit > 0) {
            $stmt->bind_param('ii', $threshold, $limit);
        } else {
            $stmt->bind_param('i', $threshold);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        echo json_encode($res->fetch_all(MYSQLI_ASSOC));
        break;

    case 'most_liked_threads':
        $sql = "SELECT t.post_id, t.title, COUNT(r.action_id) as upvote_count
                FROM Threads t
                LEFT JOIN Targets tg ON tg.post_id = t.post_id
                LEFT JOIN Reactions r ON r.action_id = tg.action_id AND r.reaction_type = 'up'
                GROUP BY t.post_id, t.title
                ORDER BY upvote_count DESC";
        if ($limit > 0) $sql .= " LIMIT ?";
        $stmt = $conn->prepare($sql);
        if ($limit > 0) {
            $stmt->bind_param('i', $limit);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        echo json_encode($res->fetch_all(MYSQLI_ASSOC));
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid query']);
}

$conn->close();
?>