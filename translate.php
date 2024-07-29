<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function loadTranslations($lang) {
    $filePath = __DIR__ . "/translations_$lang.json";
    if (file_exists($filePath)) {
        $translations = json_decode(file_get_contents($filePath), true);
        if ($translations) {
            return $translations;
        } else {
            error_log("Failed to decode JSON for $lang");
        }
    } else {
        error_log("File $filePath does not exist");
    }
    // Default to English if the specified language file does not exist or fails to load
    $defaultFilePath = __DIR__ . "/translations_en.json";
    if (file_exists($defaultFilePath)) {
        return json_decode(file_get_contents($defaultFilePath), true);
    } else {
        error_log("Default translation file $defaultFilePath does not exist");
        return [];
    }
}

function __($key) {
    $lang = $_SESSION['lang'] ?? 'en';
    $translations = loadTranslations($lang);
    return $translations[$key] ?? $key;
}
?>