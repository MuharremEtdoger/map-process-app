<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if(isset($pageAssets['css']))
            @foreach ($pageAssets['css'] as $_css)
                <link rel="stylesheet" href="{{ $_css }}">
            @endforeach
        @endif
        <link rel="stylesheet" href="/assets/css/bootstrap-icons.min.css">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/map.css">
        <title>
            @if (isset($site_title))
                {{ $site_title }}
            @else
                Map Locations
            @endif
        </title>
    </head>
    <body>