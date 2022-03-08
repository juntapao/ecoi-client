<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href={{ asset('semantic/semantic.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('semantic/style.css') }}>
    <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light&display=swap" rel="stylesheet">
</head>
<body>
<div class="ui rx-body container"> 
   
<div class= "pusher">
        <div class= "ui vertical rx-main center aligned segment">
                @include('includes.sidenav')
            <div class="ui container">
                <div class="ui large secondary inverted pointed fixed menu">
                    <a id= "toggle" class="item">
                        <i class="sidebar icon"></i>
                    </a>
                    <div class="rx-logo">
                        ML                
                    </div>
                    <div class="right item">
                        <a href="/mlhuillier/public/" class="item">
                            Home
                        </a>
                        <a href="/mlhuillier/public/create_user" class="item">
                            Register
                        </a>
                        <a href="#about" class="item">
                            About
                        </a>
                    </div>
                </div>
            </div>