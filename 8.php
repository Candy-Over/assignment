<!-- File Handling & Security
Write a secure PHP function to upload an image file, ensuring it prevents security risks like script execution.

===========================Answer=============================== -->

<?php
function uploadImage($file) {
    $destination = "uploads/img/";
    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        
    if ( getimagesize($file["tmp_name"]) === false) {
        die("File is not an image.");
    }

    $imageTypes = ['jpg', 'jpeg', 'png'];
    if (!in_array($extension, $imageTypes)) {
        die("Not an image");
    }

    $newFileName = $destination . round(microtime(true)) . '.' . $extension;

    if (move_uploaded_file($file["tmp_name"], $newFileName)) {
            echo "File uploaded successfully: " . htmlspecialchars($newFileName);
    } else {
        die("Error uploading file.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    uploadImage($_FILES["image"]);
}

?>
