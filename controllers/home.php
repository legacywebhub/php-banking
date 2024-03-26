<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Home Page";

// Fetching finance news
try {
    $url = "https://newsapi.org/v2/everything?q=finance&apiKey=9ab989f35bb6450c8e2a717543c0c129";
    
    // Make the API request using the GET method
    $response = file_get_contents($url) ?? "An error occured";

    // Check if response is not empty
    if ($response !== false) {
        // Decode JSON response content
        $response = json_decode($response, true);
        $news = [];

        // We only want 3 random articles per page load
        // Generate 3 random numbers within 0 to 99
        $random_numbers = array_rand(range(0, 99), 3);

        // Loop through random numbers to select random news/articles
        foreach ($random_numbers as $random_number) {
            $news[] = $response["articles"][$random_number];
        }
    } else {
        $news = [];
    }
} catch (Exception $e) {
    $news = [];
}

//print_r($news); die();

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'news'=> $news
];

landing_view('home', $context);