<!-- Asynchronous Processing
A user uploads a file, and your PHP script processes it. How would you handle this asynchronously to prevent timeout issues?

===========================Answer=============================== -->

<!-- Instead of processing the file immediately, store it and push a job to a queue. -->

<?php
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $filePath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);

        // here we push a job to a queue
        exec("php process_file.php $filePath > /dev/null 2>&1 &");
        
        echo "File uploaded successfully. Processing in the background.";
    } else {
        echo "File upload failed.";
    }
?>