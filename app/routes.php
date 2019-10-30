<?php
$app->addRoutingMiddleware();

$customErrorHandler = function (
    $request,
    Throwable $exception
) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    return $this->get('view')->render($response, '404.html');
};