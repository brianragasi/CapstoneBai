<?php
/**
 * Philippine Capstone Title Generator - Helper Functions
 * Contains utility functions for the title generation system
 */

/**
 * Load titles from JSON file
 * @param string $filename Path to the JSON file
 * @return array|false Array of titles or false on failure
 */
function loadTitles($filename = 'titles.json') {
    if (!file_exists($filename)) {
        return false;
    }
    
    $json_content = file_get_contents($filename);
    $titles = json_decode($json_content, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        return false;
    }
    
    return $titles;
}

/**
 * Get a random title based on programming language and database
 * @param array $titles All titles data
 * @param string $language Programming language
 * @param string $database Database type
 * @return string|false Random title or false if none available
 */
function getRandomTitle($titles, $language, $database) {
    if (!is_array($titles)) return false;
    $language = trim($language);
    $database = trim($database);

    // Case-insensitive key lookup for language
    $langKey = null;
    foreach ($titles as $k => $v) {
        if (strtolower($k) === strtolower($language)) { $langKey = $k; break; }
    }
    if ($langKey === null) return false;

    // Case-insensitive key lookup for database within language
    if (!is_array($titles[$langKey])) return false;
    $dbKey = null; $available_titles = [];
    foreach ($titles[$langKey] as $k => $v) {
        if (strtolower($k) === strtolower($database)) { $dbKey = $k; $available_titles = $v; break; }
    }
    if ($dbKey === null || empty($available_titles) || !is_array($available_titles)) return false;

    $random_index = array_rand($available_titles);
    return $available_titles[$random_index];
}

/**
 * Try to select titles that mention Cagayan de Oro or known CDO context
 * Falls back to all titles if no CDO-specific matches
 */
function getCDORelevantTitle($titles, $language, $database) {
    $title = getRandomTitle($titles, $language, $database);
    if ($title === false) return false;

    $langKey = null; $dbKey = null;
    foreach ($titles as $k => $v) { if (strtolower($k) === strtolower($language)) { $langKey = $k; break; } }
    if ($langKey === null) return $title;
    foreach ($titles[$langKey] as $k => $v) { if (strtolower($k) === strtolower($database)) { $dbKey = $k; break; } }
    if ($dbKey === null) return $title;

    $list = $titles[$langKey][$dbKey];
    $cdoKeywords = [
        'cagayan de oro', 'cdo', 'northern mindanao', 'misamis oriental',
        'lumbia', 'lapasan', 'bulua', 'agusan', 'carmen', 'macasandig',
        'barangay 1', 'barangay 2', 'uptown', 'downtown', 'divisoria', 'limketkai', 'ukc', 'cogon market', 'macabalan port', 'naawan'
    ];

    $filtered = array_values(array_filter($list, function($t) use ($cdoKeywords) {
        $lt = strtolower($t);
        foreach ($cdoKeywords as $kw) {
            if (strpos($lt, $kw) !== false) return true;
        }
        return false;
    }));

    if (!empty($filtered)) {
        return $filtered[array_rand($filtered)];
    }

    // If no explicit CDO match, lightly localize generic place words to CDO landmarks
    $localizedMap = [
        '/\bbarangay\b/i' => 'Barangay Carmen (CDO)',
        '/\bcity\b/i' => 'Cagayan de Oro City',
        '/\bmarket\b/i' => 'Cogon Market (CDO)',
        '/\bport\b/i' => 'Macabalan Port (CDO)',
        '/\bmall\b/i' => 'Limketkai Center (CDO)',
        '/\bhospital\b/i' => 'Northern Mindanao Medical Center (CDO)'
    ];
    $newTitle = $title;
    foreach ($localizedMap as $pattern => $replacement) {
        $newTitle = preg_replace($pattern, $replacement, $newTitle);
    }
    return $newTitle;
}

/**
 * Validate form inputs
 * @param string $language Programming language
 * @param string $database Database type
 * @return array Array with 'valid' boolean and 'errors' array
 */
function validateInputs($language, $database) {
    $errors = [];
    $valid_languages = ['php', 'python', 'java', 'javascript', 'csharp'];
    $valid_databases = ['mysql', 'sqlite', 'mongodb', 'postgresql', 'firebase'];
    
    if (empty($language)) {
        $errors[] = "Programming language is required.";
    } elseif (!in_array(strtolower($language), $valid_languages)) {
        $errors[] = "Invalid programming language selected.";
    }
    
    if (empty($database)) {
        $errors[] = "Database is required.";
    } elseif (!in_array(strtolower($database), $valid_databases)) {
        $errors[] = "Invalid database selected.";
    }
    
    return [
        'valid' => empty($errors),
        'errors' => $errors
    ];
}

/**
 * Sanitize input data
 * @param string $input Input to sanitize
 * @return string Sanitized input
 */
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

/**
 * Get available databases for a programming language
 * @param array $titles All titles data
 * @param string $language Programming language
 * @return array Array of available databases
 */
function getAvailableDatabases($titles, $language) {
    $language = strtolower(trim($language));
    
    if (!isset($titles[$language])) {
        return [];
    }
    
    return array_keys($titles[$language]);
}

/**
 * Create backup of titles.json
 * @param string $source_file Source JSON file
 * @param string $backup_dir Backup directory
 * @return bool Success status
 */
function createBackup($source_file = 'titles.json', $backup_dir = 'backup/') {
    if (!file_exists($source_file)) {
        return false;
    }
    
    if (!is_dir($backup_dir)) {
        mkdir($backup_dir, 0755, true);
    }
    
    $timestamp = date('Y-m-d_H-i-s');
    $backup_filename = $backup_dir . "titles_backup_{$timestamp}.json";
    
    return copy($source_file, $backup_filename);
}

/**
 * Log error messages
 * @param string $message Error message
 * @param string $log_file Log file path
 */
function logError($message, $log_file = 'error.log') {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[$timestamp] $message" . PHP_EOL;
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

/**
 * Format programming language name for display
 * @param string $language Programming language
 * @return string Formatted language name
 */
function formatLanguageName($language) {
    $language_names = [
        'php' => 'PHP',
        'python' => 'Python',
        'java' => 'Java',
        'javascript' => 'JavaScript',
        'csharp' => 'C#'
    ];
    
    return $language_names[strtolower($language)] ?? ucfirst($language);
}

/**
 * Format database name for display
 * @param string $database Database type
 * @return string Formatted database name
 */
function formatDatabaseName($database) {
    $database_names = [
        'mysql' => 'MySQL',
        'sqlite' => 'SQLite',
        'mongodb' => 'MongoDB',
        'postgresql' => 'PostgreSQL',
        'firebase' => 'Firebase'
    ];
    
    return $database_names[strtolower($database)] ?? ucfirst($database);
}
?>
