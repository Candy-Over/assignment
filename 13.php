<!-- Caching Strategies
Your Laravel app frequently queries a large dataset that rarely changes. How would you use caching to improve performance?

===========================Answer===============================

To improve performance in our Laravel app by caching large datasets that rarely change, we can use Laravel’s Cache system. -->

<?php
use Illuminate\Support\Facades\Cache;

$users = Cache::remember('all_users', 3600, function () {
    return User::all();  // Let say this query is expensive
});

// The above code will cache the result of the User::all() query for 1 hour (3600 seconds).
