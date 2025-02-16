<!-- Security & Injection Prevention
What's wrong with the following code? How would you fix it?
```php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
```

============================Answer===============================

Main issue in the give code sql injection in $_GET['id'],
To prevent sql injection we can use mysqli_real_escape_string().

code: -->

<?php
    $id = mysqli_real_escape_string($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
?>