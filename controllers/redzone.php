
<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Red Zone";


// Handling request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Subfolder
    $subfolder = $_POST['subfolder'];

    try {
        // Get list of files in the subdirectory
        $files = glob(APP_PATH.$subfolder.'/*');

        // Loop through the files and delete each one
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        redirect('redzone', "Operation successful", 'success');
    } catch(Exception $e) {
        redirect('redzone', "An error occured", 'success');
    }
}

$context = [
    'setting'=> $setting,
    'title'=> $title,
];

landing_view('redzone', $context);
