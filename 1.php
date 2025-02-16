<!-- 
 Debugging & Optimization
You have the following PHP function, which is running slower than expected. Optimize it for
performance.
```php
function getUserPosts($userId) {
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $stmt = $db->prepare("SELECT * FROM posts WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
```

=========================Answer===============================

Given code will create PDO instance each time the function is called.
So, we can create PDO instance once and will pass it to the getUserPosts() as an argument, just like we do it for prisma. -->

<?php
$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');


function getUserPosts($db, $userId) {
    $stmt = $db->prepare("SELECT * FROM posts WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>