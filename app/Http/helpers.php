<?php

if (!function_exists('currentRoute')) {
    function currentRoute($route)
    {
        return Route::currentRouteNamed($route) ? ' class=current' : '';
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return ucfirst(utf8_encode ($date->formatLocalized('%d %B %Y')));
    }
}

if (!function_exists('getImage')) {
    function getImage($post)
    {
        return asset("storage/photos/" . $post->image);
    }
}

if (!function_exists('getImageThumb')) {
    function getImageThumb($post)
    {
        return asset("storage/thumbs/" . $post->image);
    }
}
