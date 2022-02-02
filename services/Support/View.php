<?php

namespace Services\Support;

class View {
    public static function render($view_name) {
        return require_once config('APP_ROOT')."/resources/views/$view_name.php";
    }
}