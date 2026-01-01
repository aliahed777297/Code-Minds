<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=project_one;charset=utf8mb4', 'root', '');
    echo "Connected to MySQL\n";
    $stmt = $pdo->query('SHOW TABLES');
    $has = false;
    foreach ($stmt as $row) {
        $has = true;
        echo $row[0] . PHP_EOL;
    }
    if (! $has) {
        echo "(no tables found)\n";
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
