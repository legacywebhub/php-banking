
<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Red Zone";

// Handling incoming AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $controller_landing = APP_PATH.'controllers';
    $controller_account = APP_PATH.'controllers/account';
    $controller_admin = APP_PATH.'controllers/admin';
    $static_landing = STATIC_PATH .'landing';
    $static_dashboard = STATIC_PATH .'dashboard';
    $views_account = VIEW_PATH.'account';
    $views_admin = VIEW_PATH.'admin';
    $views_landing = VIEW_PATH.'landing';


    $subdirectory = 'path/to/your/subdirectory';

    // Get list of files in the subdirectory
    $files = glob($subdirectory. '/*');

    // Loop through the files and delete each one
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
];

landing_view('redzone', $context);
