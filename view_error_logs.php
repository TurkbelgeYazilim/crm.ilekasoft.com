<?php
// Error log viewer
$log_file = 'application/logs/log-' . date('Y-m-d') . '.php';

echo "<h1>📄 Error Log Viewer</h1>";
echo "<p>Log file: $log_file</p>";

if (file_exists($log_file)) {
    echo "<h2>📋 Recent Log Entries (Last 50 lines)</h2>";
    
    $lines = file($log_file);
    $recent_lines = array_slice($lines, -50);
    
    echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 5px; font-family: monospace; white-space: pre-wrap; overflow-x: auto;'>";
    foreach ($recent_lines as $line) {
        // Highlight our debug messages
        if (strpos($line, 'HandleFileUpdates') !== false || 
            strpos($line, 'Cari Update Debug') !== false) {
            echo "<span style='background: yellow; font-weight: bold;'>$line</span>";
        } else {
            echo htmlspecialchars($line);
        }
    }
    echo "</div>";
    
    echo "<h2>🔍 Search for Debug Messages</h2>";
    $debug_lines = array_filter($lines, function($line) {
        return strpos($line, 'HandleFileUpdates') !== false || 
               strpos($line, 'Cari Update Debug') !== false ||
               strpos($line, 'deleted_images') !== false ||
               strpos($line, 'deleted_documents') !== false;
    });
    
    if (!empty($debug_lines)) {
        echo "<div style='background: #e8f5e8; padding: 15px; border-radius: 5px; font-family: monospace; white-space: pre-wrap;'>";
        foreach ($debug_lines as $line) {
            echo "<span style='color: green; font-weight: bold;'>" . htmlspecialchars($line) . "</span>";
        }
        echo "</div>";
    } else {
        echo "<p>❌ No debug messages found. Try updating a cari record first.</p>";
    }
    
} else {
    echo "<p>❌ Log file not found: $log_file</p>";
    echo "<p>Available log files:</p>";
    $log_dir = 'application/logs/';
    if (is_dir($log_dir)) {
        $files = scandir($log_dir);
        foreach ($files as $file) {
            if (strpos($file, 'log-') === 0) {
                echo "- $file<br>";
            }
        }
    }
}

// PHP error log da kontrol et
echo "<h2>🔧 PHP Error Log</h2>";
$php_error_log = ini_get('error_log');
if ($php_error_log && file_exists($php_error_log)) {
    echo "<p>PHP Error Log: $php_error_log</p>";
    $php_lines = file($php_error_log);
    $recent_php_lines = array_slice($php_lines, -20);
    
    echo "<div style='background: #fff3cd; padding: 15px; border-radius: 5px; font-family: monospace; white-space: pre-wrap;'>";
    foreach ($recent_php_lines as $line) {
        if (strpos($line, 'HandleFileUpdates') !== false) {
            echo "<span style='background: yellow; font-weight: bold;'>$line</span>";
        } else {
            echo htmlspecialchars($line);
        }
    }
    echo "</div>";
} else {
    echo "<p>PHP Error Log location: " . ($php_error_log ?: 'Not set') . "</p>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
h1, h2 { color: #333; }
</style>

<br>
<a href="?" style="background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">🔄 Refresh</a>
