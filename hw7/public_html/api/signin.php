<?php
session_start();
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'achernii', 'tO9Wk1kU2uNSlGC1', 'db_achernii');

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['success' => false, 'error' => 'Database connection failed']));
}

$conn->set_charset('utf8mb4');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'signin':
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'error' => 'Username and password are required']);
            exit;
        }

        $stmt = $conn->prepare("SELECT user_id, password FROM Users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
            exit;
        }
        $user = $res->fetch_assoc();
        if (!password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
            exit;
        }
        $stmt = $conn->prepare("SELECT user_id FROM Moderators WHERE user_id = ?");
        $stmt->bind_param("i", $user['user_id']);
        $stmt->execute();
        $modRes = $stmt->get_result();
        $isMod = $modRes->num_rows > 0;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $username;
        $_SESSION['is_moderator'] = $isMod;
        echo json_encode(['success' => true, 'username' => $username, 'is_moderator' => $isMod]);
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}

$conn->close();
?>