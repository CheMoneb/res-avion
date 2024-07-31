<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$lang = $_SESSION['lang'] ?? 'en';

if (isset($_POST['lang'])) {
    $lang = $_POST['lang'];
    $_SESSION['lang'] = $lang;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function __($key) {
    global $translations;
    return $translations[$key] ?? $key;
}

$filePath = __DIR__ . "/translations_$lang.json";
if (file_exists($filePath)) {
    $translations = json_decode(file_get_contents($filePath), true);
} else {
    $translations = [];
}
?>