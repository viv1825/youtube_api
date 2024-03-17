<?php
return [
    'api_key' => env('API_KEY'),
    'search_endpoint' => 'www.googleapis.com/youtube/v3/search',
    'default_search_parameters' => [
        'part' => 'snippet',
        'country' => 'BD',
        'maxResults' => 40,
        'type' => 'video',
    ],
];

?>