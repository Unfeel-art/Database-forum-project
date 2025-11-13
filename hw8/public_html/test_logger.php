<?php
header('Content-Type: application/json');
$accessLog = '/var/log/apache2/access_log';
$errorLog = '/var/log/apache2/error_log';
$path = '/~achernii';
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$accessStats = [
    'pages' => [],
    'ips' => [],
    'browsers' => [],
    'timeline' => []
];
$rawAccessLogs = [];
$accessLines = [];

if (file_exists($accessLog)) {
    $lines = file($accessLog, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        if (preg_match('/^(\S+).*\[(.*?)\] "(\w+) (\S+).*" (\d+) \S+ ".*" "(.*)"/', $line, $m)) {
            $page = $m[4];
            if (strpos($page, $path) !== false) {
                $accessLines[] = ['line' => $line, 'match' => $m];
            }
        }
    }
    if ($limit > 0) {
        $accessLines = array_slice($accessLines, -$limit);
    }
    foreach ($accessLines as $l) {
        $line = $l['line'];
        $m = $l['match'];

        $ip = $m[1];
        $time = $m[2];
        $page = $m[4];
        $status = $m[5];
        $browser = $m[6] ?? 'Unknown';

        $rawAccessLogs[] = $line;
        $accessStats['pages'][$page] = ($accessStats['pages'][$page] ?? 0) + 1;
        $accessStats['ips'][$ip] = ($accessStats['ips'][$ip] ?? 0) + 1;
        $browserName = browserName($browser);
        $accessStats['browsers'][$browserName] = ($accessStats['browsers'][$browserName] ?? 0) + 1;
        $accessStats['timeline'][] = [
            'time' => $time,
            'ip' => $ip,
            'page' => $page,
            'status' => $status
        ];
    }
}

$errorStats = [
    'errors' => [],
    'error_ips' => [],
    'timeline' => []
];
$rawErrorLogs = [];
$errorLines = [];

if (file_exists($errorLog)) {
    $lines = file($errorLog, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        if (preg_match('/\[(.*?)\].*\[client (\S+)\] (.*)/', $line, $m)) {
            $error = $m[3];
            if (strpos($error, $path) !== false) {
                $errorLines[] = ['line' => $line, 'match' => $m];
            }
        }
    }
    if ($limit > 0) {
        $errorLines = array_slice($errorLines, -$limit);
    }
    foreach ($errorLines as $l) {
        $line = $l['line'];
        $m = $l['match'];
        
        $time = $m[1];
        $ip = $m[2];
        $error = $m[3];
        
        $rawErrorLogs[] = $line;
        $errorType = errorType($error);
        $errorStats['errors'][$errorType] = ($errorStats['errors'][$errorType] ?? 0) + 1;
        $errorStats['error_ips'][$ip] = ($errorStats['error_ips'][$ip] ?? 0) + 1;
        $errorStats['timeline'][] = [
            'time' => $time,
            'ip' => $ip,
            'error' => $error
        ];
    }
}

function browserName($b) {
    if (strpos($b, 'Firefox') !== false) return 'Firefox';
    if (strpos($b, 'Edg') !== false) return 'Edge';
    if (strpos($b, 'Chrome') !== false) return 'Chrome';
    if (strpos($b, 'Safari') !== false) return 'Safari';
    return 'Other';
}

function errorType($e) {
    if (strpos($e, '404') !== false) return '404 Not Found';
    if (strpos($e, '500') !== false) return '500 Internal Server Error';
    if (strpos($e, '403') !== false) return '403 Forbidden';
    return 'Other Error';
}

$result = [
    'stats' => [
        'total_requests' => count($accessStats['timeline']),
        'total_errors' => count($errorStats['timeline']),
        'unique_ips' => count($accessStats['ips'])
    ],
    'access' => [
        'pages' => $accessStats['pages'],
        'ips' => $accessStats['ips'],
        'browsers' => $accessStats['browsers'],
        'timeline' => $accessStats['timeline']
    ],
    'errors' => [
        'error_types' => $errorStats['errors'],
        'error_ips' => $errorStats['error_ips'],
        'timeline' => $errorStats['timeline']
    ],
    'raw_logs' => [
        'access' => $rawAccessLogs,
        'errors' => $rawErrorLogs
    ]
];

echo json_encode($result, JSON_PRETTY_PRINT);
?>