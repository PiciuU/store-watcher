<?php

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();

    function config($key) {
        return $key === 'APP_ROOT' ? dirname(__DIR__) : $_ENV[$key];
    }
?>
