<?php

require_once __DIR__ . '/../src/JsonDB.php';

use Ahmar\Database\JsonDB;

$db = new JsonDB(__DIR__ . '/test_db.json');

// Wipe old test data
$db->truncate();

// Insert
$db->insert(['id' => 1, 'name' => 'John Doe', 'role' => 'user']);
$db->insert(['id' => 2, 'name' => 'Jane Smith', 'role' => 'admin']);

// Fetch all
echo "All Users:\n";
print_r($db->all());

// Update
$db->update('id', 1, ['role' => 'moderator']);
echo "\nAfter Update (John is moderator):\n";
print_r($db->find('id', 1));

// Delete
$db->delete('id', 2);
echo "\nAfter Delete (Jane removed):\n";
print_r($db->all());
