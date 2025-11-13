<?php include __DIR__ . '/url.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/style.css">
    <link rel="icon" href="<?php echo $baseUrl; ?>/img/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script>
        const theme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', theme);
        console.log("<?php echo __DIR__ . '/css/style.css'; ?>");
    </script>
</head>