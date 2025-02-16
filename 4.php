<!-- Error Handling & Logging
A third-party API returns unpredictable JSON responses, sometimes with missing fields. How would you handle parsing it in PHP to 
prevent errors?

===========================Answer===============================

In this case we can use  null coalescing operator( ?? ).
Here is an simple code snippet: -->

<?php
    $response = file_get_contents('https://fake.api.xyz/data');
    $data = json_decode($response, true);

    echo "Name: " . (isset($data['name']) ? $data['name'] : 'Unknown') . "<br>";
    echo "Email: " . ($data['email'] ?? 'No email provided') . "<br>";
?>