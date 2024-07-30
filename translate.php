<?php
function loadTranslations($lang) {
    $filePath = __DIR__ . "/translations_$lang.json";
    if (file_exists($filePath)) {
        $jsonContent = file_get_contents($filePath);
        return json_decode($jsonContent, true);
    } else {
        return [];
    }
}

function __($key) {
    global $translations;
    return $translations[$key] ?? $key;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$lang = $_SESSION['lang'] ?? 'en';
$translations = loadTranslations($lang);
?>