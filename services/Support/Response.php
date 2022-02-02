<?php

namespace Services\Support;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Response {
    public static function toJson() {
        self::send(new JsonResponse("test"));
    }

    protected static function send(JsonResponse $response) {
        $response->sendHeaders();
        $response->sendContent();
    }
}