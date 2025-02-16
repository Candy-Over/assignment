<!-- Handling Large Data Efficiently
You need to process a large CSV file (5GB) and insert data into a database. How would you do this efficiently in PHP?

===========================Answer=============================== -->

<?php

$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');

// opening the csv file
if (($handle = fopen('large_file.csv', 'r')) !== false) {
    $batch = [];
    $batchSize = 1000;
    $pdo->beginTransaction();

    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        $batch[] = $data;

        if (count($batch) == $batchSize) {
            insertBatch($pdo, $batch);
            $batch = [];
        }
    }

    if (!empty($batch)) {
        insertBatch($pdo, $batch);
    }

    $pdo->commit();
    fclose($handle);
}

function insertBatch($pdo, $batch) {
    $values = [];
    $placeholders = [];

    foreach ($batch as $row) {
        $placeholders[] = '(?, ?, ?, ?)'; // Adjust for columns
        $values = array_merge($values, $row);
    }

    $sql = "INSERT INTO demo_table (col1, col2, col3, col4) VALUES " . implode(',', $placeholders);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);
}

echo "Data inserted successfully!";

?>