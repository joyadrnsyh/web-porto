<?php
require_once 'config.php';

// Ensure output directory exists
if (!file_exists(__DIR__ . '/data/exports')) {
    mkdir(__DIR__ . '/data/exports', 0777, true);
}

function exportTable($tableName) {
    try {
        $pdo = getDB();
        $stmt = $pdo->query("SELECT * FROM $tableName");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Transform for MongoDB if needed
        foreach ($rows as &$row) {
            // Convert ID to integer if it's numeric string
            if (isset($row['id'])) $row['id'] = (int)$row['id'];
            
            // Handle specific fields
            if ($tableName === 'projects') {
                if (!empty($row['tags']) && is_string($row['tags'])) {
                    $row['tags'] = array_map('trim', explode(',', $row['tags']));
                }
            }
        }
        
        $json = json_encode($rows, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "/data/exports/{$tableName}.json", $json);
        echo "Exported $tableName: " . count($rows) . " rows.\n";
    } catch (Exception $e) {
        echo "Skipping $tableName: " . $e->getMessage() . "\n";
    }
}

echo "Starting Export...\n";
exportTable('projects');
exportTable('project_gallery');
exportTable('site_settings');
exportTable('skills');
echo "Export Complete. Files saved in data/exports/\n";
