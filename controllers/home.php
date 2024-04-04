<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Home Page";


$context = [
    'setting'=> $setting,
    'title'=> $title,
    'news'=> []
];

landing_view('home', $context);