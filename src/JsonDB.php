<?php

namespace Ahmar\Database;

use Exception;

/**
 * A lightweight NoSQL-like JSON Database Manager.
 */
class JsonDB
{
    private string $filePath;
    private array $data;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }
        $this->loadData();
    }

    /**
     * Loads the JSON data into memory.
     */
    private function loadData(): void
    {
        $content = file_get_contents($this->filePath);
        $this->data = json_decode($content, true) ?? [];
    }

    /**
     * Commits the memory array back to the JSON file using file locks.
     */
    private function commit(): void
    {
        $fp = fopen($this->filePath, 'w');
        if (flock($fp, LOCK_EX)) {
            fwrite($fp, json_encode($this->data, JSON_PRETTY_PRINT));
            fflush($fp);
            flock($fp, LOCK_UN);
        } else {
            throw new Exception("Could not lock file for writing.");
        }
        fclose($fp);
    }

    /**
     * Returns all records.
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * Inserts a new record.
     */
    public function insert(array $record): array
    {
        $this->data[] = $record;
        $this->commit();
        return $record;
    }

    /**
     * Finds records based on key-value match.
     */
    public function find(string $key, $value): array
    {
        return array_values(array_filter($this->data, function ($item) use ($key, $value) {
            return isset($item[$key]) && $item[$key] === $value;
        }));
    }

    /**
     * Updates matching records.
     */
    public function update(string $key, $value, array $newData): int
    {
        $updatedCount = 0;
        foreach ($this->data as &$item) {
            if (isset($item[$key]) && $item[$key] === $value) {
                $item = array_merge($item, $newData);
                $updatedCount++;
            }
        }
        if ($updatedCount > 0) {
            $this->commit();
        }
        return $updatedCount;
    }

    /**
     * Deletes matching records.
     */
    public function delete(string $key, $value): int
    {
        $initialCount = count($this->data);
        $this->data = array_values(array_filter($this->data, function ($item) use ($key, $value) {
            return !(isset($item[$key]) && $item[$key] === $value);
        }));
        
        $deletedCount = $initialCount - count($this->data);
        if ($deletedCount > 0) {
            $this->commit();
        }
        return $deletedCount;
    }

    /**
     * Wipes the database.
     */
    public function truncate(): void
    {
        $this->data = [];
        $this->commit();
    }
}
