<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Privacy Policy";


$context = [
    'setting'=> $setting,
    'title'=> $title,
];

landing_view('privacy-policy', $context);