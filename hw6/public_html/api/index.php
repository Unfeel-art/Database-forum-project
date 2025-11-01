<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'achernii', 'tO9Wk1kU2uNSlGC1', 'db_achernii');

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed']));
}

$conn->set_charset('utf8mb4');

$method = $_SERVER['REQUEST_METHOD'];
$table = $_GET['table'] ?? null;
$id = $_GET['id'] ?? null;

$allowedTables = ['Actions', 'Categories', 'Contains', 'Moderators', 'Posts', 'Reactions', 'RegularUsers', 'Replies', 'Reports', 'Targets', 'Threads', 'Users'];

if (!in_array($table, $allowedTables, true)) {
    http_response_code(400);
    die(json_encode(['error' => 'Invalid table']));
}
$primaryKeys = [
    'Users' => 'user_id',
    'Moderators' => 'user_id',
    'RegularUsers' => 'user_id',
    'Posts' => 'post_id',
    'Threads' => 'post_id',
    'Replies' => 'post_id',
    'Categories' => 'category_id',
    'Actions' => 'action_id',
    'Reactions' => 'action_id',
    'Reports' => 'action_id',
    'Targets' => 'action_id'
];
switch ($method) {
    case 'GET':
        if ($id) {
            $idKey = $primaryKeys[$table] ?? 'id';
            $stmt = $conn->prepare("SELECT * FROM $table WHERE $idKey = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $res = $stmt->get_result();
            echo json_encode($res->fetch_assoc() ?: ['error' => 'Not found']);
        } else {
            $res = $conn->query("SELECT * FROM $table");
            $data = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($data);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            http_response_code(400);
            die(json_encode(['error' => 'Invalid JSON']));
        }

        $cols = array_keys($data);
        $vals = array_values($data);
        $placeholders = implode(',', array_fill(0, count($vals), '?'));
        $query = "INSERT INTO $table (" . implode(',', $cols) . ") VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            http_response_code(500);
            die(json_encode(['error' => 'Database error']));
        }

        $types = '';
        foreach ($vals as $v) {
            $types .= is_int($v) ? 'i' : 's';
        }

        $stmt->bind_param($types, ...$vals);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Database error']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Not allowed']);
}

$conn->close();
?>